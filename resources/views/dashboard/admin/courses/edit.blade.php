@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Course')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Course') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Course') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">{{ __('Course Title') }} <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   id="title"
                                                   placeholder="Enter course title"
                                                   value="{{ old('title', $course->title) }}"
                                                   required>
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_category_id">{{ __('Category') }} <span class="text-danger">*</span></label>
                                            <select name="course_category_id"
                                                    class="form-control @error('course_category_id') is-invalid @enderror"
                                                    id="course_category_id"
                                                    required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('course_category_id', $course->course_category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('course_category_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">{{ __('Price') }} <span class="text-danger">*</span></label>
                                            <input type="number"
                                                   name="price"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   id="price"
                                                   placeholder="0"
                                                   value="{{ old('price', $course->price) }}"
                                                   min="0"
                                                   >
                                            @error('price')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_price">{{ __('Discount Price') }}</label>
                                            <input type="number"
                                                   name="discount_price"
                                                   class="form-control @error('discount_price') is-invalid @enderror"
                                                   id="discount_price"
                                                   placeholder="0"
                                                   value="{{ old('discount_price', $course->discount_price) }}"
                                                   min="0">
                                            <small class="text-muted">Must be less than regular price</small>
                                            @error('discount_price')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="level">{{ __('Level') }} <span class="text-danger">*</span></label>
                                            <select name="level" class="form-control @error('level') is-invalid @enderror" id="level" required>
                                                <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                                <option value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                <option value="expert" {{ old('level', $course->level) == 'expert' ? 'selected' : '' }}>Expert</option>
                                            </select>
                                            @error('level')
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
                                                   placeholder="e.g., 120"
                                                   value="{{ old('duration_minutes', $course->duration_minutes) }}"
                                                   min="1">
                                            @error('duration_minutes')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">{{ __('Short Description') }}</label>
                                            <textarea name="short_description"
                                                      class="form-control @error('short_description') is-invalid @enderror"
                                                      id="short_description"
                                                      rows="2"
                                                      placeholder="Brief description (max 500 characters)">{{ old('short_description', $course->short_description) }}</textarea>
                                            @error('short_description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">{{ __('Full Description') }}</label>
                                            <textarea name="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      id="description"
                                                      rows="5"
                                                      placeholder="Detailed course description">{{ old('description', $course->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Course Image') }}</label>
                                            @if($course->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/courses/' . $course->image) }}"
                                                         alt="{{ $course->title }}"
                                                         width="100"
                                                         height="100"
                                                         style="object-fit: cover; border-radius: 5px;">
                                                </div>
                                            @endif
                                            <input type="file"
                                                   name="image"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   id="image"
                                                   accept="image/*">
                                            <small class="text-muted">Max 2MB (Leave empty to keep current image)</small>
                                            @error('image')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status" required>
                                                <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $course->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> {{ __('Update Course') }}
                                    </button>
                                    <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-lg">
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
