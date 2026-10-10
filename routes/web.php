<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Livewire\Admin\User\ShowUser;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\WebSettingController;
use App\Http\Controllers\Admin\BlogArticleController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserEducationController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\SectionController;

use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseChapterController;
use App\Http\Controllers\ChapterNoteController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\YouTubeVideoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EnrollmentController;



// test






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// ===== LOAD STUDENT MODULE ROUTES =====
// This will include ALL routes from your module
require_once base_path('Modules/Student/routes/web.php');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/generate-sitemap', [SitemapController::class, 'generate'])->name('generate.sitemap');
Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::get('/courses', [WebsiteController::class, 'courses'])->name('courses');
Route::get('/courses/{id}', [WebsiteController::class, 'courseDetail'])->name('courses.detail');

Route::get('/blog', [WebsiteController::class, 'blog'])->name('blog');
Route::get('/blog/{id}', [WebsiteController::class, 'blogDetail'])->name('blog.detail');

Route::get('/about-us', [WebsiteController::class, 'about'])->name('about');
Route::get('/privacy-policy', [WebsiteController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-and-conditions', [WebsiteController::class, 'terms'])->name('terms');
Route::get('/notes', [WebsiteController::class, 'notes'])->name('notes');
Route::get('/notes/{id}', [WebsiteController::class, 'notesDetail'])->name('notes.detail');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'send'])->name('contact.send');

// Frontend Routes for Reviews
Route::post('/reviews/store', [ReviewController::class, 'frontendStore'])->name('reviews.store');
// Frontend Cart Routes
// Cart Routes
// Cart Routes
// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::get('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [CartController::class, 'placeOrder'])->name('place.order');
    Route::get('/confirmation/{id}', [CartController::class, 'confirmation'])->name('confirmation');
});

Route::post('/courses/enroll-free/{id}', [EnrollmentController::class, 'enrollFree'])->name('courses.enroll.free')->middleware(['auth']);


/// Public routes
Route::controller(SiteController::class)->group(function () {
  // Main page
//   Route::get('/', 'index')
//     ->name('home');
});
Route::post('/contact', [ContactController::class, 'send']);
/// Protected routes
Route::middleware(['auth'])->group(function () {
  // User dashboard
  Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('checkpermission:dashboard');
});

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Admin dashboard Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/admin')->group(function () {
  Route::middleware(['checkrole:admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
      ->name('admin.dashboard')
      ->middleware('checkpermission:admin.dashboard.view');
      Route::get('/all_setting', [WebSettingController::class, 'setting'])->name('all_setting');
      Route::get('/smtp', [WebSettingController::class, 'smtp'])->name('smtp');
      Route::get('/websetting', [WebSettingController::class, 'websetting'])->name('websetting');
      Route::put('/update-email-configuration', [WebSettingController::class, 'updateSMTP'])->name('smtp.update');
        Route::get('/cache-clear', [WebSettingController::class, 'cache'])->name('cache-clear.page');
      Route::post('/clear-cache', [WebSettingController::class, 'clearCache'])->name('cache-clear.action');
    // Users
    Route::get('/users', ShowUser::class)
      ->name('view.users')
      ->middleware('checkpermission:view.users');
    Route::controller(UsersController::class)->group(function () {
      Route::get('/user/add', 'create')
        ->name('create.users')
        ->middleware('checkpermission:create.users');

      Route::post('/user/save', 'store')
        ->name('save.users')
        ->middleware('checkpermission:create.users');

      Route::get('/user/delete/{id}', 'destroy')
        ->name('delete.users')
        ->middleware('checkpermission:delete.users');

      Route::get('/user/edit/{id}', 'edit')
        ->name('edit.users')
        ->middleware('checkpermission:update.users');

      Route::put('/user/{id}', 'update')
        ->name('update.users')
        ->middleware('checkpermission:update.users');
    });
    // Education
Route::prefix('education')->group(function () {
    Route::get('/education/{userId}/', [UserEducationController::class, 'index'])->name('education.manage');
    Route::get('/create', [UserEducationController::class, 'create'])->name('education.create');
    Route::post('/store', [UserEducationController::class, 'store'])->name('education.store');
    Route::get('/edit/{userId}/{id}', [UserEducationController::class, 'edit'])->name('education.edit');
    Route::put('/update/{userId}', [UserEducationController::class, 'update'])->name('education.update');
    Route::delete('/destroy/{id}', [UserEducationController::class, 'destroy'])->name('education.destroy');
});
    // Roles & permissions
    Route::get('/roles-permissions', [AccessController::class, 'index'])
      ->name('view.roles-permissions')
      ->middleware('checkpermission:view.roles.permissions');

    Route::controller(RoleController::class)->group(function () {
      Route::prefix('/role')->name('role')->group(function () {
        Route::get('/add', 'create')
          ->name('.create')
          ->middleware('checkpermission:create.roles');

        Route::post('/store', 'store')
          ->name('.save')
          ->middleware('checkpermission:create.roles');

        Route::get('/edit/{id}', 'edit')
          ->name('.edit')
          ->middleware('checkpermission:update.roles');

        Route::put('/{id}', 'update')
          ->name('.update')
          ->middleware('checkpermission:update.roles');

        Route::get('/delete/{id}', 'destroy')
          ->name('.delete')
          ->middleware('checkpermission:delete.roles');
      });
    });

    // Site pages
    Route::controller(PageController::class)->group(function () {
      Route::get('/pages', 'index')
        ->name('view.pages')
        ->middleware('checkpermission:view.pages');

      Route::get('/page/add', 'create')
        ->name('create.pages')
        ->middleware('checkpermission:create.pages');

      Route::post('/page/save', 'store')
        ->name('save.pages')
        ->middleware('checkpermission:create.pages');

      Route::get('/page/delete/{id}', 'destroy')
        ->name('delete.pages')
        ->middleware('checkpermission:delete.pages');

      Route::get('/page/edit/{id}', 'edit')
        ->name('edit.pages')
        ->middleware('checkpermission:update.pages');

      Route::put('/page/{id}', 'update')
        ->name('update.pages')
        ->middleware('checkpermission:update.pages');
    });

    // Page Section
    Route::controller(PageSectionController::class)->group(function () {
        Route::get('/pages/{pageId}/sections', 'index')->name('view.sections');
        Route::get('/pages/{id}/sections/create', 'create')->name('sections.create');
        Route::post('/pages/{pageId}/sections', 'store')->name('sections.store');
        Route::get('/sections/{id}/edit', 'edit')->name('sections.edit');
        Route::put('/sections/{section}', 'update')->name('sections.update');
        Route::delete('/sections/{id}', 'destroy')->name('section.delete');
        Route::get('/get-section-content/{id}', 'getSectionContent')->name('section.content.get');
    });

    // Page Section Content
    Route::controller(SectionController::class)->group(function () {
        Route::post('/section-content/store/{sectionId}', 'store')->name('section-content.store');
        Route::put('/section-content/update/{contentId}', 'update')->name('section-content.update');
    });

   // Blog Category
Route::controller(BlogCategoryController::class)->group(function () {
    Route::get('/blog/category', 'index')->name('blog.category.view');
    Route::get('/blog/category/add', 'create')->name('blog.category.create');
    Route::post('/blog/category/add', 'store');
    Route::get('/blog/category/delete/{id}', 'destroy')->name('blog.category.delete');
    Route::get('/blog/category/edit/{id}', 'edit')->name('blog.category.update');
    Route::put('/blog/category/edit/{id}', 'update');
    Route::post('/blog-category/update-status', 'updateStatus')->name('blogCategory.updateStatus');
    Route::post('/blog-category/update-approval', 'updateApproval')->name('blogCategory.updateApproval');
});

// Blog Article
Route::controller(BlogArticleController::class)->group(function () {
    Route::get('/blog/article/{id}', 'index')->name('blog.article.view');
    Route::get('/blog/article/add/{id}', 'create')->name('blog.article.create');
    Route::post('/blog/article/add/{id}', 'store');
    Route::get('/blog/article/delete/{id}', 'destroy')->name('blog.article.delete');
    Route::get('/blog/article/edit/{id}', 'edit')->name('blog.article.update');
    Route::put('/blog/article/edit/{id}', 'update');
    Route::post('/blog-article/update-status', 'updateStatus')->name('article.updateStatus');
    Route::post('/blog-articles/update-approval', 'updateApproval')->name('blog-articles.updateApproval');
});
    // Faqs
Route::controller(FaqsController::class)->group(function () {
    Route::get('/faqs/manage/', 'index')->name('faqs.manage')->middleware('checkpermission:view.faqs');
    Route::get('/faqs/add/', 'create')->name('faqs.create')->middleware('checkpermission:create.faqs');
    Route::post('/faqs/store/', 'store')->name('faqs.store')->middleware('checkpermission:store.faqs');
    Route::get('/faqs/edit//{id}', 'edit')->name('faqs.edit')->middleware('checkpermission:edit.faqs');
    Route::put('/faqs/update//{id}', 'update')->name('faqs.update')->middleware('checkpermission:update.faqs');
    Route::delete('/faqs/destroy//{id}', 'destroy')->name('faqs.destroy')->middleware('checkpermission:destroy.faqs');
});
    // Banner
Route::controller(BannerController::class)->group(function () {
    Route::get('/banners/manage/', 'index')->name('banners.manage')->middleware('checkpermission:view.banners');
    Route::get('/banners/add/', 'create')->name('banners.create')->middleware('checkpermission:create.banners');
    Route::post('/banners/store/', 'store')->name('banners.store')->middleware('checkpermission:store.banners');
    Route::get('/banners/edit/{id}', 'edit')->name('banners.edit')->middleware('checkpermission:edit.banners');
    Route::put('/banners/update/{id}', 'update')->name('banners.update')->middleware('checkpermission:update.banners');
    Route::delete('/banners/destroy/{id}', 'destroy')->name('banners.destroy')->middleware('checkpermission:destroy.banners');
});
    // Slider
Route::controller(SliderController::class)->group(function () {
    Route::get('/sliders/manage', 'index')->name('sliders.index')->middleware('checkpermission:view.sliders');
    Route::get('/sliders/create', 'create')->name('sliders.create')->middleware('checkpermission:create.sliders');
    Route::post('/sliders/store', 'store')->name('sliders.store')->middleware('checkpermission:store.sliders');
    Route::get('/sliders/{id}/edit', 'edit')->name('sliders.edit')->middleware('checkpermission:edit.sliders');
    Route::put('/sliders/{id}', 'update')->name('sliders.update')->middleware('checkpermission:update.sliders');
    Route::get('/sliders/{id}', 'destroy')->name('sliders.destroy')->middleware('checkpermission:destroy.sliders');
});
    // Tags
Route::controller(TagController::class)->group(function () {
    Route::get('/tags/manage', 'index')->name('tags.index')->middleware('checkpermission:view.sliders');
    Route::get('/tags/create', 'create')->name('tags.create')->middleware('checkpermission:create.sliders');
    Route::post('/tags/store', 'store')->name('tags.store')->middleware('checkpermission:store.sliders');
    Route::get('/tags/{id}/edit', 'edit')->name('tags.edit')->middleware('checkpermission:edit.sliders');
    Route::put('/tags/{id}', 'update')->name('tags.update')->middleware('checkpermission:update.sliders');
    Route::get('/tags/{id}', 'destroy')->name('tags.destroy')->middleware('checkpermission:destroy.sliders');
});



    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/orders/{id}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('/orders/{id}/process-enrollment', [OrderController::class, 'processEnrollment'])->name('orders.process-enrollment');


Route::controller(YouTubeVideoController::class)->prefix('youtube')->name('youtube.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::post('/update-status', 'updateStatus')->name('update-status');
    Route::post('/update-featured', 'updateFeatured')->name('update-featured');
});


// Admin Enrollment Routes
    Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::get('/enrollments/{id}', [EnrollmentController::class, 'show'])->name('enrollments.show');
    Route::get('/enrollments/{id}/edit', [EnrollmentController::class, 'edit'])->name('enrollments.edit');
    Route::put('/enrollments/{id}', [EnrollmentController::class, 'update'])->name('enrollments.update');
    Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    Route::post('/enrollments/update-status', [EnrollmentController::class, 'updateStatus'])->name('enrollments.update-status');

    // Bulk Enrollment Routes
    Route::get('/enrollments/bulk/create', [EnrollmentController::class, 'bulkEnroll'])->name('enrollments.bulk');
    Route::post('/enrollments/bulk', [EnrollmentController::class, 'bulkStore'])->name('enrollments.bulk.store');

    // AJAX Routes
    Route::get('/enrollments/user/{userId}/courses', [EnrollmentController::class, 'getUserCourses'])->name('enrollments.user.courses');
    Route::get('/enrollments/user/{userId}/enrolled', [EnrollmentController::class, 'getEnrolledCourses'])->name('enrollments.user.enrolled');

// Admin Routes for Reviews
Route::controller(ReviewController::class)->prefix('reviews')->name('reviews.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::post('/update-status', 'updateStatus')->name('update-status');
    Route::post('/update-featured', 'updateFeatured')->name('update-featured');
});

// Course Categories
Route::controller(CourseCategoryController::class)->prefix('course-categories')->name('course-categories.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

// Courses
Route::controller(CourseController::class)->prefix('courses')->name('courses.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

// Chapters (nested under courses)
Route::prefix('courses/{course_id}/chapters')->name('chapters.')->group(function () {
    Route::get('/', [CourseChapterController::class, 'index'])->name('index');
    Route::get('/create', [CourseChapterController::class, 'create'])->name('create');
    Route::post('/store', [CourseChapterController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CourseChapterController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CourseChapterController::class, 'update'])->name('update');
    Route::delete('/{id}', [CourseChapterController::class, 'destroy'])->name('destroy');
});

// Notes (nested under chapters)
Route::prefix('chapters/{chapter_id}/notes')->name('notes.')->group(function () {
    Route::get('/', [ChapterNoteController::class, 'index'])->name('index');
    Route::get('/create', [ChapterNoteController::class, 'create'])->name('create');
    Route::post('/store', [ChapterNoteController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ChapterNoteController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ChapterNoteController::class, 'update'])->name('update');
    Route::delete('/{id}', [ChapterNoteController::class, 'destroy'])->name('destroy');
});








    // App setttings
    Route::controller(AppSettingController::class)->group(function () {
      Route::get('/app-setting/edit/{id}', 'edit')
        ->name('edit.app-setting')
        ->middleware('checkpermission:update.app.settings');

      Route::put('/app-setting/{id}', 'update')
        ->name('update.app-setting')
        ->middleware('checkpermission:update.app.settings');
    });

    // Web settings
    Route::controller(WebSettingController::class)->group(function () {
      Route::get('/web-setting/edit/{id}', 'edit')
        ->name('edit.web-setting')
        ->middleware('checkpermission:update.web.settings');

      Route::put('/web-setting/{id}', 'update')
        ->name('update.web-setting')
        ->middleware('checkpermission:update.web.settings');
        Route::get('/all_setting', 'setting')->name('all_setting');
        Route::get('/smtp', 'smtp')->name('smtp');
        Route::get('/websetting', 'websetting')->name('websetting');
        Route::put('/update-email-configuration', 'updateSMTP')->name('smtp.update');
        Route::get('/cache-clear', 'cache')->name('cache-clear.page');
        Route::post('/clear-cache', 'clearCache')->name('cache-clear.action');
    });
  });
});
