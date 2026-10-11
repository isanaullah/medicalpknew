@extends('layouts.student')

@section('title', 'My Wishlist — Verdant Academy')
@section('page-title', 'Wishlist')

@section('content')
<div class="page-head">
    <div><h1>Wishlist</h1><p>2 saved courses</p></div>
    <a href="{{ route('courses') }}" class="btn btn-outline"><i data-lucide="compass"></i> Browse courses</a>
  </div>
  <div class="grid g3"><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=70" alt="Product Design Foundations" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-gold">Bestseller</span>
      </div>
      <button class="thumb-fav on" data-action="wishlist" data-id="3" aria-label="Save course" aria-pressed="true">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Product Design</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 3) }}">Product Design Foundations</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=47" alt="" onerror="this.style.display='none'">
        <span>Priya Raghunathan</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.9</b> <span class="muted">(1,893)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>36h</span>
        <span><i data-lucide="play-circle"></i>142 lessons</span>
        <span><i data-lucide="signal"></i>Beginner</span>
      </div>
      <div class="course-foot">
        <span class="price">$79<s>$139</s></span>
        <a href="{{ route('course.detail', 3) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=70" alt="Digital Marketing Strategy" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-gold">Bestseller</span>
      </div>
      <button class="thumb-fav on" data-action="wishlist" data-id="5" aria-label="Save course" aria-pressed="true">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Digital Marketing</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 5) }}">Digital Marketing Strategy</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=26" alt="" onerror="this.style.display='none'">
        <span>Helena Marchetti</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.8</b> <span class="muted">(1,654)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>32h</span>
        <span><i data-lucide="play-circle"></i>126 lessons</span>
        <span><i data-lucide="signal"></i>Intermediate</span>
      </div>
      <div class="course-foot">
        <span class="price">$85<s>$149</s></span>
        <a href="{{ route('course.detail', 5) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article></div>
@endsection
