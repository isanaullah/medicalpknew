<?php

namespace Tests\Feature;

use App\Models\BlogArticle;
use App\Models\Category;
use App\Models\Course;
use App\Models\Faq;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\User;
use App\Models\WebsitePage;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSlugAndModalTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('email', 'admin@admin.com')->first();
    }

    public function test_slug_based_course_routing(): void
    {
        $course = Course::first();
        $this->assertNotEmpty($course->slug);

        // Access via slug
        $response = $this->actingAs($this->admin)->get(route('admin.courses.show', $course->slug));
        $response->assertStatus(200);
        $response->assertSee($course->title);

        // Invalid slug returns 404
        $invalidResponse = $this->actingAs($this->admin)->get('/admin/courses/non-existent-course-slug-12345');
        $invalidResponse->assertStatus(404);
    }

    public function test_slug_based_category_routing(): void
    {
        $category = Category::first();
        $this->assertNotEmpty($category->slug);

        // Update via slug
        $response = $this->actingAs($this->admin)->put(route('admin.categories.update', $category->slug), [
            'name' => 'Updated Category Name',
            'slug' => $category->slug,
            'status' => 'Active',
        ]);
        $response->assertRedirect(route('admin.categories'));
        $this->assertDatabaseHas('categories', ['name' => 'Updated Category Name']);

        // Invalid slug returns 404
        $invalidResponse = $this->actingAs($this->admin)->put('/admin/categories/invalid-slug-xyz-999', [
            'name' => 'Should Fail',
            'status' => 'Active',
        ]);
        $invalidResponse->assertStatus(404);
    }

    public function test_slug_based_quiz_routing(): void
    {
        $quiz = Quiz::first();
        $this->assertNotEmpty($quiz->slug);

        // Show via slug
        $response = $this->actingAs($this->admin)->get(route('admin.quizzes.show', $quiz->slug));
        $response->assertStatus(200);
        $response->assertSee($quiz->title);

        // Invalid slug returns 404
        $invalidResponse = $this->actingAs($this->admin)->get('/admin/quizzes/invalid-quiz-slug-999');
        $invalidResponse->assertStatus(404);
    }

    public function test_slug_based_blog_routing(): void
    {
        $article = BlogArticle::first();
        $this->assertNotEmpty($article->slug);

        // Edit via slug
        $response = $this->actingAs($this->admin)->get(route('admin.blog.edit', $article->slug));
        $response->assertStatus(200);
        $response->assertSee($article->title);

        // Invalid slug returns 404
        $invalidResponse = $this->actingAs($this->admin)->get('/admin/blog/invalid-article-slug-xyz/edit');
        $invalidResponse->assertStatus(404);
    }

    public function test_slug_based_faq_routing(): void
    {
        $faq = Faq::first();
        $this->assertNotEmpty($faq->slug);

        // Update via slug
        $response = $this->actingAs($this->admin)->put(route('admin.faqs.update', $faq->slug), [
            'question' => 'Updated FAQ Question?',
            'answer' => 'Updated answer text.',
            'status' => 'Published',
        ]);
        $response->assertRedirect(route('admin.faqs'));
        $this->assertDatabaseHas('faqs', ['question' => 'Updated FAQ Question?']);

        // Invalid slug returns 404
        $invalidResponse = $this->actingAs($this->admin)->put('/admin/faqs/invalid-faq-slug-xyz', [
            'question' => 'Invalid',
            'answer' => 'Test',
            'status' => 'Published',
        ]);
        $invalidResponse->assertStatus(404);
    }

    public function test_slug_based_page_routing(): void
    {
        $page = WebsitePage::first();
        $this->assertNotEmpty($page->slug);

        // Update via slug
        $response = $this->actingAs($this->admin)->put(route('admin.pages.update', $page->slug), [
            'title' => 'Updated Page Title',
            'content' => 'Updated page content text.',
            'status' => 'Published',
        ]);
        $response->assertRedirect(route('admin.pages'));
        $this->assertDatabaseHas('website_pages', ['title' => 'Updated Page Title']);

        // Invalid slug returns 404
        $invalidResponse = $this->actingAs($this->admin)->put('/admin/pages/invalid-page-slug-xyz', [
            'title' => 'Invalid',
            'content' => 'Content',
            'status' => 'Published',
        ]);
        $invalidResponse->assertStatus(404);
    }

    public function test_admin_views_contain_modal_toast_and_delete_row_triggers(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.categories'));
        $response->assertStatus(200);
        $response->assertSee('modalRoot');
        $response->assertSee('toastRoot');
        $response->assertSee('data-action="delete-row"', false);

        $courseResponse = $this->actingAs($this->admin)->get(route('admin.courses'));
        $courseResponse->assertStatus(200);
        $courseResponse->assertSee('data-action="delete-row"', false);

        $faqResponse = $this->actingAs($this->admin)->get(route('admin.faqs'));
        $faqResponse->assertStatus(200);
        $faqResponse->assertSee('data-action="delete-row"', false);
    }
}
