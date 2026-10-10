@extends('dashboard.admin.layouts.app')

@section('page_title', 'Order Details #' . $order->order_number)

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-shopping-cart"></i> {{ __('Order Details') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Order #') . $order->order_number }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- Order Info -->
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Order Information') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-file-pdf"></i> {{ __('Invoice') }}
                                </a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{ __('Order Number') }}</strong></label>
                                        <p class="text-muted">{{ $order->order_number }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Order Date') }}</strong></label>
                                        <p class="text-muted">{{ $order->created_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Payment Method') }}</strong></label>
                                        <p class="text-muted">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Payment Status') }}</strong></label>
                                        <p>
                                            <span class="badge badge-{{ $order->payment_status_badge }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{ __('Order Status') }}</strong></label>
                                        <p>
                                            <span class="badge badge-{{ $order->status_badge }}">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Customer') }}</strong></label>
                                        <p class="text-muted">{{ $order->customer_name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Email') }}</strong></label>
                                        <p class="text-muted">{{ $order->customer_email }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{ __('Phone') }}</strong></label>
                                        <p class="text-muted">{{ $order->customer_phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label><strong>{{ __('Shipping Address') }}</strong></label>
                                        <p class="text-muted">{{ $order->shipping_address }}</p>
                                        @if($order->city || $order->state || $order->country)
                                            <p class="text-muted">
                                                {{ $order->city }}{{ $order->city && ($order->state || $order->country) ? ', ' : '' }}
                                                {{ $order->state }}{{ $order->state && $order->country ? ', ' : '' }}
                                                {{ $order->country }}
                                            </p>
                                        @endif
                                        @if($order->zip_code)
                                            <p class="text-muted">ZIP: {{ $order->zip_code }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($order->notes)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label><strong>{{ __('Order Notes') }}</strong></label>
                                        <p class="text-muted">{{ $order->notes }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Order Items') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $index => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item->item_image)
                                                            <img src="{{ asset('storage/' . $item->item_image) }}"
                                                                 alt="{{ $item->item_name }}"
                                                                 width="50"
                                                                 height="50"
                                                                 style="object-fit: cover; border-radius: 5px;"
                                                                 class="mr-3">
                                                        @else
                                                            <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center mr-3"
                                                                 style="width: 50px; height: 50px;">
                                                                <i class="fas fa-graduation-cap"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <strong>{{ $item->item_name }}</strong>
                                                            <br>
                                                            <small class="text-muted">Type: {{ ucfirst($item->item_type ?? 'Course') }}</small>
                                                            @if($item->course_id)
                                                                <br>
                                                                <small class="text-muted">Course ID: #{{ $item->course_id }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Rs. {{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>
                                                    @if($item->discount > 0)
                                                        <span class="text-success">- Rs. {{ number_format($item->discount, 2) }}</span>
                                                    @else
                                                        <span class="text-muted">Rs. 0.00</span>
                                                    @endif
                                                </td>
                                                <td><strong>Rs. {{ number_format($item->total, 2) }}</strong></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <td colspan="5" class="text-right font-weight-bold">Subtotal:</td>
                                            <td><strong>Rs. {{ number_format($order->subtotal, 2) }}</strong></td>
                                        </tr>
                                        @if($order->discount > 0)
                                        <tr>
                                            <td colspan="5" class="text-right font-weight-bold">Discount:</td>
                                            <td><span class="text-success">- Rs. {{ number_format($order->discount, 2) }}</span></td>
                                        </tr>
                                        @endif
                                        @if($order->tax > 0)
                                        <tr>
                                            <td colspan="5" class="text-right font-weight-bold">Tax:</td>
                                            <td><strong>Rs. {{ number_format($order->tax, 2) }}</strong></td>
                                        </tr>
                                        @endif
                                        @if($order->shipping_charge > 0)
                                        <tr>
                                            <td colspan="5" class="text-right font-weight-bold">Shipping:</td>
                                            <td><strong>Rs. {{ number_format($order->shipping_charge, 2) }}</strong></td>
                                        </tr>
                                        @endif
                                        <tr class="table-primary">
                                            <td colspan="5" class="text-right font-weight-bold">Total:</td>
                                            <td><strong class="text-primary">Rs. {{ number_format($order->total, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-12 col-md-4">
                    <!-- Order Actions -->
<!-- Order Actions -->
<div class="card">
    <div class="card-header">
        <h4>{{ __('Order Actions') }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('orders.update-status') }}" method="POST" id="statusForm">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div class="form-group">
                <label>{{ __('Update Order Status') }}</label>
                <select name="status" class="form-control" onchange="document.getElementById('statusForm').submit();">
                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="refunded" {{ $order->order_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>
        </form>

        <div class="btn-group-vertical w-100 mt-3">
            <!-- Process Enrollment Button -->
            @if($order->order_status == 'completed')
                <a href="{{ route('orders.process-enrollment', $order->id) }}"
                   class="btn btn-success btn-block"
                   onclick="return confirm('Process enrollment for this order?')">
                    <i class="fas fa-user-graduate"></i> {{ __('Process Enrollment') }}
                </a>
            @endif

            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-block">
                <i class="fas fa-edit"></i> {{ __('Edit Order') }}
            </a>
            <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-info btn-block" target="_blank">
                <i class="fas fa-file-pdf"></i> {{ __('Download Invoice') }}
            </a>
            <button onclick="sendEmail({{ $order->id }})" class="btn btn-primary btn-block">
                <i class="fas fa-envelope"></i> {{ __('Send Email') }}
            </button>
            <button onclick="deleteOrder({{ $order->id }})" class="btn btn-danger btn-block">
                <i class="fas fa-trash"></i> {{ __('Delete Order') }}
            </button>
        </div>
    </div>
</div>
<!-- Payment Proof -->
@if($order->payment_proof)
<div class="card">
    <div class="card-header">
        <h4>{{ __('Payment Proof') }}</h4>
    </div>
    <div class="card-body">
        <div class="text-center">
            @php
                $extension = pathinfo($order->payment_proof, PATHINFO_EXTENSION);
                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
            @endphp

            @if($isImage)
                <img src="{{ $order->payment_proof_url }}" alt="Payment Proof" class="img-fluid rounded-lg" style="max-height: 400px;">
            @else
                <i class="fas fa-file-pdf text-red-500 text-5xl mb-3"></i>
                <p class="text-muted">PDF Document</p>
                <a href="{{ $order->payment_proof_url }}" target="_blank" class="btn btn-primary mt-2">
                    <i class="fas fa-eye"></i> View PDF
                </a>
            @endif
        </div>
        <div class="mt-3 text-center">
            <span class="badge badge-{{ $order->payment_status_badge }}">
                Payment Status: {{ ucfirst($order->payment_status) }}
            </span>
        </div>
    </div>
</div>
@endif
<!-- Enrollment Info -->
@if($order->enrollments && $order->enrollments->count() > 0)
<div class="card">
    <div class="card-header">
        <h4>{{ __('Enrollments') }}</h4>
    </div>
    <div class="card-body">
        @foreach($order->enrollments as $enrollment)
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                <div>
                    <strong>{{ $enrollment->course->title ?? 'Course' }}</strong>
                    <br>
                    <small class="text-muted">#{{ $enrollment->enrollment_number }}</small>
                </div>
                <div>
                    <span class="badge badge-{{ $enrollment->status == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($enrollment->status) }}
                    </span>
                    <span class="badge badge-info">{{ $enrollment->progress }}%</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

                    <!-- Customer Info -->
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Customer Info') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="avatar avatar-lg bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 32px;">
                                    {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                                </div>
                                <h5 class="mt-2">{{ $order->customer_name }}</h5>
                                <p class="text-muted">{{ $order->customer_email }}</p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-user"></i> {{ __('View Profile') }}
                                </a>
                                <a href="mailto:{{ $order->customer_email }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-envelope"></i> {{ __('Email') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Order Timeline') }}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="media mb-3">
                                    <div class="mr-3">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="mb-0"><strong>Order Placed</strong></p>
                                        <small class="text-muted">{{ $order->created_at->format('F d, Y h:i A') }}</small>
                                    </div>
                                </li>
                                @if($order->order_status == 'processing' || $order->order_status == 'completed')
                                <li class="media mb-3">
                                    <div class="mr-3">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="mb-0"><strong>Order Processing</strong></p>
                                        <small class="text-muted">{{ $order->updated_at->format('F d, Y h:i A') }}</small>
                                    </div>
                                </li>
                                @endif
                                @if($order->order_status == 'completed')
                                <li class="media mb-3">
                                    <div class="mr-3">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="mb-0"><strong>Order Completed</strong></p>
                                        <small class="text-muted">{{ $order->updated_at->format('F d, Y h:i A') }}</small>
                                    </div>
                                </li>
                                @endif
                                @if($order->order_status == 'cancelled')
                                <li class="media mb-3">
                                    <div class="mr-3">
                                        <i class="fas fa-times-circle text-danger"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="mb-0"><strong>Order Cancelled</strong></p>
                                        <small class="text-muted">{{ $order->updated_at->format('F d, Y h:i A') }}</small>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    function deleteOrder(id) {
        if (confirm('Are you sure you want to delete this order? This action cannot be undone!')) {
            // Use the correct route with the ID parameter
            var url = '{{ route("orders.destroy", ":id") }}'.replace(':id', id);

            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.innerHTML = '@csrf @method('DELETE')';
            document.body.appendChild(form);
            form.submit();
        }
    }

    function sendEmail(id) {
        alert('Email functionality coming soon!');
    }
</script>
@endpush
@endsection
