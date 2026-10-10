@extends('student::dashboard.layouts.app')

@section('title', 'My Orders')
@section('page_title', 'My Orders')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">My Orders</h1>
    <p class="text-gray-500 text-sm mt-1">View all your orders and payment status</p>
</div>

@if($orders && $orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <h3 class="font-bold text-gray-800">Order #{{ $order->order_number }}</h3>
                            <span class="text-xs bg-{{ $order->status_badge }}-100 text-{{ $order->status_badge }}-600 px-2.5 py-0.5 rounded">
                                {{ ucfirst($order->order_status) }}
                            </span>
                            <span class="text-xs bg-{{ $order->payment_status_badge }}-100 text-{{ $order->payment_status_badge }}-600 px-2.5 py-0.5 rounded">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ $order->created_at->format('F d, Y h:i A') }}
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-shopping-bag mr-1"></i>
                            {{ $order->items->count() }} items
                        </p>
                    </div>
                    <div class="flex flex-col items-end">
                        <p class="text-lg font-bold text-blue-600">Rs. {{ number_format($order->total, 2) }}</p>
                        <p class="text-xs text-gray-500">{{ $order->payment_method ? ucfirst(str_replace('_', ' ', $order->payment_method)) : 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-3">
                    <a href="{{ route('student.order.detail', $order->id) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
                        View Details <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                    @if($order->order_status == 'pending' && !$order->payment_proof)
                        <a href="{{ route('student.order.detail', $order->id) }}#upload-proof" class="text-green-600 hover:text-green-700 text-sm font-medium transition-colors">
                            <i class="fas fa-upload mr-1"></i> Upload Payment Proof
                        </a>
                    @endif
                    @if($order->payment_proof)
                        <span class="text-green-600 text-sm font-medium">
                            <i class="fas fa-check-circle mr-1"></i> Proof Uploaded
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@else
    <div class="bg-gray-50 rounded-xl p-12 text-center">
        <i class="fas fa-shopping-bag text-gray-300 text-5xl mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Orders Found</h3>
        <p class="text-gray-500">You haven't placed any orders yet.</p>
        <a href="{{ route('courses') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-6 py-3 rounded-lg transition-colors">
            Browse Courses
        </a>
    </div>
@endif

@endsection
