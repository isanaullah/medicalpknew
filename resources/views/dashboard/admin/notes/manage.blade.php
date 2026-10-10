@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Notes')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-sticky-note"></i> {{ __('Manage Notes') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('chapters.index', $chapter->course_id) }}">{{ __('Chapters') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Notes') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ __('Notes for: ') }}
                                <span class="text-primary">{{ $chapter->title }}</span>
                            </h4>
                            <div class="card-header-action">
                                <a href="{{ route('notes.create', $chapter->id) }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add New Note') }}
                                </a>
                                <a href="{{ route('chapters.index', $chapter->course_id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{ __('Back to Chapters') }}
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
                                            <th>Featured</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>File</th>
                                            <th>Free</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($notes as $note)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($note->featured_image)
                                                        <img src="{{ asset('storage/notes/images/' . $note->featured_image) }}"
                                                             alt="{{ $note->title }}"
                                                             width="40"
                                                             height="40"
                                                             style="object-fit: cover; border-radius: 5px;">
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $note->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($note->excerpt, 40) }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $note->type == 'video' ? 'danger' : ($note->type == 'pdf' ? 'warning' : 'info') }}">
                                                        <i class="fas fa-{{ $note->type == 'video' ? 'video' : ($note->type == 'pdf' ? 'file-pdf' : ($note->type == 'audio' ? 'music' : 'file-alt')) }}"></i>
                                                        {{ ucfirst($note->type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($note->file_path)
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-file"></i>
                                                            {{ Str::limit($note->file_path, 20) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($note->is_free_preview)
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-gift"></i> Free
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">Paid</span>
                                                    @endif
                                                </td>
                                                <td>{{ number_format($note->views_count) }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $note->status == 'published' ? 'success' : ($note->status == 'draft' ? 'warning' : 'danger') }} badge-pill">
                                                        <i class="fas fa-{{ $note->status == 'published' ? 'check' : ($note->status == 'draft' ? 'pencil-alt' : 'archive') }}"></i>
                                                        {{ ucfirst($note->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('notes.edit', [$chapter->id, $note->id]) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('notes.destroy', [$chapter->id, $note->id]) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <i class="fas fa-sticky-note fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No notes found. Create your first note!</span>
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
    if(confirm('Are you sure you want to delete this note? All files and images will be deleted!')) {
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
