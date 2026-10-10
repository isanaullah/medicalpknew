@extends('dashboard.admin.layouts.app')

@section('page_title', 'Bulk Enrollment')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-users"></i> {{ __('Bulk Enrollment') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('enrollments.index') }}">{{ __('Enrollments') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Bulk Enrollment') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Bulk Enroll Students in Courses') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
                                    <i class="fas fa-user-plus"></i> {{ __('Single Enrollment') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('enrollments.bulk.store') }}" method="POST">
                                @csrf

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Bulk Enrollment:</strong> Select multiple students and multiple courses to enroll them all at once.
                                </div>

                                <!-- Select Students with Checkboxes -->
                                <div class="form-group">
                                    <label>{{ __('Select Students') }} <span class="text-danger">*</span></label>
                                    <div class="border rounded-lg p-3 bg-light" style="max-height: 250px; overflow-y: auto;">
                                        @foreach($users as $user)
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox"
                                                       name="user_ids[]"
                                                       value="{{ $user->id }}"
                                                       id="user_{{ $user->id }}"
                                                       class="custom-control-input user-checkbox"
                                                       {{ in_array($user->id, old('user_ids', [])) ? 'checked' : '' }}>
                                                <label class="custom-control-label d-flex align-items-center justify-content-between w-100"
                                                       for="user_{{ $user->id }}">
                                                    <span>
                                                        <i class="fas fa-user text-primary mr-2"></i>
                                                        {{ $user->name }}
                                                    </span>
                                                    <span class="badge badge-secondary">{{ $user->email }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-2">
                                        <span class="text-muted">Selected: <span id="studentCount">0</span> students</span>
                                        <button type="button" class="btn btn-sm btn-link" onclick="selectAllStudents()">Select All</button>
                                        <button type="button" class="btn btn-sm btn-link" onclick="deselectAllStudents()">Deselect All</button>
                                    </div>
                                    @error('user_ids')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Select Courses with Checkboxes -->
                                <div class="form-group">
                                    <label>{{ __('Select Courses') }} <span class="text-danger">*</span></label>
                                    <div class="border rounded-lg p-3 bg-light" style="max-height: 250px; overflow-y: auto;">
                                        @foreach($courses as $course)
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox"
                                                       name="course_ids[]"
                                                       value="{{ $course->id }}"
                                                       id="course_{{ $course->id }}"
                                                       class="custom-control-input bulk-course-checkbox"
                                                       {{ in_array($course->id, old('course_ids', [])) ? 'checked' : '' }}>
                                                <label class="custom-control-label d-flex align-items-center justify-content-between w-100"
                                                       for="course_{{ $course->id }}">
                                                    <span>
                                                        <i class="fas fa-book text-primary mr-2"></i>
                                                        {{ $course->title }}
                                                    </span>
                                                    <span class="badge badge-info">{{ $course->category->name ?? 'General' }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-2">
                                        <span class="text-muted">Selected: <span id="courseCount">0</span> courses</span>
                                        <button type="button" class="btn btn-sm btn-link" onclick="selectAllCourses()">Select All</button>
                                        <button type="button" class="btn btn-sm btn-link" onclick="deselectAllCourses()">Deselect All</button>
                                    </div>
                                    @error('course_ids')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }}</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Note:</strong>
                                    <ul class="mb-0 mt-1">
                                        <li>Students who are already enrolled in a course will be skipped.</li>
                                        <li>Enrollment numbers will be auto-generated.</li>
                                        <li>Progress starts at 0%.</li>
                                    </ul>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-users"></i> {{ __('Bulk Enroll') }}
                                    </button>
                                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Selection Summary') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="bg-primary text-white p-3 rounded-lg">
                                        <h3 class="mb-0" id="totalStudents">0</h3>
                                        <p class="mb-0">Students Selected</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-success text-white p-3 rounded-lg">
                                        <h3 class="mb-0" id="totalCourses">0</h3>
                                        <p class="mb-0">Courses Selected</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-warning text-dark p-3 rounded-lg">
                                        <h3 class="mb-0" id="totalEnrollments">0</h3>
                                        <p class="mb-0">Total Enrollments</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Update counts for Bulk page
        function updateBulkCounts() {
            var students = $('.user-checkbox:checked').length;
            var courses = $('.bulk-course-checkbox:checked').length;
            var total = students * courses;

            $('#studentCount').text(students);
            $('#courseCount').text(courses);
            $('#totalStudents').text(students);
            $('#totalCourses').text(courses);
            $('#totalEnrollments').text(total);
        }

        // Initial counts
        updateBulkCounts();

        // Update counts on change
        $('.user-checkbox, .bulk-course-checkbox').change(function() {
            updateBulkCounts();
        });

        // Select/Deselect All Students
        window.selectAllStudents = function() {
            $('.user-checkbox').prop('checked', true);
            updateBulkCounts();
        };

        window.deselectAllStudents = function() {
            $('.user-checkbox').prop('checked', false);
            updateBulkCounts();
        };

        // Select/Deselect All Courses
        window.selectAllCourses = function() {
            $('.bulk-course-checkbox').prop('checked', true);
            updateBulkCounts();
        };

        window.deselectAllCourses = function() {
            $('.bulk-course-checkbox').prop('checked', false);
            updateBulkCounts();
        };
    });
</script>
@endpush
@endsection
