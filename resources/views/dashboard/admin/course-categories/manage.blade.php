@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Course Categories')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-th-large"></i> {{ __('Manage Course Categories') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Categories') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('All Categories') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('course-categories.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add New Category') }}
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
                                            <th>Icon</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Courses</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($category->icon)
                                                        <i class="{{ $category->icon }} fa-2x text-primary"></i>
                                                    @else
                                                        <span class="badge badge-secondary">No Icon</span>
                                                    @endif
                                                </td>
                                                <td><strong>{{ $category->name }}</strong></td>
                                                <td><span class="badge badge-info">{{ $category->slug }}</span></td>
                                                <td>
                                                    <span class="badge badge-primary badge-pill">{{ $category->courses_count }}</span>
                                                </td>
                                                <td>{{ number_format($category->views_count) }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $category->status == 'active' ? 'success' : 'danger' }} badge-pill">
                                                        <i class="fas fa-{{ $category->status == 'active' ? 'check' : 'times' }}"></i>
                                                        {{ ucfirst($category->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('course-categories.edit', $category->id) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('course-categories.destroy', $category->id) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No categories found. Create your first category!</span>
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
    if(confirm('Are you sure you want to delete this category? This action cannot be undone!')) {
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
