@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Course Category')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Course Category') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('course-categories.index') }}">{{ __('Categories') }}</a>
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
                            <form action="{{ route('course-categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">{{ __('Category Name') }} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           placeholder="Enter category name"
                                           value="{{ old('name', $category->name) }}"
                                           required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="icon">{{ __('Icon Class') }}</label>
                                    <input type="text"
                                           name="icon"
                                           class="form-control @error('icon') is-invalid @enderror"
                                           id="icon"
                                           placeholder="e.g., fas fa-graduation-cap"
                                           value="{{ old('icon', $category->icon) }}">
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Enter FontAwesome icon class (e.g., <code>fas fa-book</code>)
                                    </small>
                                    @error('icon')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                        <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                    <a href="{{ route('course-categories.index') }}" class="btn btn-secondary">
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
