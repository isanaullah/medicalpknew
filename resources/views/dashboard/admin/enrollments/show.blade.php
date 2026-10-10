@extends('dashboard.admin.layouts.app')

@section('page_title', 'Enrollment Details')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-user-graduate"></i> {{ __('Enrollment Details') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('enrollments.index') }}">{{ __('Enrollments') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Details') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Enrollment Information') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{ __('Enrollment Number') }}</strong></label>
                                        <p class="text-muted">{{ $enrollment->enrollment_number }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Student') }}</strong></label>
                                        <p class="text-muted">{{ $enrollment->user->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Email') }}</strong></label>
                                        <p class="text-muted">{{ $enrollment->user->email ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Course') }}</strong></label>
                                        <p class="text-muted">{{ $enrollment->course->title ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{ __('Status') }}</strong></label>
                                        <p>
                                            <span class="badge badge-{{ $enrollment->status_badge }}">
                                                {{ ucfirst($enrollment->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Progress') }}</strong></label>
                                        <div class="d-flex align-items-center">
                                            <div class="progress mr-2" style="height: 10px; width: 150px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width: {{ $enrollment->progress ?? 0 }}%"
                                                     aria-valuenow="{{ $enrollment->progress ?? 0 }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                            <span>{{ $enrollment->progress ?? 0 }}%</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Enrolled Date') }}</strong></label>
                                        <p class="text-muted">{{ $enrollment->enrollment_date }}</p>
                                    </div>
                                    @if($enrollment->expires_at)
                                    <div class="form-group">
                                        <label><strong>{{ __('Expires At') }}</strong></label>
                                        <p class="text-muted">{{ $enrollment->expires_at->format('M d, Y') }}</p>
                                    </div>
                                    @endif
                                    @if($enrollment->completed_at)
                                    <div class="form-group">
                                        <label><strong>{{ __('Completed At') }}</strong></label>
                                        <p class="text-muted">{{ $enrollment->completed_at->format('M d, Y') }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Quick Actions') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="btn-group-vertical w-100">
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-edit"></i> {{ __('Edit Enrollment') }}
                                </a>
                                <button onclick="deleteEnrollment({{ $enrollment->id }})" class="btn btn-danger btn-block">
                                    <i class="fas fa-trash"></i> {{ __('Delete Enrollment') }}
                                </button>
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
    function deleteEnrollment(id) {
        if (confirm('Are you sure you want to delete this enrollment?')) {
            var url = '{{ route("enrollments.destroy", ":id") }}'.replace(':id', id);
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.innerHTML = '@csrf @method('DELETE')';
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush
@endsection
