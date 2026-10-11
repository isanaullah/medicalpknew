<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function overview()
    {
        return view('student.overview');
    }

    public function courses()
    {
        return view('student.courses');
    }

    public function wishlist()
    {
        return view('student.wishlist');
    }

    public function certificates()
    {
        return view('student.certificates');
    }

    public function notifications()
    {
        return view('student.notifications');
    }

    public function settings()
    {
        return view('student.settings');
    }

    public function password()
    {
        return view('student.password');
    }
}
