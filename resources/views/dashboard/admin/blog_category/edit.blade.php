@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Blog Category')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Blog Category') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('blog.category.view') }}">{{ __('Blog Categories') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Category') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blog.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">{{ __('Category Title') }} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           placeholder="Enter category title"
                                           value="{{ old('title', $category->title) }}"
                                           required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="page_title">{{ __('Page Title') }}</label>
                                    <input type="text"
                                           name="page_title"
                                           class="form-control @error('page_title') is-invalid @enderror"
                                           id="page_title"
                                           placeholder="Enter page title for SEO"
                                           value="{{ old('page_title', $category->page_title) }}">
                                    @error('page_title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="meta_desc">{{ __('Meta Description') }}</label>
                                    <textarea name="meta_desc"
                                              class="form-control @error('meta_desc') is-invalid @enderror"
                                              id="meta_desc"
                                              rows="2"
                                              placeholder="Enter meta description for SEO">{{ old('meta_desc', $category->meta_desc) }}</textarea>
                                    @error('meta_desc')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              rows="4"
                                              placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">{{ __('Category Image') }}</label>
                                    @if($category->image && $category->image != 'blog/category/no_img.jpg')
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                 alt="{{ $category->title }}"
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

                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                        <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Current Slug:</strong> <code>{{ $category->slug }}</code> (Auto-generated)
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ __('Update Category') }}
                                    </button>
                                    <a href="{{ route('blog.category.view') }}" class="btn btn-secondary">
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
