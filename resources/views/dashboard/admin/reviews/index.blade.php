@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Reviews')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-star"></i> {{ __('Manage Reviews') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Reviews') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('All Reviews') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('reviews.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add New Review') }}
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
                                            <th>Reviewer</th>
                                            <th>Course</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th>Status</th>
                                            <th>Featured</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reviews as $review)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $review->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $review->email ?? 'No email' }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $review->course->title ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    <div class="flex text-[#FBBF24]">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-[#FBBF24]' : 'text-[#E2E8F0]' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                                                        @endfor
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                                        {{ Str::limit($review->review, 50) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="custom-switch custom-switch-sm">
                                                        <input type="checkbox"
                                                               id="status_{{ $review->id }}"
                                                               class="custom-switch-input status-toggle"
                                                               data-id="{{ $review->id }}"
                                                               {{ $review->is_approved ? 'checked' : '' }}>
                                                        <label class="custom-switch-btn" for="status_{{ $review->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-switch custom-switch-sm">
                                                        <input type="checkbox"
                                                               id="featured_{{ $review->id }}"
                                                               class="custom-switch-input featured-toggle"
                                                               data-id="{{ $review->id }}"
                                                               {{ $review->is_featured ? 'checked' : '' }}>
                                                        <label class="custom-switch-btn" for="featured_{{ $review->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('reviews.edit', $review->id) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('reviews.destroy', $review->id) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-star fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No reviews found.</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $reviews->links() }}
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
    if(confirm('Are you sure you want to delete this review? This action cannot be undone!')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        form.innerHTML = '@csrf @method('DELETE')';
        document.body.appendChild(form);
        form.submit();
    }
}

$(document).ready(function() {
    $('.status-toggle').change(function() {
        var id = $(this).data('id');
        var is_approved = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route("reviews.update-status") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                review_id: id,
                is_approved: is_approved
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

    $('.featured-toggle').change(function() {
        var id = $(this).data('id');
        var is_featured = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route("reviews.update-featured") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                review_id: id,
                is_featured: is_featured
            },
            success: function(response) {
                if(response.success) {
                    toastr.success('Featured status updated successfully');
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