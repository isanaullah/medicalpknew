@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Chapter')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Chapter') }}</h1>
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
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Chapter: ') }} <span class="text-primary">{{ $chapter->title }}</span></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('chapters.update', [$course->id, $chapter->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">{{ __('Chapter Title') }} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           placeholder="Enter chapter title"
                                           value="{{ old('title', $chapter->title) }}"
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
                                              placeholder="Brief chapter description">{{ old('description', $chapter->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                          <div class="form-group">
    <label for="video_url">{{ __('Video URL') }}</label>

    <input type="url"
           name="video_url"
           class="form-control @error('video_url') is-invalid @enderror"
           id="video_url"
           value="{{ old('video_url', $chapter->video_url) }}"
           placeholder="https://www.youtube.com/watch?v=...">

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
                                                   value="{{ old('order', $chapter->order) }}"
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
                                                   value="{{ old('duration_minutes', $chapter->duration_minutes) }}"
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
                                               {{ old('is_free_preview', $chapter->is_free_preview) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_free_preview">
                                            <i class="fas fa-gift text-success"></i>
                                            {{ __('Is Free Preview?') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status" required>
                                        <option value="draft" {{ old('status', $chapter->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $chapter->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> {{ __('Update Chapter') }}
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
