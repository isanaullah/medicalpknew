<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'All categories') {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status') && $request->input('status') !== 'All statuses') {
            $query->where('status', $request->input('status'));
        }

        $faqs = $query->orderBy('order', 'asc')->latest()->paginate(10)->withQueryString();
        $categories = Faq::select('category')->whereNotNull('category')->distinct()->pluck('category');

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        $categories = ['General', 'Payments', 'Certificates', 'Access', 'Learning', 'Technical', 'Support'];
        return view('admin.faqs.create', compact('categories'));
    }

    public function store(FaqRequest $request)
    {
        $data = $request->validated();
        if (!isset($data['order']) || $data['order'] === null) {
            $maxOrder = Faq::max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        Faq::create($data);

        return redirect()->route('admin.faqs')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        $categories = ['General', 'Payments', 'Certificates', 'Access', 'Learning', 'Technical', 'Support'];
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return redirect()->route('admin.faqs')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs')->with('success', 'FAQ deleted successfully.');
    }
}
