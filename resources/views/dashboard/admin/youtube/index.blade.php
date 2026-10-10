@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage YouTube Videos')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fab fa-youtube"></i> {{ __('Manage YouTube Videos') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('YouTube Videos') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('All Videos') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('youtube.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add New Video') }}
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
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>Subject</th>
                                            <th>Views</th>
                                            <th>Order</th>
                                            <th>Featured</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($videos as $video)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($video->thumbnail)
                                                        <img src="{{ asset('storage/youtube/' . $video->thumbnail) }}"
                                                             alt="{{ $video->title }}"
                                                             width="80"
                                                             height="50"
                                                             style="object-fit: cover; border-radius: 5px;">
                                                    @else
                                                        <img src="https://img.youtube.com/vi/{{ $video->video_id }}/hqdefault.jpg"
                                                             alt="{{ $video->title }}"
                                                             width="80"
                                                             height="50"
                                                             style="object-fit: cover; border-radius: 5px;">
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $video->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">ID: {{ $video->video_id }}</small>
                                                </td>
                                                <td>
                                                    @if($video->subject)
                                                        <span class="badge badge-info">{{ $video->subject }}</span>
                                                    @else
                                                        <span class="badge badge-secondary">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $video->views ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge badge-secondary">{{ $video->order }}</span>
                                                </td>
                                                <td>
                                                    <div class="custom-switch custom-switch-sm">
                                                        <input type="checkbox"
                                                               id="featured_{{ $video->id }}"
                                                               class="custom-switch-input featured-toggle"
                                                               data-id="{{ $video->id }}"
                                                               {{ $video->is_featured ? 'checked' : '' }}>
                                                        <label class="custom-switch-btn" for="featured_{{ $video->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-switch custom-switch-sm">
                                                        <input type="checkbox"
                                                               id="status_{{ $video->id }}"
                                                               class="custom-switch-input status-toggle"
                                                               data-id="{{ $video->id }}"
                                                               {{ $video->status ? 'checked' : '' }}>
                                                        <label class="custom-switch-btn" for="status_{{ $video->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('youtube.edit', $video->id) }}"
                                                           class="btn btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('youtube.destroy', $video->id) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <a href="{{ $video->video_url }}"
                                                           target="_blank"
                                                           class="btn btn-info" title="Watch on YouTube">
                                                            <i class="fab fa-youtube"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <i class="fab fa-youtube fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No videos found. Add your first YouTube video!</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $videos->links() }}
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
    if(confirm('Are you sure you want to delete this video? This action cannot be undone!')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        form.innerHTML = '@csrf @method('DELETE')';
        document.body.appendChild(form);
        form.submit();
    }
}

$(document).ready(function() {
    // Status toggle
    $('.status-toggle').change(function() {
        var id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route("youtube.update-status") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                video_id: id,
                status: status
            },
            success: function(response) {
                if(response.success) {
                    toastr.success('Status updated successfully');
                }
            },
            error: function() {
                toastr.error('Something went wrong');
                $(this).prop('checked', !status);
            }
        });
    });

    // Featured toggle
    $('.featured-toggle').change(function() {
        var id = $(this).data('id');
        var is_featured = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route("youtube.update-featured") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                video_id: id,
                is_featured: is_featured
            },
            success: function(response) {
                if(response.success) {
                    toastr.success('Featured status updated successfully');
                }
            },
            error: function() {
                toastr.error('Something went wrong');
                $(this).prop('checked', !is_featured);
            }
        });
    });
});
</script>
@endpush
@endsection