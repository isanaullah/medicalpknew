<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonNote;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminLmsCrudAndAccessTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->admin = User::where('email', 'admin@admin.com')->first();
        $this->student = User::where('email', 'student@student.com')->first();
    }

    public function test_seeders_populated_all_modules_accurately(): void
    {
        $this->assertEquals(10, Category::count());
        $this->assertEquals(10, Course::count());
        $this->assertEquals(5, Course::where('type', 'Free')->count());
        $this->assertEquals(5, Course::where('type', 'Paid')->count());
        $this->assertEquals(10, Lesson::count());
        $this->assertEquals(10, Quiz::count());
        $this->assertGreaterThan(0, LessonNote::count());

        // Verify free courses have price 0 and paid courses have price > 0
        foreach (Course::where('type', 'Free')->get() as $freeCourse) {
            $this->assertEquals(0.00, (float)$freeCourse->price);
        }
        foreach (Course::where('type', 'Paid')->get() as $paidCourse) {
            $this->assertGreaterThan(0.00, (float)$paidCourse->price);
        }

        // Verify some courses exist without category
        $this->assertGreaterThan(0, Course::whereNull('category_id')->count());
    }

    public function test_super_admin_can_access_all_admin_crud_modules(): void
    {
        $course = Course::first();
        $lesson = Lesson::first();
        $quiz = Quiz::first();

        $routes = [
            route('admin.dashboard'),
            route('admin.categories'),
            route('admin.courses'),
            route('admin.courses.create'),
            route('admin.courses.show', $course->id),
            route('admin.courses.edit', $course->id),
            route('admin.curriculum'),
            route('admin.lessons.notes.index', $lesson->id),
            route('admin.lessons.quizzes.index', $lesson->id),
            route('admin.quizzes.show', $quiz->id),
            route('admin.blog'),
            route('admin.faqs'),
            route('admin.pages'),
            route('admin.media'),
            route('admin.settings'),
        ];

        foreach ($routes as $url) {
            $response = $this->actingAs($this->admin)->get($url);
            $response->assertStatus(200);
        }
    }

    public function test_student_cannot_access_admin_crud_modules(): void
    {
        $response = $this->actingAs($this->student)->get(route('admin.courses'));
        $response->assertStatus(403);

        $response = $this->actingAs($this->student)->get(route('admin.categories'));
        $response->assertStatus(403);
    }

    public function test_admin_can_create_category_and_prevent_unsafe_deletion(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.categories.store'), [
            'name' => 'Machine Learning & AI',
            'slug' => 'machine-learning-ai',
            'description' => 'ML models and neural nets',
            'status' => 'Active',
        ]);

        $response->assertRedirect(route('admin.categories'));
        $this->assertDatabaseHas('categories', ['slug' => 'machine-learning-ai']);

        $category = Category::where('slug', 'machine-learning-ai')->first();

        // Assign a course to it
        $course = Course::first();
        $course->update(['category_id' => $category->id]);

        // Deletion should be prevented
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.categories.destroy', $category->id));
        $deleteResponse->assertRedirect(route('admin.categories'));
        $deleteResponse->assertSessionHas('error');
        $this->assertDatabaseHas('categories', ['id' => $category->id]);

        // Remove course, now deletion succeeds
        $course->update(['category_id' => null]);
        $deleteResponse2 = $this->actingAs($this->admin)->delete(route('admin.categories.destroy', $category->id));
        $deleteResponse2->assertSessionHas('success');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_course_pricing_validation_rules(): void
    {
        // 1. Paid course cannot have price 0
        $response = $this->actingAs($this->admin)->post(route('admin.courses.store'), [
            'title' => 'Invalid Paid Course',
            'type' => 'Paid',
            'price' => 0.00,
            'level' => 'Beginner',
            'language' => 'English',
            'status' => 'Draft',
        ]);
        $response->assertSessionHasErrors('price');

        // 2. Free course cannot have positive price (it automatically resets or rejects)
        $response2 = $this->actingAs($this->admin)->post(route('admin.courses.store'), [
            'title' => 'Valid Free Course',
            'type' => 'Free',
            'level' => 'Beginner',
            'language' => 'English',
            'status' => 'Published',
        ]);
        $response2->assertSessionHasNoErrors();
        $this->assertDatabaseHas('courses', [
            'title' => 'Valid Free Course',
            'type' => 'Free',
            'price' => 0.00,
        ]);

        // 3. Discount price must be lower than regular price
        $response3 = $this->actingAs($this->admin)->post(route('admin.courses.store'), [
            'title' => 'Invalid Discount Course',
            'type' => 'Paid',
            'price' => 50.00,
            'discount_price' => 60.00, // higher than 50
            'level' => 'Beginner',
            'language' => 'English',
            'status' => 'Draft',
        ]);
        $response3->assertSessionHasErrors('discount_price');
    }

    public function test_paid_course_note_access_control(): void
    {
        $paidCourse = Course::where('type', 'Paid')->where('slug', 'the-complete-web-development-bootcamp')->first();
        $lesson = $paidCourse->lessons()->first();
        $note = $lesson->notes()->first();

        // 1. Guest cannot download
        $guestResponse = $this->get(route('notes.download', $note->id));
        $guestResponse->assertRedirect('/login');

        // 2. Create another student who does NOT have enrollment in this paid course
        $otherStudent = User::factory()->create();
        $otherStudent->assignRole('Student');

        $unauthorizedResponse = $this->actingAs($otherStudent)->get(route('notes.download', $note->id));
        $unauthorizedResponse->assertStatus(403);

        // 3. Super Admin can download
        $adminResponse = $this->actingAs($this->admin)->get(route('notes.download', $note->id));
        $adminResponse->assertStatus(200);

        // 4. Student WITH active paid enrollment can download
        $enrolledResponse = $this->actingAs($this->student)->get(route('notes.download', $note->id));
        $enrolledResponse->assertStatus(200);
    }
}
