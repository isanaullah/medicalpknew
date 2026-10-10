@extends('dashboard.admin.layouts.app')

@section('page_title', 'Add Blog Article')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-plus-circle"></i> {{ __('Add Blog Article') }}</h1>
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
                <div class="breadcrumb-item">{{ __('Add New') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Add Article to: ') }} <span class="text-primary">{{ $category->title }}</span></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blog.article.create', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">{{ __('Article Title') }} <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   id="title"
                                                   placeholder="Enter article title"
                                                   value="{{ old('title') }}"
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
                                                   value="{{ old('page_title') }}">
                                            @error('page_title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }}</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
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
                                                      placeholder="Enter meta description for SEO">{{ old('meta_desc') }}</textarea>
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
                                                      placeholder="Enter article content">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Featured Image') }}</label>
                                            <input type="file"
                                                   name="image"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   id="image"
                                                   accept="image/*">
                                            <small class="text-muted">Max 2MB (JPG, PNG, GIF, SVG)</small>
                                            @error('image')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Note:</strong> Slug will be automatically generated from the article title.
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> {{ __('Create Article') }}
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
