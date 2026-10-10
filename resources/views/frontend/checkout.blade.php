@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- PAGE HERO -->
<section class="page-hero pt-36 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">
            <i data-lucide="credit-card" class="w-4 h-4 inline mr-2"></i>
            Secure Checkout
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">Complete Your Order</h1>
        <p class="text-[#475569] max-w-xl mx-auto">Fill in your details to complete the purchase</p>
    </div>
</section>

<!-- CHECKOUT CONTENT -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
                <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <form action="{{ route('cart.place.order') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="card p-6">
                        <h3 class="font-bold text-[#0F172A] text-lg mb-4 flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5 text-[#2563EB]"></i>
                            Personal Information
                        </h3>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-[#0F172A] mb-2">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] @error('customer_name') border-red-500 @enderror">
                                @error('customer_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#0F172A] mb-2">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] @error('customer_email') border-red-500 @enderror">
                                @error('customer_email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-[#0F172A] mb-2">Phone Number</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                                class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] @error('customer_phone') border-red-500 @enderror">
                            @error('customer_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="card p-6">
                        <h3 class="font-bold text-[#0F172A] text-lg mb-4 flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-5 h-5 text-[#2563EB]"></i>
                            Shipping Address
                        </h3>

                        <div>
                            <label class="block text-sm font-medium text-[#0F172A] mb-2">Address <span class="text-red-500">*</span></label>
                            <textarea name="shipping_address" rows="2" required
                                class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-[#0F172A] mb-2">City</label>
                                <input type="text" name="city" value="{{ old('city') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB]">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#0F172A] mb-2">State / Province</label>
                                <input type="text" name="state" value="{{ old('state') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB]">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-[#0F172A] mb-2">Country</label>
                                <input type="text" name="country" value="{{ old('country', 'Pakistan') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB]">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#0F172A] mb-2">ZIP / Postal Code</label>
                                <input type="text" name="zip_code" value="{{ old('zip_code') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB]">
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <h3 class="font-bold text-[#0F172A] text-lg mb-4 flex items-center gap-2">
                            <i data-lucide="credit-card" class="w-5 h-5 text-[#2563EB]"></i>
                            Payment Method
                        </h3>

                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-3 border border-[#E2E8F0] rounded-xl cursor-pointer hover:bg-[#F8FBFF] transition-colors">
                                <input type="radio" name="payment_method" value="cash" checked class="w-4 h-4 text-[#2563EB]">
                                <span class="font-medium text-[#0F172A]">Cash on Delivery</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 border border-[#E2E8F0] rounded-xl cursor-pointer hover:bg-[#F8FBFF] transition-colors">
                                <input type="radio" name="payment_method" value="card" class="w-4 h-4 text-[#2563EB]">
                                <span class="font-medium text-[#0F172A]">Credit / Debit Card</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 border border-[#E2E8F0] rounded-xl cursor-pointer hover:bg-[#F8FBFF] transition-colors">
                                <input type="radio" name="payment_method" value="bank_transfer" class="w-4 h-4 text-[#2563EB]">
                                <span class="font-medium text-[#0F172A]">Bank Transfer</span>
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="card p-6">
                        <label class="block text-sm font-medium text-[#0F172A] mb-2">Order Notes (Optional)</label>
                        <textarea name="notes" rows="2" placeholder="Any special instructions for your order..."
                            class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB]">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full !py-3.5 text-lg flex items-center justify-center gap-2">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                        Place Order — Rs. {{ number_format($total ?? 0, 2) }}
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="card p-6 sticky top-24">
                    <h3 class="font-bold text-[#0F172A] text-lg mb-4">Order Summary</h3>

                    <div class="space-y-3 max-h-60 overflow-y-auto">
                        @foreach($cart as $item)
                            <div class="flex items-center gap-3 py-2 border-b border-[#E2E8F0] last:border-0">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center shrink-0 overflow-hidden">
                                    @if(isset($item['image']) && $item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                                    @else
                                        <i data-lucide="graduation-cap" class="w-6 h-6 text-white/50"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-[#0F172A] text-sm line-clamp-1">{{ $item['title'] }}</p>
                                    <p class="text-xs text-[#64748B]">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <span class="text-sm font-bold text-[#2563EB]">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 pt-4 mt-4 border-t border-[#E2E8F0]">
                        <div class="flex justify-between text-sm">
                            <span class="text-[#64748B]">Subtotal ({{ $cartCount }} items)</span>
                            <span class="font-medium text-[#0F172A]">Rs. {{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#64748B]">Discount</span>
                            <span class="text-green-600 font-medium">- Rs. 0.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#64748B]">Tax</span>
                            <span class="font-medium text-[#0F172A]">Rs. 0.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#64748B]">Shipping</span>
                            <span class="font-medium text-[#0F172A]">Free</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-lg font-bold pt-4 border-t border-[#E2E8F0] mt-4">
                        <span class="text-[#0F172A]">Total</span>
                        <span class="text-[#2563EB]">Rs. {{ number_format($total ?? 0, 2) }}</span>
                    </div>

                    <div class="mt-4 bg-[#F8FBFF] rounded-xl p-3 text-center">
                        <p class="text-xs text-[#64748B]">
                            <i data-lucide="shield-check" class="w-3 h-3 inline mr-1"></i>
                            Your information is secure and encrypted
                        </p>
                    </div>

                    <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 text-[#64748B] hover:text-[#2563EB] transition-colors text-sm mt-4">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) lucide.createIcons();
    });
</script>
</body>
</html>
