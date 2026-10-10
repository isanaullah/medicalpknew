@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Blog Article')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Blog Article') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('blog.category.view') }}">{{ __('Blog Categories') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('blog.article.view', $category->id) }}">{{ __('Articles') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Article') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blog.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">{{ __('Article Title') }} <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   id="title"
                                                   placeholder="Enter article title"
                                                   value="{{ old('title', $article->title) }}"
                                                   required>
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="page_title">{{ __('Page Title (SEO)') }}</label>
                                            <input type="text"
                                                   name="page_title"
                                                   class="form-control @error('page_title') is-invalid @enderror"
                                                   id="page_title"
                                                   placeholder="Enter page title for SEO"
                                                   value="{{ old('page_title', $article->page_title) }}">
                                            @error('page_title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }}</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                                <option value="1" {{ old('status', $article->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $article->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_desc">{{ __('Meta Description (SEO)') }}</label>
                                            <textarea name="meta_desc"
                                                      class="form-control @error('meta_desc') is-invalid @enderror"
                                                      id="meta_desc"
                                                      rows="2"
                                                      placeholder="Enter meta description for SEO">{{ old('meta_desc', $article->meta_desc) }}</textarea>
                                            @error('meta_desc')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">{{ __('Description') }}</label>
                                            <textarea name="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      id="description"
                                                      rows="6"
                                                      placeholder="Enter article content">{{ old('description', $article->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Featured Image') }}</label>
                                            @if($article->image && $article->image != 'blog/article/no_img.jpg')
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $article->image) }}"
                                                         alt="{{ $article->title }}"
                                                         width="80"
                                                         height="80"
                                                         style="object-fit: cover; border-radius: 5px;">
                                                    <br>
                                                    <small class="text-muted">Current image</small>
                                                </div>
                                            @endif
                                            <input type="file"
                                                   name="image"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   id="image"
                                                   accept="image/*">
                                            <small class="text-muted">Max 2MB (Leave empty to keep current)</small>
                                            @error('image')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Current Slug:</strong> <code>{{ $article->slug }}</code> (Auto-generated)
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> {{ __('Update Article') }}
                                    </button>
                                    <a href="{{ route('blog.article.view', $category->id) }}" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
