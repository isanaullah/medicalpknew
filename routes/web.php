<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

/*
|--------------------------------------------------------------------------
| 1. Public Website Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/courses', [FrontendController::class, 'courses'])->name('courses');
Route::get('/course/{id?}', [FrontendController::class, 'courseDetail'])->name('course.detail');
Route::get('/books', [FrontendController::class, 'books'])->name('books');
Route::get('/team', [FrontendController::class, 'team'])->name('team');
Route::get('/paths', [FrontendController::class, 'paths'])->name('paths');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{id?}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/privacy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [FrontendController::class, 'disclaimer'])->name('disclaimer');
Route::get('/cookies', [FrontendController::class, 'cookies'])->name('cookies');

/*
|--------------------------------------------------------------------------
| 2. Guest-Only Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');

    Route::get('/forgot', function () {
        return redirect()->route('password.request');
    });
});

/*
|--------------------------------------------------------------------------
| 3. Authenticated Routes (General)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| 4. Student Routes (Protected by Auth and Student Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/overview', [StudentController::class, 'dashboard']);
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/wishlist', [StudentController::class, 'wishlist'])->name('wishlist');
    Route::get('/certificates', [StudentController::class, 'certificates'])->name('certificates');
    Route::get('/notifications', [StudentController::class, 'notifications'])->name('notifications');
    Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
    Route::get('/password', [StudentController::class, 'password'])->name('password');
});

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LessonNoteController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\WebsitePageController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\VisualEditController;

/*
|--------------------------------------------------------------------------
| 5. Protected Downloads Route (Enrolled Students & Super Admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/downloads/lesson-notes/{note}', [LessonNoteController::class, 'download'])->name('notes.download');
});

/*
|--------------------------------------------------------------------------
| 6. Super Admin Routes (Protected by Auth and Super Admin Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Super Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard']);

    // 1. Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::resource('categories', CategoryController::class)->except(['index']);

    // 2. Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::post('/courses/{course}/toggle-publish', [CourseController::class, 'togglePublish'])->name('courses.toggle-publish');
    Route::resource('courses', CourseController::class)->except(['index']);

    // 3. Curriculum & Lessons
    Route::get('/curriculum', [LessonController::class, 'curriculum'])->name('curriculum');
    Route::post('/lessons/reorder', [LessonController::class, 'reorder'])->name('lessons.reorder');
    Route::resource('lessons', LessonController::class)->except(['index']);

    // 4. Lesson PDF Notes
    Route::get('/lessons/{lesson}/notes', [LessonNoteController::class, 'index'])->name('lessons.notes.index');
    Route::get('/lessons/{lesson}/notes/create', [LessonNoteController::class, 'create'])->name('lessons.notes.create');
    Route::post('/lessons/notes', [LessonNoteController::class, 'store'])->name('lessons.notes.store');
    Route::get('/lessons/notes/{note}/edit', [LessonNoteController::class, 'edit'])->name('lessons.notes.edit');
    Route::put('/lessons/notes/{note}', [LessonNoteController::class, 'update'])->name('lessons.notes.update');
    Route::delete('/lessons/notes/{note}', [LessonNoteController::class, 'destroy'])->name('lessons.notes.destroy');
    Route::get('/lessons/notes/{note}/download', [LessonNoteController::class, 'download'])->name('lessons.notes.download');

    // 5. Quizzes & Questions
    Route::get('/lessons/{lesson}/quizzes', [QuizController::class, 'index'])->name('lessons.quizzes.index');
    Route::get('/lessons/{lesson}/quizzes/create', [QuizController::class, 'create'])->name('lessons.quizzes.create');
    Route::resource('quizzes', QuizController::class)->except(['index']);

    Route::get('/quizzes/{quiz}/questions/create', [QuizQuestionController::class, 'create'])->name('quizzes.questions.create');
    Route::post('/quizzes/{quiz}/questions', [QuizQuestionController::class, 'store'])->name('quizzes.questions.store');
    Route::get('/questions/{question}/edit', [QuizQuestionController::class, 'edit'])->name('quizzes.questions.edit');
    Route::put('/questions/{question}', [QuizQuestionController::class, 'update'])->name('quizzes.questions.update');
    Route::delete('/questions/{question}', [QuizQuestionController::class, 'destroy'])->name('quizzes.questions.destroy');

    // 6. Blog / Articles
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::resource('blog', BlogController::class)->except(['index']);

    // 7. FAQs
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');
    Route::resource('faqs', FaqController::class)->except(['index']);

    // 8. Website Pages
    Route::get('/pages', [WebsitePageController::class, 'index'])->name('pages');
    Route::get('/pages/{page}/visual-edit', [VisualEditController::class, 'edit'])->name('pages.visual-edit');
    Route::get('/visual-edit/{slug}', [VisualEditController::class, 'editBySlug'])->name('visual-edit');
    Route::get('/visual-edit/{page}/sections/{section}', [VisualEditController::class, 'getSection'])->name('visual-edit.get-section');
    Route::put('/visual-edit/{page}/sections/{section}', [VisualEditController::class, 'updateSection'])->name('visual-edit.update-section');
    Route::post('/visual-edit/{page}/sections/{section}/toggle', [VisualEditController::class, 'toggleVisibility'])->name('visual-edit.toggle-visibility');
    Route::resource('pages', WebsitePageController::class)->except(['index']);

    // 9. Media Library
    Route::get('/media', [MediaLibraryController::class, 'index'])->name('media');
    Route::post('/media', [MediaLibraryController::class, 'store'])->name('media.store');
    Route::delete('/media/{media}', [MediaLibraryController::class, 'destroy'])->name('media.destroy');

    // 10. Website Settings
    Route::get('/settings', [WebsiteSettingController::class, 'index'])->name('settings');
    Route::post('/settings', [WebsiteSettingController::class, 'update'])->name('settings.update');

    // Remaining modules handled by AdminDashboardController
    Route::get('/instructors', [AdminDashboardController::class, 'instructors'])->name('instructors');
    Route::get('/students', [AdminDashboardController::class, 'students'])->name('students');
    Route::get('/enrollments', [AdminDashboardController::class, 'enrollments'])->name('enrollments');
    Route::get('/reviews', [AdminDashboardController::class, 'reviews'])->name('reviews');
    Route::get('/certificates', [AdminDashboardController::class, 'certificates'])->name('certificates');
    Route::get('/notifications', [AdminDashboardController::class, 'notifications'])->name('notifications');
    Route::get('/messages', [AdminDashboardController::class, 'messages'])->name('messages');
    Route::get('/subscribers', [AdminDashboardController::class, 'subscribers'])->name('subscribers');
});
