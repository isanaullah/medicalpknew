@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Enrollment')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Enrollment') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('enrollments.index') }}">{{ __('Enrollments') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Enrollment') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="user_id">{{ __('Student') }} <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $enrollment->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="course_id">{{ __('Course') }} <span class="text-danger">*</span></label>
                                    <select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror" required>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }}</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                                <option value="active" {{ old('status', $enrollment->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="completed" {{ old('status', $enrollment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ old('status', $enrollment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="expired" {{ old('status', $enrollment->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="progress">{{ __('Progress (%)') }}</label>
                                            <input type="number" name="progress" class="form-control @error('progress') is-invalid @enderror"
                                                   id="progress" value="{{ old('progress', $enrollment->progress) }}" min="0" max="100">
                                            @error('progress')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="expires_at">{{ __('Expiry Date') }}</label>
                                    <input type="datetime-local" name="expires_at" class="form-control @error('expires_at') is-invalid @enderror"
                                           id="expires_at" value="{{ old('expires_at', $enrollment->expires_at ? $enrollment->expires_at->format('Y-m-d\TH:i') : '') }}">
                                    @error('expires_at')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Enrollment Number:</strong> {{ $enrollment->enrollment_number }}
                                    <br>
                                    <strong>Enrolled Date:</strong> {{ $enrollment->enrollment_date }}
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ __('Update Enrollment') }}
                                    </button>
                                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">
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
