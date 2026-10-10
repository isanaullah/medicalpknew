@extends('dashboard.admin.layouts.app')

@section('page_title', 'Add YouTube Video')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fab fa-youtube"></i> {{ __('Add YouTube Video') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('youtube.index') }}">{{ __('YouTube Videos') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Add New') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Video Details') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('youtube.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="title">{{ __('Video Title') }} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           placeholder="Enter video title"
                                           value="{{ old('title') }}"
                                           required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="video_url">{{ __('YouTube URL') }} <span class="text-danger">*</span></label>
                                    <input type="url"
                                           name="video_url"
                                           class="form-control @error('video_url') is-invalid @enderror"
                                           id="video_url"
                                           placeholder="https://www.youtube.com/watch?v=VIDEO_ID"
                                           value="{{ old('video_url') }}"
                                           required>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Enter the full YouTube URL (e.g., https://www.youtube.com/watch?v=VIDEO_ID)
                                    </small>
                                    @error('video_url')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject">{{ __('Subject / Category') }}</label>
                                            <input type="text"
                                                   name="subject"
                                                   class="form-control @error('subject') is-invalid @enderror"
                                                   id="subject"
                                                   placeholder="e.g., Chemistry, Biology, Physics"
                                                   value="{{ old('subject') }}">
                                            @error('subject')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="views">{{ __('View Count Display') }}</label>
                                            <input type="text"
                                                   name="views"
                                                   class="form-control @error('views') is-invalid @enderror"
                                                   id="views"
                                                   placeholder="e.g., 412K views"
                                                   value="{{ old('views') }}">
                                            @error('views')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
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
                                            <small class="form-text text-muted">Lower numbers appear first</small>
                                            @error('order')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thumbnail">{{ __('Custom Thumbnail') }}</label>
                                            <input type="file"
                                                   name="thumbnail"
                                                   class="form-control @error('thumbnail') is-invalid @enderror"
                                                   id="thumbnail"
                                                   accept="image/*">
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle"></i>
                                                Leave empty to use YouTube's default thumbnail. Max 2MB (JPG, PNG, GIF, WEBP)
                                            </small>
                                            @error('thumbnail')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                       name="is_featured"
                                                       class="custom-control-input"
                                                       id="is_featured"
                                                       value="1"
                                                       {{ old('is_featured') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_featured">
                                                    <i class="fas fa-star text-warning"></i>
                                                    {{ __('Featured Video') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                       name="status"
                                                       class="custom-control-input"
                                                       id="status"
                                                       value="1"
                                                       {{ old('status', '1') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status">
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    {{ __('Active') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Note:</strong> The video ID and embed URL will be automatically extracted from the YouTube URL.
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ __('Add Video') }}
                                    </button>
                                    <a href="{{ route('youtube.index') }}" class="btn btn-secondary" style="color:black;">
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