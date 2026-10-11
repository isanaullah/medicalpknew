<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use App\Models\Category;
use App\Models\Course;
use App\Models\Faq;
use App\Models\WebsitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Throwable;

class FrontendController extends Controller
{
    /**
     * Retrieve a website page by slug eager loading all page sections.
     */
    private function getPageWithSections(string $slug): array
    {
        try {
            if (!Schema::hasTable('website_pages')) {
                return ['page' => null, 'sections' => collect()];
            }

            $page = WebsitePage::where('slug', $slug)
                ->with(['sections' => function ($query) {
                    $query->orderBy('sort_order');
                }])
                ->first();

            $sections = $page ? $page->sections->keyBy('section_key') : collect();

            return [
                'page' => $page,
                'sections' => $sections,
            ];
        } catch (Throwable $e) {
            return [
                'page' => null,
                'sections' => collect(),
            ];
        }
    }

    public function home()
    {
        $data = $this->getPageWithSections('home');

        try {
            $data['featuredCourses'] = Course::where('status', 'Published')
                ->where('is_featured', true)
                ->with(['category', 'instructor'])
                ->take(3)
                ->get();

            if ($data['featuredCourses']->isEmpty()) {
                $data['featuredCourses'] = Course::where('status', 'Published')
                    ->with(['category', 'instructor'])
                    ->take(3)
                    ->get();
            }
        } catch (Throwable $e) {
            $data['featuredCourses'] = collect();
        }

        try {
            $data['categories'] = Category::withCount('courses')->take(8)->get();
        } catch (Throwable $e) {
            $data['categories'] = collect();
        }

        try {
            $data['faqs'] = Faq::where('status', 'Published')
                ->orderBy('order')
                ->take(6)
                ->get();

            if ($data['faqs']->isEmpty()) {
                $data['faqs'] = Faq::orderBy('order')->take(6)->get();
            }
        } catch (Throwable $e) {
            $data['faqs'] = collect();
        }

        try {
            $data['articles'] = BlogArticle::where('status', 'Published')
                ->with(['author', 'category'])
                ->latest()
                ->take(3)
                ->get();
        } catch (Throwable $e) {
            $data['articles'] = collect();
        }

        return view('frontend.home', $data);
    }

    public function courses(Request $request)
    {
        $data = $this->getPageWithSections('courses');

        try {
            $data['categories'] = Category::withCount('courses')->get();

            $query = Course::query()->where('status', 'Published')->with(['category', 'instructor']);

            if ($request->filled('cat') && $request->cat !== 'all') {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->cat);
                });
            }

            if ($request->filled('level') && $request->level !== 'all') {
                $query->where('level', $request->level);
            }

            if ($request->filled('q')) {
                $search = $request->q;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('short_description', 'like', "%{$search}%");
                });
            }

            $data['courses'] = $query->paginate(9)->withQueryString();
        } catch (Throwable $e) {
            $data['categories'] = collect();
            $data['courses'] = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 9);
        }

        return view('frontend.courses', $data);
    }

    public function courseDetail($id = 1)
    {
        $course = null;
        try {
            if (is_numeric($id)) {
                $course = Course::with(['category', 'instructor', 'lessons.quizzes', 'lessons.notes'])->find($id);
            } else {
                $course = Course::where('slug', $id)->with(['category', 'instructor', 'lessons.quizzes', 'lessons.notes'])->first();
            }
        } catch (Throwable $e) {
            $course = null;
        }

        return view('frontend.course-detail', compact('id', 'course'));
    }

    public function books()
    {
        $data = $this->getPageWithSections('books');
        return view('frontend.books', $data);
    }

    public function team()
    {
        $data = $this->getPageWithSections('team');
        return view('frontend.team', $data);
    }

    public function paths()
    {
        $data = $this->getPageWithSections('paths');
        return view('frontend.paths', $data);
    }

    public function about()
    {
        $data = $this->getPageWithSections('about');
        return view('frontend.about', $data);
    }

    public function contact()
    {
        $data = $this->getPageWithSections('contact');

        try {
            $data['faqs'] = Faq::where('status', 'Published')
                ->orderBy('order')
                ->take(4)
                ->get();

            if ($data['faqs']->isEmpty()) {
                $data['faqs'] = Faq::orderBy('order')->take(4)->get();
            }
        } catch (Throwable $e) {
            $data['faqs'] = collect();
        }

        return view('frontend.contact', $data);
    }

    public function blog()
    {
        $data = $this->getPageWithSections('blog');

        try {
            $data['articles'] = BlogArticle::where('status', 'Published')
                ->with(['author', 'category'])
                ->latest()
                ->paginate(9);
        } catch (Throwable $e) {
            $data['articles'] = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 9);
        }

        return view('frontend.blog', $data);
    }

    public function blogDetail($id = 1)
    {
        $article = null;
        try {
            if (is_numeric($id)) {
                $article = BlogArticle::with(['author', 'category'])->find($id);
            } else {
                $article = BlogArticle::where('slug', $id)->with(['author', 'category'])->first();
            }
        } catch (Throwable $e) {
            $article = null;
        }

        return view('frontend.blog-detail', compact('id', 'article'));
    }

    public function faq()
    {
        $data = $this->getPageWithSections('faq');

        try {
            $data['faqs'] = Faq::where('status', 'Published')
                ->orderBy('order')
                ->get();

            if ($data['faqs']->isEmpty()) {
                $data['faqs'] = Faq::orderBy('order')->get();
            }
        } catch (Throwable $e) {
            $data['faqs'] = collect();
        }

        return view('frontend.faq', $data);
    }

    public function privacy()
    {
        $data = $this->getPageWithSections('privacy');
        return view('frontend.privacy', $data);
    }

    public function terms()
    {
        $data = $this->getPageWithSections('terms');
        return view('frontend.terms', $data);
    }

    public function disclaimer()
    {
        $data = $this->getPageWithSections('disclaimer');
        return view('frontend.disclaimer', $data);
    }

    public function cookies()
    {
        $data = $this->getPageWithSections('cookies');
        return view('frontend.cookies', $data);
    }
}
