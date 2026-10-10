@extends('student::dashboard.layouts.app')

@section('title', 'Order #' . $order->order_number)
@section('page_title', 'Order #' . $order->order_number)

@section('content')

<div class="mb-4">
    <a href="{{ route('student.orders') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
        <i class="fas fa-arrow-left mr-1"></i> Back to Orders
    </a>
</div>

<!-- Order Header -->
<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-xl font-bold text-gray-800">Order #{{ $order->order_number }}</h1>
                <span class="text-xs bg-{{ $order->status_badge }}-100 text-{{ $order->status_badge }}-600 px-2.5 py-0.5 rounded">
                    {{ ucfirst($order->order_status) }}
                </span>
                <span class="text-xs bg-{{ $order->payment_status_badge }}-100 text-{{ $order->payment_status_badge }}-600 px-2.5 py-0.5 rounded">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
            <p class="text-sm text-gray-500 mt-1">
                <i class="far fa-calendar-alt mr-1"></i>
                Placed on {{ $order->created_at->format('F d, Y h:i A') }}
            </p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Total Amount</p>
            <p class="text-2xl font-bold text-blue-600">Rs. {{ number_format($order->total, 2) }}</p>
        </div>
    </div>
</div>

<!-- Order Info & Payment Proof -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Details -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Order Details</h2>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500">Customer Name</p>
                        <p class="font-medium text-gray-800">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Email</p>
                        <p class="font-medium text-gray-800">{{ $order->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Phone</p>
                        <p class="font-medium text-gray-800">{{ $order->customer_phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Payment Method</p>
                        <p class="font-medium text-gray-800">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Shipping Address</p>
                    <p class="font-medium text-gray-800">{{ $order->shipping_address }}</p>
                    @if($order->city || $order->state || $order->country)
                        <p class="text-sm text-gray-600">
                            {{ $order->city }}{{ $order->city && ($order->state || $order->country) ? ', ' : '' }}
                            {{ $order->state }}{{ $order->state && $order->country ? ', ' : '' }}
                            {{ $order->country }}
                            @if($order->zip_code) - {{ $order->zip_code }} @endif
                        </p>
                    @endif
                </div>

                @if($order->notes)
                    <div>
                        <p class="text-xs text-gray-500">Order Notes</p>
                        <p class="font-medium text-gray-800">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm mt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Order Items</h2>

            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i class="fas fa-graduation-cap text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $item->item_name }}</p>
                                <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-800">Rs. {{ number_format($item->total, 2) }}</p>
                            @if($item->discount > 0)
                                <p class="text-xs text-green-600">Saved Rs. {{ number_format($item->discount, 2) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Totals -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="space-y-1">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-medium text-gray-800">Rs. {{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Discount</span>
                            <span class="font-medium text-green-600">- Rs. {{ number_format($order->discount, 2) }}</span>
                        </div>
                    @endif
                    @if($order->tax > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tax</span>
                            <span class="font-medium text-gray-800">Rs. {{ number_format($order->tax, 2) }}</span>
                        </div>
                    @endif
                    @if($order->shipping_charge > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Shipping</span>
                            <span class="font-medium text-gray-800">Rs. {{ number_format($order->shipping_charge, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                        <span class="text-gray-800">Total</span>
                        <span class="text-blue-600">Rs. {{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Proof Upload -->
    <div class="lg:col-span-1">
        <div id="upload-proof" class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm sticky top-24">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Payment Proof</h3>

            @if($order->payment_proof)
                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-2">Uploaded Proof</p>
                    <div class="bg-gray-50 rounded-lg p-4 text-center border border-gray-200">
                        @php
                            $extension = pathinfo($order->payment_proof, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        @endphp

                        @if($isImage)
                            <img src="{{ $order->payment_proof_url }}" alt="Payment Proof" class="w-full max-h-48 object-contain rounded-lg">
                        @else
                            <i class="fas fa-file-pdf text-red-500 text-4xl mb-2"></i>
                            <p class="text-sm text-gray-600">PDF Document</p>
                        @endif
                    </div>
                    <div class="flex justify-between mt-2 text-sm">
                        <span class="text-gray-500">Status:</span>
                        <span class="font-medium
                            @if($order->payment_status == 'paid') text-green-600
                            @elseif($order->payment_status == 'pending') text-yellow-600
                            @else text-red-600 @endif
                        ">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    @if($order->payment_status == 'pending')
                        <p class="text-xs text-yellow-600 mt-2">
                            <i class="fas fa-clock mr-1"></i>
                            Your proof is being verified by admin.
                        </p>
                    @endif
                </div>
            @endif

            @if($order->order_status == 'pending')
                @if($order->payment_proof)
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 rounded-lg p-3 text-sm">
                        <i class="fas fa-info-circle mr-1"></i>
                        Payment proof uploaded. Awaiting admin verification.
                    </div>
                @else
                    <form action="{{ route('student.order.upload-proof', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Payment Receipt/Proof <span class="text-red-500">*</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Click to upload or drag & drop</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, PDF (Max 5MB)</p>
                                <input type="file"
                                       name="payment_proof"
                                       id="payment_proof"
                                       class="hidden"
                                       accept="image/*,.pdf"
                                       required>
                                <button type="button"
                                        onclick="document.getElementById('payment_proof').click()"
                                        class="mt-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors inline-block">
                                    Choose File
                                </button>
                            </div>
                            @error('payment_proof')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 rounded-lg transition-colors">
                            <i class="fas fa-upload mr-2"></i> Upload Proof
                        </button>
                    </form>
                @endif
            @elseif($order->order_status == 'completed')
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg p-3 text-sm">
                    <i class="fas fa-check-circle mr-1"></i>
                    Order completed successfully!
                </div>
            @elseif($order->order_status == 'cancelled')
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-3 text-sm">
                    <i class="fas fa-times-circle mr-1"></i>
                    This order has been cancelled.
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
