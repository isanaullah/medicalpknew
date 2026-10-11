@extends('layouts.admin')

@section('title', 'Course Management — Verdant Academy')
@section('page-title', 'Course Management')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Courses</span>
  </nav>

  @if (session('success'))
    <div style="padding:14px 18px;background:var(--success-bg);color:var(--success);border-radius:var(--radius);border:1px solid #cce1c4;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="check-circle" style="width:18px;height:18px"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if (session('error'))
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="alert-circle" style="width:18px;height:18px"></i>
      <span>{{ session('error') }}</span>
    </div>
  @endif

  <div class="page-head">
    <div>
      <h1>Course Management</h1>
      <p>{{ $stats['total'] }} total courses · {{ $stats['published'] }} published · {{ $stats['draft'] }} drafts · {{ $stats['paid'] }} paid · {{ $stats['free'] }} free</p>
    </div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
        <i data-lucide="plus"></i> Add new course
      </a>
    </div>
  </div>

  <div class="table-wrap">
    <form method="GET" action="{{ route('admin.courses') }}" class="table-toolbar" style="flex-wrap:wrap;gap:10px">
      <div class="search" style="min-width:240px">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" name="search" type="search" placeholder="Search courses by title…" value="{{ request('search') }}">
      </div>
      
      <select name="category" class="select" style="max-width:180px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All categories">All categories</option>
        @foreach ($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>

      <select name="type" class="select" style="max-width:140px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All types">All types</option>
        <option value="Paid" {{ request('type') === 'Paid' ? 'selected' : '' }}>Paid</option>
        <option value="Free" {{ request('type') === 'Free' ? 'selected' : '' }}>Free</option>
      </select>

      <select name="level" class="select" style="max-width:140px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All levels">All levels</option>
        <option value="Beginner" {{ request('level') === 'Beginner' ? 'selected' : '' }}>Beginner</option>
        <option value="Intermediate" {{ request('level') === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
        <option value="Advanced" {{ request('level') === 'Advanced' ? 'selected' : '' }}>Advanced</option>
      </select>

      <select name="status" class="select" style="max-width:140px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All statuses">All statuses</option>
        <option value="Published" {{ request('status') === 'Published' ? 'selected' : '' }}>Published</option>
        <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
        <option value="Archived" {{ request('status') === 'Archived' ? 'selected' : '' }}>Archived</option>
      </select>

      <button type="submit" class="btn btn-outline btn-sm">Filter</button>
      @if (request()->hasAny(['search', 'category', 'type', 'level', 'status']))
        <a href="{{ route('admin.courses') }}" class="btn btn-outline btn-sm" style="margin-left:auto">
          <i data-lucide="filter-x"></i> Clear
        </a>
      @endif
    </form>

    <div class="table-scroll">
      <table class="tbl">
        <thead>
          <tr>
            <th>Course</th>
            <th>Type</th>
            <th>Price</th>
            <th>Category</th>
            <th>Lessons</th>
            <th>Status</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($courses as $c)
            <tr>
              <td>
                <div class="cell-main">
                  <img src="{{ $c->thumbnail_url }}" alt="" style="width:48px;height:34px;object-fit:cover;border-radius:6px;flex:none" onerror="this.style.display='none'">
                  <div>
                    <div class="t">
                      <a href="{{ route('admin.courses.show', $c->slug) }}" style="text-decoration:none;color:inherit;font-weight:600">
                        {{ $c->title }}
                      </a>
                    </div>
                    <div class="s">{{ $c->level }} · {{ $c->duration ?? 'Self-paced' }}</div>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge {{ $c->isPaid() ? 'badge-wine' : 'badge-forest' }}">
                  {{ $c->type }}
                </span>
              </td>
              <td>
                @if ($c->isFree())
                  <b style="color:var(--success)">Free ($0.00)</b>
                @else
                  <b style="color:var(--wine-800)">${{ number_format($c->price, 2) }}</b>
                  @if ($c->discount_price)
                    <br><s class="muted" style="font-size:12px">${{ number_format($c->discount_price, 2) }} sale</s>
                  @endif
                @endif
              </td>
              <td>
                @if ($c->category)
                  <span class="badge badge-amber">{{ $c->category->name }}</span>
                @else
                  <span class="small muted">Uncategorized</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.curriculum', ['course_id' => $c->slug]) }}" style="color:var(--wine-700);text-decoration:none;font-weight:600">
                  {{ $c->lessons_count }} lessons
                </a>
              </td>
              <td>
                <span class="badge {{ $c->status === 'Published' ? 'badge-success' : ($c->status === 'Draft' ? 'badge-amber' : 'badge-danger') }}">
                  {{ $c->status }}
                </span>
              </td>
              <td>
                <div class="row-actions">
                  <a href="{{ route('admin.courses.show', $c->slug) }}" class="mini-btn" title="View details & Preview video">
                    <i data-lucide="eye"></i>
                  </a>
                  <a href="{{ route('admin.curriculum', ['course_id' => $c->slug]) }}" class="mini-btn" title="Course Builder / Curriculum">
                    <i data-lucide="layers"></i>
                  </a>
                  <a href="{{ route('admin.courses.edit', $c->slug) }}" class="mini-btn" title="Edit course">
                    <i data-lucide="pencil"></i>
                  </a>
                  <form method="POST" action="{{ route('admin.courses.toggle-publish', $c->slug) }}" style="display:inline">
                    @csrf
                    <button type="submit" class="mini-btn" title="Toggle publish">
                      <i data-lucide="{{ $c->status === 'Published' ? 'eye-off' : 'upload' }}"></i>
                    </button>
                  </form>
                  <button type="button" class="mini-btn danger" title="Delete" data-action="delete-row" data-name="{{ $c->title }}" data-url="{{ route('admin.courses.destroy', $c->slug) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align:center;padding:36px;color:var(--ink-400)">
                No courses found matching your criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($courses->hasPages())
      <div class="table-foot">
        <span>Showing <b style="color:var(--ink-900)">{{ $courses->firstItem() }}–{{ $courses->lastItem() }}</b> of <b style="color:var(--ink-900)">{{ $courses->total() }}</b> records</span>
        <div class="pager">
          @if ($courses->onFirstPage())
            <button disabled><i data-lucide="chevron-left" style="width:14px;height:14px"></i></button>
          @else
            <a href="{{ $courses->previousPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-left" style="width:14px;height:14px"></i></a>
          @endif

          @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $p => $u)
            @if ($p == $courses->currentPage())
              <button class="active">{{ $p }}</button>
            @else
              <a href="{{ $u }}" class="btn btn-sm btn-ghost">{{ $p }}</a>
            @endif
          @endforeach

          @if ($courses->hasMorePages())
            <a href="{{ $courses->nextPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-right" style="width:14px;height:14px"></i></a>
          @else
            <button disabled><i data-lucide="chevron-right" style="width:14px;height:14px"></i></button>
          @endif
        </div>
      </div>
    @endif
  </div>
@endsection
