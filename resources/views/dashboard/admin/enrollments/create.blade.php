@extends('dashboard.admin.layouts.app')

@section('page_title', 'Enroll Student')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-user-plus"></i> {{ __('Enroll Student') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('enrollments.index') }}">{{ __('Enrollments') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Enroll Student') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Enroll Student in Courses') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('enrollments.bulk') }}" class="btn btn-success">
                                    <i class="fas fa-users"></i> {{ __('Bulk Enroll') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            @endif

                            <form action="{{ route('enrollments.store') }}" method="POST">
                                @csrf

                                <!-- Select Student -->
                                <div class="form-group">
                                    <label for="user_id">{{ __('Select Student') }} <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">{{ __('-- Select Student --') }}</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Select Courses with Checkboxes -->
                                <div class="form-group">
                                    <label>{{ __('Select Courses') }} <span class="text-danger">*</span></label>
                                    <div class="border rounded-lg p-3 bg-light" style="max-height: 300px; overflow-y: auto;">
                                        @foreach($courses as $course)
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox"
                                                       name="course_ids[]"
                                                       value="{{ $course->id }}"
                                                       id="course_{{ $course->id }}"
                                                       class="custom-control-input course-checkbox"
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
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Check all the courses you want to enroll the student in.
                                    </small>
                                    <div class="mt-2">
                                        <span class="text-muted">Selected: <span id="selectedCount">0</span> courses</span>
                                        <button type="button" class="btn btn-sm btn-link" onclick="selectAllCourses()">Select All</button>
                                        <button type="button" class="btn btn-sm btn-link" onclick="deselectAllCourses()">Deselect All</button>
                                    </div>
                                    @error('course_ids')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Enrolled Courses -->
                                <div class="form-group" id="enrolled-courses-container">
                                    <label>{{ __('Already Enrolled Courses') }}</label>
                                    <div id="enrolled-courses-list" class="text-muted p-3 border rounded-lg">
                                        <p class="text-muted mb-0">Select a student to see enrolled courses.</p>
                                    </div>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expires_at">{{ __('Expiry Date (Optional)') }}</label>
                                            <input type="datetime-local" name="expires_at" class="form-control @error('expires_at') is-invalid @enderror"
                                                   id="expires_at" value="{{ old('expires_at') }}">
                                            @error('expires_at')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Note:</strong>
                                    <ul class="mb-0 mt-1">
                                        <li>Enrollment numbers will be auto-generated.</li>
                                        <li>Progress starts at 0%.</li>
                                        <li>Students will be enrolled in all selected courses.</li>
                                    </ul>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> {{ __('Enroll Student') }}
                                    </button>
                                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-lg">
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
    $(document).ready(function() {
        // Function to load enrolled courses
        function loadEnrolledCourses(userId) {
            if (!userId) {
                $('#enrolled-courses-list').html('<p class="text-muted mb-0">Select a student to see enrolled courses.</p>');
                return;
            }

            // Show loading state
            $('#enrolled-courses-list').html('<p class="text-muted mb-0"><i class="fas fa-spinner fa-spin"></i> Loading enrolled courses...</p>');

            var enrolledRoute = '{{ route("enrollments.user.enrolled", ":userId") }}';
            var url = enrolledRoute.replace(':userId', userId);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var html = '';
                    if (response.length > 0) {
                        html = '<div class="row">';
                        response.forEach(function(enrollment) {
                            var statusBadge = enrollment.status_badge || 'secondary';
                            html += '<div class="col-md-6">';
                            html += '<div class="d-flex align-items-center justify-content-between p-2 border-bottom">';
                            html += '<span><i class="fas fa-book text-primary mr-2"></i> ' + enrollment.course.title + '</span>';
                            html += ' <span class="badge badge-' + statusBadge + '">' + enrollment.status + '</span>';
                            html += '</div>';
                            html += '</div>';
                        });
                        html += '</div>';
                    } else {
                        html = '<p class="text-muted mb-0">This student is not enrolled in any courses yet.</p>';
                    }
                    $('#enrolled-courses-list').html(html);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                    $('#enrolled-courses-list').html('<p class="text-danger mb-0">Error loading enrolled courses. Please try again.</p>');
                }
            });
        }

        // When student is selected, load their enrolled courses
        $('#user_id').change(function() {
            var userId = $(this).val();
            loadEnrolledCourses(userId);
        });

        // Load enrolled courses if student is already selected on page load
        var initialUserId = $('#user_id').val();
        if (initialUserId) {
            loadEnrolledCourses(initialUserId);
        }
    });
</script>
@endpush
@endsection
