@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Order #' . $order->order_number)

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-edit"></i> {{ __('Edit Order') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Edit Order #') . $order->order_number }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Order Information') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_number">{{ __('Order Number') }}</label>
                                            <input type="text" class="form-control" value="{{ $order->order_number }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created_at">{{ __('Order Date') }}</label>
                                            <input type="text" class="form-control" value="{{ $order->created_at->format('F d, Y h:i A') }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_name">{{ __('Customer Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   name="customer_name" 
                                                   id="customer_name" 
                                                   class="form-control @error('customer_name') is-invalid @enderror" 
                                                   value="{{ old('customer_name', $order->customer_name) }}" 
                                                   required>
                                            @error('customer_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                            <input type="email" 
                                                   name="customer_email" 
                                                   id="customer_email" 
                                                   class="form-control @error('customer_email') is-invalid @enderror" 
                                                   value="{{ old('customer_email', $order->customer_email) }}" 
                                                   required>
                                            @error('customer_email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="customer_phone">{{ __('Phone Number') }}</label>
                                    <input type="text" 
                                           name="customer_phone" 
                                           id="customer_phone" 
                                           class="form-control @error('customer_phone') is-invalid @enderror" 
                                           value="{{ old('customer_phone', $order->customer_phone) }}">
                                    @error('customer_phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="shipping_address">{{ __('Shipping Address') }} <span class="text-danger">*</span></label>
                                    <textarea name="shipping_address" 
                                              id="shipping_address" 
                                              class="form-control @error('shipping_address') is-invalid @enderror" 
                                              rows="2" 
                                              required>{{ old('shipping_address', $order->shipping_address) }}</textarea>
                                    @error('shipping_address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">{{ __('City') }}</label>
                                            <input type="text" 
                                                   name="city" 
                                                   id="city" 
                                                   class="form-control @error('city') is-invalid @enderror" 
                                                   value="{{ old('city', $order->city) }}">
                                            @error('city')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state">{{ __('State / Province') }}</label>
                                            <input type="text" 
                                                   name="state" 
                                                   id="state" 
                                                   class="form-control @error('state') is-invalid @enderror" 
                                                   value="{{ old('state', $order->state) }}">
                                            @error('state')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">{{ __('Country') }}</label>
                                            <input type="text" 
                                                   name="country" 
                                                   id="country" 
                                                   class="form-control @error('country') is-invalid @enderror" 
                                                   value="{{ old('country', $order->country) }}">
                                            @error('country')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="zip_code">{{ __('ZIP / Postal Code') }}</label>
                                            <input type="text" 
                                                   name="zip_code" 
                                                   id="zip_code" 
                                                   class="form-control @error('zip_code') is-invalid @enderror" 
                                                   value="{{ old('zip_code', $order->zip_code) }}">
                                            @error('zip_code')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_status">{{ __('Order Status') }} <span class="text-danger">*</span></label>
                                            <select name="order_status" 
                                                    id="order_status" 
                                                    class="form-control @error('order_status') is-invalid @enderror" 
                                                    required>
                                                <option value="pending" {{ old('order_status', $order->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ old('order_status', $order->order_status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ old('order_status', $order->order_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ old('order_status', $order->order_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="refunded" {{ old('order_status', $order->order_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                            </select>
                                            @error('order_status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_status">{{ __('Payment Status') }} <span class="text-danger">*</span></label>
                                            <select name="payment_status" 
                                                    id="payment_status" 
                                                    class="form-control @error('payment_status') is-invalid @enderror" 
                                                    required>
                                                <option value="pending" {{ old('payment_status', $order->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                                <option value="failed" {{ old('payment_status', $order->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                                <option value="refunded" {{ old('payment_status', $order->payment_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                            </select>
                                            @error('payment_status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notes">{{ __('Order Notes') }}</label>
                                    <textarea name="notes" 
                                              id="notes" 
                                              class="form-control @error('notes') is-invalid @enderror" 
                                              rows="2">{{ old('notes', $order->notes) }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ __('Update Order') }}
                                    </button>
                                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                                    </a>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i> {{ __('View Order') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Order Summary') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>{{ __('Subtotal') }}</strong></td>
                                        <td class="text-right">Rs. {{ number_format($order->subtotal, 2) }}</td>
                                    </tr>
                                    @if($order->discount > 0)
                                    <tr>
                                        <td><strong>{{ __('Discount') }}</strong></td>
                                        <td class="text-right text-success">- Rs. {{ number_format($order->discount, 2) }}</td>
                                    </tr>
                                    @endif
                                    @if($order->tax > 0)
                                    <tr>
                                        <td><strong>{{ __('Tax') }}</strong></td>
                                        <td class="text-right">Rs. {{ number_format($order->tax, 2) }}</td>
                                    </tr>
                                    @endif
                                    @if($order->shipping_charge > 0)
                                    <tr>
                                        <td><strong>{{ __('Shipping') }}</strong></td>
                                        <td class="text-right">Rs. {{ number_format($order->shipping_charge, 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr class="table-primary">
                                        <td><strong>{{ __('Total') }}</strong></td>
                                        <td class="text-right"><strong>Rs. {{ number_format($order->total, 2) }}</strong></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mt-3">
                                <p><strong>{{ __('Payment Method') }}</strong></p>
                                <p>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                            </div>

                            <div class="mt-3">
                                <p><strong>{{ __('Items Count') }}</strong></p>
                                <p>{{ $order->items->count() }} items</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection