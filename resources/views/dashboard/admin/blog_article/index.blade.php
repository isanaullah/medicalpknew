@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Blog Articles')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-newspaper"></i> {{ __('Manage Blog Articles') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('blog.category.view') }}">{{ __('Blog Categories') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Articles') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ __('Articles in: ') }}
                                <span class="text-primary">{{ $category->title }}</span>
                            </h4>
                            <div class="card-header-action">
                                <a href="{{ route('blog.article.create', $category->id) }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add New Article') }}
                                </a>
                                <a href="{{ route('blog.category.view') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{ __('Back to Categories') }}
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
                                            <th>Slug</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($articles as $article)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($article->image && $article->image != 'blog/article/no_img.jpg')
                                                        <img src="{{ asset('storage/' . $article->image) }}"
                                                             alt="{{ $article->title }}"
                                                             width="50"
                                                             height="50"
                                                             style="object-fit: cover; border-radius: 5px;">
                                                    @else
                                                        <span class="badge badge-secondary">No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $article->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($article->description, 50) }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $article->slug }}</span>
                                                </td>
                                                <td>{{ number_format($article->views_count ?? 0) }}</td>
                                                <td>
                                                    <div class="custom-switch custom-switch-sm">
                                                        <input type="checkbox"
                                                               id="status_{{ $article->id }}"
                                                               class="custom-switch-input status-toggle"
                                                               data-id="{{ $article->id }}"
                                                               {{ $article->status == 1 ? 'checked' : '' }}>
                                                        <label class="custom-switch-btn" for="status_{{ $article->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('blog.article.update', $article->id) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('blog.article.delete', $article->id) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <i class="fas fa-newspaper fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No articles found. Create your first article!</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $articles->links() }}
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
    if(confirm('Are you sure you want to delete this article? This action cannot be undone!')) {
        window.location.href = url;
    }
}

$(document).ready(function() {
    $('.status-toggle').change(function() {
        var id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route("article.updateStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                article_id: id,
                status: status
            },
            success: function(response) {
                if(response.success) {
                    toastr.success('Status updated successfully');
                }
            },
            error: function() {
                toastr.error('Something went wrong');
            }
        });
    });
});
</script>
@endpush
@endsection
