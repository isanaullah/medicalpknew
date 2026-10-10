@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Note')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Note') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('notes.index', $chapter->id) }}">{{ __('Notes') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Note: ') }} <span class="text-primary">{{ $note->title }}</span></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('notes.update', [$chapter->id, $note->id]) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">{{ __('Note Title') }} <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   id="title"
                                                   placeholder="Enter note title"
                                                   value="{{ old('title', $note->title) }}"
                                                   required>
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">{{ __('Content Type') }} <span class="text-danger">*</span></label>
                                            <select name="type"
                                                    class="form-control @error('type') is-invalid @enderror"
                                                    id="type"
                                                    required>
                                                <option value="text" {{ old('type', $note->type) == 'text' ? 'selected' : '' }}>Text</option>
                                                <option value="pdf" {{ old('type', $note->type) == 'pdf' ? 'selected' : '' }}>PDF</option>
                                                <option value="video" {{ old('type', $note->type) == 'video' ? 'selected' : '' }}>Video</option>
                                                <option value="audio" {{ old('type', $note->type) == 'audio' ? 'selected' : '' }}>Audio</option>
                                                <option value="quiz" {{ old('type', $note->type) == 'quiz' ? 'selected' : '' }}>Quiz</option>
                                                <option value="assignment" {{ old('type', $note->type) == 'assignment' ? 'selected' : '' }}>Assignment</option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order">{{ __('Order') }}</label>
                                            <input type="number"
                                                   name="order"
                                                   class="form-control @error('order') is-invalid @enderror"
                                                   id="order"
                                                   placeholder="0"
                                                   value="{{ old('order', $note->order) }}"
                                                   min="0">
                                            @error('order')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="excerpt">{{ __('Excerpt / Short Description') }}</label>
                                            <textarea name="excerpt"
                                                      class="form-control @error('excerpt') is-invalid @enderror"
                                                      id="excerpt"
                                                      rows="2"
                                                      placeholder="Brief description">{{ old('excerpt', $note->excerpt) }}</textarea>
                                            @error('excerpt')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="contentArea">
                                        <div class="form-group">
                                            <label for="content">{{ __('Full Content') }}</label>
                                            <textarea name="content"
                                                      class="form-control @error('content') is-invalid @enderror"
                                                      id="content"
                                                      rows="8"
                                                      placeholder="Write your content here...">{{ old('content', $note->content) }}</textarea>
                                            @error('content')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="featured_image">{{ __('Featured Image') }}</label>
                                            @if($note->featured_image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/notes/images/' . $note->featured_image) }}"
                                                         alt="{{ $note->title }}"
                                                         width="80"
                                                         height="80"
                                                         style="object-fit: cover; border-radius: 5px;">
                                                    <br>
                                                    <small class="text-muted">Current image</small>
                                                </div>
                                            @endif
                                            <input type="file"
                                                   name="featured_image"
                                                   class="form-control @error('featured_image') is-invalid @enderror"
                                                   id="featured_image"
                                                   accept="image/*">
                                            <small class="text-muted">Max 2MB (Leave empty to keep current)</small>
                                            @error('featured_image')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="file">{{ __('File Upload') }}</label>
                                            @if($note->file_path)
                                                <div class="mb-2">
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-file"></i>
                                                        {{ $note->file_path }}
                                                        <br>
                                                        <small>{{ $note->file_size }}</small>
                                                    </span>
                                                </div>
                                            @endif
                                            <input type="file"
                                                   name="file"
                                                   class="form-control @error('file') is-invalid @enderror"
                                                   id="file"
                                                   accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar">
                                            <small class="text-muted">Max 10MB (Leave empty to keep current)</small>
                                            @error('file')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="video_url">{{ __('Video URL') }}</label>
                                            <input type="url"
                                                   name="video_url"
                                                   class="form-control @error('video_url') is-invalid @enderror"
                                                   id="video_url"
                                                   placeholder="https://youtube.com/watch?v=..."
                                                   value="{{ old('video_url', $note->video_url) }}">
                                            <small class="text-muted">YouTube or Vimeo URL</small>
                                            @error('video_url')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror"
                                                    id="status"
                                                    required>
                                                <option value="draft" {{ old('status', $note->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="published" {{ old('status', $note->status) == 'published' ? 'selected' : '' }}>Published</option>
                                                <option value="archived" {{ old('status', $note->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="published_at">{{ __('Published Date') }}</label>
                                            <input type="datetime-local"
                                                   name="published_at"
                                                   class="form-control @error('published_at') is-invalid @enderror"
                                                   id="published_at"
                                                   value="{{ old('published_at', $note->published_at ? $note->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                                            @error('published_at')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                       name="is_free_preview"
                                                       class="custom-control-input"
                                                       id="is_free_preview"
                                                       value="1"
                                                       {{ old('is_free_preview', $note->is_free_preview) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_free_preview">
                                                    <i class="fas fa-gift text-success"></i>
                                                    {{ __('Is Free Preview?') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> {{ __('Update Note') }}
                                    </button>
                                    <a href="{{ route('notes.index', $chapter->id) }}" class="btn btn-secondary btn-lg">
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

@push('scripts')
<script>
document.getElementById('type').addEventListener('change', function() {
    const contentArea = document.getElementById('contentArea');
    if (this.value === 'text') {
        contentArea.style.display = 'block';
    } else {
        contentArea.style.display = 'none';
    }
});

// Trigger on load
document.addEventListener('DOMContentLoaded', function() {
    const type = document.getElementById('type');
    const contentArea = document.getElementById('contentArea');
    if (type.value === 'text') {
        contentArea.style.display = 'block';
    } else {
        contentArea.style.display = 'none';
    }
});
</script>
@endpush
@endsection
