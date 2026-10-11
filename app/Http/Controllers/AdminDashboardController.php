<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function courses()
    {
        return view('admin.courses');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function curriculum()
    {
        return view('admin.curriculum');
    }

    public function instructors()
    {
        return view('admin.instructors');
    }

    public function students()
    {
        return view('admin.students');
    }

    public function enrollments()
    {
        return view('admin.enrollments');
    }

    public function reviews()
    {
        return view('admin.reviews');
    }

    public function certificates()
    {
        return view('admin.certificates');
    }

    public function blog()
    {
        return view('admin.blog');
    }

    public function faqs()
    {
        return view('admin.faqs');
    }

    public function pages()
    {
        return view('admin.pages');
    }

    public function media()
    {
        return view('admin.media');
    }

    public function notifications()
    {
        return view('admin.notifications');
    }

    public function messages()
    {
        return view('admin.messages');
    }

    public function subscribers()
    {
        return view('admin.subscribers');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
