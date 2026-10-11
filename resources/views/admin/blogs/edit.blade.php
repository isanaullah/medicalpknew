@extends('layouts.admin')

@section('title', 'Edit Article: ' . $blog->title . ' — Verdant Academy')
@section('page-title', 'Edit Blog Article')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.blog') }}">Blog Articles</a><span class="sep">/</span>
    <span>Edit</span>
  </nav>

  <div class="page-head">
    <div>
      <h1>Edit Article: {{ $blog->title }}</h1>
      <p>Modify article text, image, category, and metadata.</p>
    </div>
    <div>
      <a href="{{ route('admin.blog') }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> Back to Articles
      </a>
    </div>
  </div>

  @if ($errors->any())
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:24px">
      <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card" style="max-width:950px;margin:0 auto;padding:28px">
    <form method="POST" action="{{ route('admin.blog.update', $blog->slug) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="field" style="margin-bottom:18px">
        <label class="label">Article Title <span style="color:var(--danger)">*</span></label>
        <input class="input" name="title" required value="{{ old('title', $blog->title) }}">
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Slug</label>
        <input class="input" name="slug" value="{{ old('slug', $blog->slug) }}">
      </div>

      <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px">
        <div class="field">
          <label class="label">Category</label>
          <select class="select" name="blog_category_id">
            <option value="">-- Select Category --</option>
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="field">
          <label class="label">Status <span style="color:var(--danger)">*</span></label>
          <select class="select" name="status">
            <option value="Published" {{ old('status', $blog->status) === 'Published' ? 'selected' : '' }}>Published</option>
            <option value="Draft" {{ old('status', $blog->status) === 'Draft' ? 'selected' : '' }}>Draft</option>
            <option value="Archived" {{ old('status', $blog->status) === 'Archived' ? 'selected' : '' }}>Archived</option>
          </select>
        </div>
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Featured Image</label>
        @if ($blog->featured_image)
          <div style="margin-bottom:10px">
            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured" style="max-height:120px;border-radius:6px;border:1px solid var(--cream-300)">
          </div>
        @endif
        <input type="file" name="image_file" class="input" accept="image/*">
        <small class="muted">Upload new image to replace current.</small>
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Excerpt</label>
        <textarea class="textarea" name="excerpt" rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Article Body Content <span style="color:var(--danger)">*</span></label>
        <textarea class="textarea" name="content" rows="10" required>{{ old('content', $blog->content) }}</textarea>
      </div>

      <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:24px">
        <div class="field">
          <label class="label">SEO Title</label>
          <input class="input" name="seo_title" value="{{ old('seo_title', $blog->seo_title) }}">
        </div>
        <div class="field">
          <label class="label">SEO Description</label>
          <input class="input" name="seo_description" value="{{ old('seo_description', $blog->seo_description) }}">
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:12px;border-top:1px solid var(--cream-200);padding-top:18px">
        <a href="{{ route('admin.blog') }}" class="btn btn-ghost">Cancel</a>
        <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update Article</button>
      </div>
    </form>
  </div>
@endsection
