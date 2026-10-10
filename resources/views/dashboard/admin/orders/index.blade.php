@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Orders')

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-shopping-cart"></i> {{ __('Manage Orders') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Orders') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('All Orders') }}</h4>
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
                                            <th>Order #</th>
                                            <th>Customer</th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="font-weight-bold">{{ $order->order_number }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $order->customer_name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $order->customer_email }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $order->items->count() }} items</span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold">Rs. {{ number_format($order->total, 2) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $order->payment_status_badge }}">
                                                        {{ ucfirst($order->payment_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $order->status_badge }}">
                                                        {{ ucfirst($order->order_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small>{{ $order->created_at->format('d M Y') }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('orders.show', $order->id) }}"
                                                           class="btn btn-info" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                title="Delete"
                                                                onclick="confirmDelete('{{ route('orders.destroy', $order->id) }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">No orders found.</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $orders->links() }}
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
    if(confirm('Are you sure you want to delete this order? This action cannot be undone!')) {
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
