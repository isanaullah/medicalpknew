@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Chapters')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-layer-group"></i> {{ __('Manage Chapters') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Chapters') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ __('Chapters for: ') }}
                                <span class="text-primary">{{ $course->title }}</span>
                            </h4>
                            <div class="card-header-action">
                                <a href="{{ route('chapters.create', $course->id) }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add New Chapter') }}
                                </a>
                                <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{ __('Back to Courses') }}
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
                                            <th>Order</th>
                                            <th>Title</th>
                                            <th>Duration</th>
                                            <th>Free Preview</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($chapters as $chapter)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="badge badge-secondary">{{ $chapter->order }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $chapter->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($chapter->description, 50) }}</small>
                                                </td>
                                                <td>
                                                    @if($chapter->duration_minutes)
                                                        <span class="badge badge-info">
                                                            <i class="fas fa-clock"></i> {{ $chapter->duration_minutes }} min
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($chapter->is_free_preview)
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-check"></i> Yes
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $chapter->status == 'published' ? 'success' : 'warning' }} badge-pill">
                                                        <i class="fas fa-{{ $chapter->status == 'published' ? 'check' : 'pencil-alt' }}"></i>
                                                        {{ ucfirst($chapter->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('notes.index', $chapter->id) }}"
                                                           class="btn btn-info" title="Manage Notes">
                                                            <i class="fas fa-sticky-note"></i>
                                                        </a>
                                                        <a href="{{ route('chapters.edit', [$course->id, $chapter->id]) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('chapters.destroy', [$course->id, $chapter->id]) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <i class="fas fa-layer-group fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No chapters found. Create your first chapter!</span>
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
    if(confirm('Are you sure you want to delete this chapter? All notes will be deleted!')) {
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
