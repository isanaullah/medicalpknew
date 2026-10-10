@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Enrollments')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-user-graduate"></i> {{ __('Manage Enrollments') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Enrollments') }}</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Enrollments</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['total'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Active</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['active'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Completed</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['completed'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Cancelled</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['cancelled'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('All Enrollments') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> {{ __('Enroll Student') }}
                            </a>
                            <a href="{{ route('enrollments.bulk') }}" class="btn btn-success">
                                <i class="fas fa-users"></i> {{ __('Bulk Enroll') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Enrollment #</th>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Enrolled Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="font-weight-bold">{{ $enrollment->enrollment_number }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 32px; height: 32px; font-size: 14px;">
                                                        {{ strtoupper(substr($enrollment->user->name ?? 'N/A', 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold">{{ $enrollment->user->name ?? 'N/A' }}</div>
                                                        <small class="text-muted">{{ $enrollment->user->email ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $enrollment->course->title ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress mr-2" style="height: 8px; width: 100px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                             style="width: {{ $enrollment->progress ?? 0 }}%"
                                                             aria-valuenow="{{ $enrollment->progress ?? 0 }}"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <span>{{ $enrollment->progress ?? 0 }}%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $enrollment->status_badge }}">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $enrollment->enrollment_date }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('enrollments.show', $enrollment->id) }}"
                                                       class="btn btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                                       class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-danger"
                                                            title="Delete"
                                                            onclick="confirmDelete({{ $enrollment->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <i class="fas fa-user-graduate fa-3x text-muted mb-3 d-block"></i>
                                                <span class="text-muted">No enrollments found.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $enrollments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
function confirmDelete(id) {
    if(confirm('Are you sure you want to delete this enrollment? This action cannot be undone!')) {
        // Use the correct route with the ID parameter
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
