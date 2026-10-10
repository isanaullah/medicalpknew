@extends('dashboard.admin.layouts.app')

@section('page_title', 'Add Chapter')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-plus-circle"></i> {{ __('Add Chapter') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('chapters.index', $course->id) }}">{{ __('Chapters') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Add New') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Add Chapter to: ') }} <span class="text-primary">{{ $course->title }}</span></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('chapters.store', $course->id) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="title">{{ __('Chapter Title') }} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           placeholder="Enter chapter title"
                                           value="{{ old('title') }}"
                                           required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              rows="3"
                                              placeholder="Brief chapter description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
    <label for="video_url">{{ __('Video URL') }}</label>
    <textarea name="video_url"
              class="form-control @error('video_url') is-invalid @enderror"
              id="video_url"
              rows="3"
              placeholder="Enter chapter video URL">{{ old('video_url') }}</textarea>
    @error('video_url')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order">{{ __('Order') }}</label>
                                            <input type="number"
                                                   name="order"
                                                   class="form-control @error('order') is-invalid @enderror"
                                                   id="order"
                                                   placeholder="0"
                                                   value="{{ old('order', 0) }}"
                                                   min="0">
                                            @error('order')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration_minutes">{{ __('Duration (Minutes)') }}</label>
                                            <input type="number"
                                                   name="duration_minutes"
                                                   class="form-control @error('duration_minutes') is-invalid @enderror"
                                                   id="duration_minutes"
                                                   placeholder="e.g., 30"
                                                   value="{{ old('duration_minutes') }}"
                                                   min="1">
                                            @error('duration_minutes')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               name="is_free_preview"
                                               class="custom-control-input"
                                               id="is_free_preview"
                                               value="1"
                                               {{ old('is_free_preview') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_free_preview">
                                            <i class="fas fa-gift text-success"></i>
                                            {{ __('Is Free Preview?') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status" required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> {{ __('Create Chapter') }}
                                    </button>
                                    <a href="{{ route('chapters.index', $course->id) }}" class="btn btn-secondary btn-lg">
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
