@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Courses')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-book"></i> {{ __('Manage Courses') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Courses') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('All Courses') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add New Course') }}
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

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Level</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($course->image)
                                                        <img src="{{ asset('storage/courses/' . $course->image) }}"
                                                             alt="{{ $course->title }}"
                                                             width="50"
                                                             height="50"
                                                             style="object-fit: cover; border-radius: 5px;">
                                                    @else
                                                        <span class="badge badge-secondary">No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $course->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">Slug: {{ $course->slug }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $course->category->name ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    @if($course->discount_price)
                                                        <span class="text-muted"><s>${{ number_format($course->price) }}</s></span>
                                                        <br>
                                                        <span class="text-success font-weight-bold">${{ number_format($course->discount_price) }}</span>
                                                    @else
                                                        <span class="font-weight-bold">${{ number_format($course->price) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $course->level == 'beginner' ? 'success' : ($course->level == 'intermediate' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($course->level) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $course->status == 'active' ? 'success' : 'danger' }} badge-pill">
                                                        <i class="fas fa-{{ $course->status == 'active' ? 'check' : 'times' }}"></i>
                                                        {{ ucfirst($course->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('chapters.index', $course->id) }}"
                                                           class="btn btn-info" title="Manage Chapters">
                                                            <i class="fas fa-layer-group"></i>
                                                        </a>
                                                        <a href="{{ route('courses.edit', $course->id) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('courses.destroy', $course->id) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-book-open fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No courses found. Create your first course!</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
function confirmDelete(url) {
    if(confirm('Are you sure you want to delete this course? All related data will be deleted!')) {
        const form = document.createElement('form');
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
