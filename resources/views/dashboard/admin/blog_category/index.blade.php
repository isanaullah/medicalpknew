@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Blog Categories')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-tags"></i> {{ __('Manage Blog Categories') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Blog Categories') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('All Categories') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('blog.category.create') }}" class="btn btn-primary">
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

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Articles</th>
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
                                                    @if($category->image && $category->image != 'blog/category/no_img.jpg')
                                                        <img src="{{ asset('storage/' . $category->image) }}"
                                                             alt="{{ $category->title }}"
                                                             width="50"
                                                             height="50"
                                                             style="object-fit: cover; border-radius: 5px;">
                                                    @else
                                                        <span class="badge badge-secondary">No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $category->title }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $category->slug }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary badge-pill">
                                                        {{ $category->articles_count }}
                                                    </span>
                                                </td>
                                                <td>{{ number_format($category->views_count ?? 0) }}</td>
                                                <td>
                                                    <div class="custom-switch custom-switch-sm">
                                                        <input type="checkbox"
                                                               id="status_{{ $category->id }}"
                                                               class="custom-switch-input status-toggle"
                                                               data-id="{{ $category->id }}"
                                                               {{ $category->status == 1 ? 'checked' : '' }}>
                                                        <label class="custom-switch-btn" for="status_{{ $category->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('blog.article.view', $category->id) }}"
                                                           class="btn btn-info" title="View Articles">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('blog.category.update', $category->id) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('blog.category.delete', $category->id) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-tags fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No categories found. Create your first category!</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $categories->links() }}
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
    if(confirm('Are you sure you want to delete this category? All associated articles will also be deleted!')) {
        window.location.href = url;
    }
}

$(document).ready(function() {
    $('.status-toggle').change(function() {
        var id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route("blogCategory.updateStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                blog_category_id: id,
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
