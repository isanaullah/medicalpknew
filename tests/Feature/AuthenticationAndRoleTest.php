<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Database\Seeders\RolePermissionSeeder;

class AuthenticationAndRoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Log in to your account');
    }

    public function test_registration_page_can_be_rendered(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Create your free account');
    }

    public function test_forgot_password_page_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
        $response->assertSee('Reset your password');
    }

    public function test_student_can_register_and_is_assigned_student_role_only(): void
    {
        $response = $this->post('/register', [
            'name' => 'Alice Student',
            'email' => 'alice@example.com',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticated();

        $user = User::where('email', 'alice@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('Student'));
        $this->assertFalse($user->hasRole('Super Admin'));
    }

    public function test_registration_ignores_role_tampering(): void
    {
        $response = $this->post('/register', [
            'name' => 'Hacker Bob',
            'email' => 'hacker@example.com',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
            'terms' => 'on',
            'role' => 'Super Admin',
            'roles' => ['Super Admin'],
            'is_admin' => 1,
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $user = User::where('email', 'hacker@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('Student'));
        $this->assertFalse($user->hasRole('Super Admin'));
    }

    public function test_duplicate_email_registration_is_rejected(): void
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'duplicate@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/register', [
            'name' => 'Second User',
            'email' => 'duplicate@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    public function test_super_admin_can_login_and_is_redirected_to_admin_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin Boss',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
        ]);
        $admin->assignRole('Super Admin');

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'adminpassword',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_student_can_login_and_is_redirected_to_student_dashboard(): void
    {
        $student = User::create([
            'name' => 'Jane Student',
            'email' => 'jane@example.com',
            'password' => Hash::make('studentpassword'),
        ]);
        $student->assignRole('Student');

        $response = $this->post('/login', [
            'email' => 'jane@example.com',
            'password' => 'studentpassword',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticatedAs($student);
    }

    public function test_invalid_credentials_are_rejected(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('correctpassword'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_remember_me_functionality_sets_remember_token(): void
    {
        $user = User::create([
            'name' => 'Remember Me User',
            'email' => 'remember@example.com',
            'password' => Hash::make('correctpassword'),
        ]);
        $user->assignRole('Student');

        $response = $this->post('/login', [
            'email' => 'remember@example.com',
            'password' => 'correctpassword',
            'remember' => 'on',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticatedAs($user);
        $user->refresh();
        $this->assertNotNull($user->remember_token);
    }

    public function test_student_cannot_access_super_admin_dashboard(): void
    {
        $student = User::create([
            'name' => 'Sneaky Student',
            'email' => 'sneaky@example.com',
            'password' => Hash::make('password123'),
        ]);
        $student->assignRole('Student');

        $response = $this->actingAs($student)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_student_can_access_student_dashboard(): void
    {
        $student = User::create([
            'name' => 'Good Student',
            'email' => 'good@example.com',
            'password' => Hash::make('password123'),
        ]);
        $student->assignRole('Student');

        $response = $this->actingAs($student)->get('/student');
        $response->assertStatus(200);
        $response->assertSee('Student');
    }

    public function test_super_admin_can_access_super_admin_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Super User',
            'email' => 'super@example.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('Super Admin');

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Admin');
    }

    public function test_guest_cannot_access_protected_dashboards(): void
    {
        $adminResponse = $this->get('/admin');
        $adminResponse->assertRedirect(route('login'));

        $studentResponse = $this->get('/student');
        $studentResponse->assertRedirect(route('login'));
    }

    public function test_authenticated_user_visiting_login_is_redirected_to_their_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('Super Admin');

        $responseAdmin = $this->actingAs($admin)->get('/login');
        $responseAdmin->assertRedirect(route('admin.dashboard'));

        $student = User::create([
            'name' => 'Student User',
            'email' => 'student2@example.com',
            'password' => Hash::make('password123'),
        ]);
        $student->assignRole('Student');

        $responseStudent = $this->actingAs($student)->get('/login');
        $responseStudent->assertRedirect(route('student.dashboard'));
    }

    public function test_logout_invalidates_session_and_redirects(): void
    {
        $student = User::create([
            'name' => 'Logged User',
            'email' => 'logged@example.com',
            'password' => Hash::make('password123'),
        ]);
        $student->assignRole('Student');

        $response = $this->actingAs($student)->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_forgot_password_sends_reset_link(): void
    {
        $user = User::create([
            'name' => 'Reset Target',
            'email' => 'resetme@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'resetme@example.com',
        ]);

        $response->assertSessionHas('status');
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        $user = User::create([
            'name' => 'Password Changer',
            'email' => 'changer@example.com',
            'password' => Hash::make('oldpassword'),
        ]);
        $user->assignRole('Student');

        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => 'changer@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    public function test_password_reset_fails_with_invalid_token(): void
    {
        $user = User::create([
            'name' => 'Password Changer 2',
            'email' => 'changer2@example.com',
            'password' => Hash::make('oldpassword'),
        ]);
        $user->assignRole('Student');

        $response = $this->post('/reset-password', [
            'token' => 'invalid-token-12345',
            'email' => 'changer2@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertTrue(Hash::check('oldpassword', $user->fresh()->password));
    }
}
