<?php

namespace Tests\Feature;

use App\Models\PageSection;
use App\Models\User;
use App\Models\WebsitePage;
use Database\Seeders\PageSectionSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SuperAdminSeeder;
use Database\Seeders\WebsitePageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageSectionAndVisualEditTest extends TestCase
{
    use RefreshDatabase;

    protected User $superAdmin;
    protected User $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
        $this->seed(SuperAdminSeeder::class);
        $this->seed(WebsitePageSeeder::class);
        $this->seed(PageSectionSeeder::class);

        $this->superAdmin = User::role('Super Admin')->first() ?? User::where('email', 'admin@admin.com')->first();

        $this->student = User::factory()->create();
        $this->student->assignRole('Student');
    }

    public function test_all_frontend_pages_render_successfully_from_database_sections(): void
    {
        $routes = [
            '/',
            '/about',
            '/contact',
            '/faq',
            '/privacy',
            '/terms',
            '/disclaimer',
            '/cookies',
            '/team',
            '/paths',
            '/books',
            '/courses',
            '/blog',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    public function test_home_page_displays_content_from_database(): void
    {
        $homePage = WebsitePage::where('slug', 'home')->first();
        $this->assertNotNull($homePage);

        $heroSection = $homePage->sections()->where('section_key', 'hero')->first();
        $this->assertNotNull($heroSection);
        $this->assertStringContainsString("Build a career you're proud of", $heroSection->title);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee($heroSection->title);
    }

    public function test_super_admin_can_access_visual_edit_redirect(): void
    {
        $response = $this->actingAs($this->superAdmin)->get(route('admin.visual-edit', 'home'));
        $response->assertRedirect(route('home', ['visual_edit' => 1]));
    }

    public function test_super_admin_can_update_page_section_via_ajax_and_persists(): void
    {
        $homePage = WebsitePage::where('slug', 'home')->first();
        $heroSection = $homePage->sections()->where('section_key', 'hero')->first();

        $updatedData = [
            'title' => 'Brand New Custom Hero Title 2026',
            'subtitle' => 'Award Winning Learning Track',
            'description' => 'Custom updated description saved directly by the admin in visual edit mode.',
            'is_visible' => true,
            'config' => array_merge($heroSection->config ?? [], [
                'primary_btn_label' => 'Start Now For Free',
            ]),
        ];

        $response = $this->actingAs($this->superAdmin)
            ->putJson(route('admin.visual-edit.update-section', [$homePage->slug, $heroSection->id]), $updatedData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        // Verify immediately in DB
        $heroSection->refresh();
        $this->assertEquals('Brand New Custom Hero Title 2026', $heroSection->title);
        $this->assertEquals('Start Now For Free', $heroSection->config('primary_btn_label'));

        // Verify rendered on frontend
        $frontendResponse = $this->get('/');
        $frontendResponse->assertSee('Brand New Custom Hero Title 2026');
        $frontendResponse->assertSee('Start Now For Free');
    }

    public function test_student_cannot_update_page_sections(): void
    {
        $homePage = WebsitePage::where('slug', 'home')->first();
        $heroSection = $homePage->sections()->where('section_key', 'hero')->first();

        $response = $this->actingAs($this->student)
            ->putJson(route('admin.visual-edit.update-section', [$homePage->slug, $heroSection->id]), [
                'title' => 'Malicious Hacker Title',
            ]);

        $response->assertStatus(403);
    }

    public function test_seeder_is_idempotent_and_does_not_overwrite_admin_customizations(): void
    {
        $aboutPage = WebsitePage::where('slug', 'about')->first();
        $heroSection = $aboutPage->sections()->where('section_key', 'hero')->first();

        // Custom edit by admin
        $heroSection->update([
            'title' => 'Customized Admin About Us Heading',
        ]);

        // Re-run the seeder
        $this->seed(PageSectionSeeder::class);

        // Verify it was NOT overwritten
        $heroSection->refresh();
        $this->assertEquals('Customized Admin About Us Heading', $heroSection->title);
    }
}
