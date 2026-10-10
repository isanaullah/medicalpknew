@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- PAGE HERO -->
<section class="page-hero pt-36 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">
            <i data-lucide="shopping-cart" class="w-4 h-4 inline mr-2"></i>
            {{ $cartCount ?? 0 }} Items in Cart
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">Your Shopping Cart</h1>
        <p class="text-[#475569] max-w-xl mx-auto">Review your courses and proceed to checkout</p>
    </div>
</section>

<!-- CART CONTENT -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        @if(session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
                <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
                <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(isset($cart) && count($cart) > 0)
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-[#F8FBFF] rounded-2xl p-6 border border-[#E2E8F0]">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#E2E8F0]">
                            <h2 class="font-bold text-[#0F172A]">Course Items ({{ $cartCount }})</h2>
                            <a href="{{ route('cart.clear') }}" class="text-sm text-red-500 hover:text-red-600 transition-colors" onclick="return confirm('Are you sure you want to clear your cart?')">
                                <i data-lucide="trash-2" class="w-4 h-4 inline mr-1"></i>
                                Clear Cart
                            </a>
                        </div>

                        @foreach($cart as $id => $item)
                            <div class="cart-item flex items-center gap-4 py-4 border-b border-[#E2E8F0] last:border-0" data-id="{{ $id }}">
                                <!-- Image -->
                                <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center shrink-0 overflow-hidden">
                                    @if(isset($item['image']) && $item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                                    @else
                                        <i data-lucide="graduation-cap" class="w-8 h-8 text-white/50"></i>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-[#0F172A] text-sm line-clamp-1">{{ $item['title'] }}</h3>
                                    <p class="text-xs text-[#64748B]">{{ $item['category'] ?? 'Course' }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[#2563EB] font-bold text-sm">Rs. {{ number_format($item['price'] ?? 0, 2) }}</span>
                                        @if(isset($item['original_price']) && $item['original_price'] > $item['price'])
                                            <span class="text-xs text-[#64748B] line-through">Rs. {{ number_format($item['original_price'], 2) }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Quantity & Remove -->
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center border border-[#E2E8F0] rounded-lg overflow-hidden">
                                        <button class="qty-btn w-8 h-8 flex items-center justify-center text-[#64748B] hover:bg-[#F8FBFF] transition-colors" data-action="decrease" data-id="{{ $id }}">
                                            <i data-lucide="minus" class="w-3.5 h-3.5"></i>
                                        </button>
                                        <span class="qty-display w-8 text-center text-sm font-medium text-[#0F172A]">{{ $item['quantity'] ?? 1 }}</span>
                                        <button class="qty-btn w-8 h-8 flex items-center justify-center text-[#64748B] hover:bg-[#F8FBFF] transition-colors" data-action="increase" data-id="{{ $id }}">
                                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </div>
                                    <button class="remove-item w-8 h-8 rounded-lg text-red-400 hover:text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" data-id="{{ $id }}">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Continue Shopping -->
                    <a href="{{ route('courses') }}" class="inline-flex items-center gap-2 text-[#2563EB] font-medium hover:text-[#1D4ED8] transition-colors mt-6">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Continue Shopping
                    </a>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="card p-6 sticky top-24">
                        <h3 class="font-bold text-[#0F172A] text-lg mb-4">Order Summary</h3>

                        <div class="space-y-3 pb-4 border-b border-[#E2E8F0]">
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

                        <div class="flex justify-between text-lg font-bold pt-4">
                            <span class="text-[#0F172A]">Total</span>
                            <span class="text-[#2563EB]">Rs. {{ number_format($total ?? 0, 2) }}</span>
                        </div>

                        <a href="{{ route('cart.checkout') }}" class="btn-primary w-full text-center mt-6 !py-3.5">
    <i data-lucide="credit-card" class="w-4 h-4 inline mr-2"></i>
    Proceed to Checkout
</a>

                        <p class="text-xs text-[#64748B] text-center mt-3">
                            <i data-lucide="shield-check" class="w-3 h-3 inline mr-1"></i>
                            Secure checkout guaranteed
                        </p>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <div class="w-32 h-32 rounded-full bg-[#F8FBFF] flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-cart" class="w-16 h-16 text-[#94A3B8]"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0F172A] mb-2">Your Cart is Empty</h3>
                <p class="text-[#64748B] mb-8">Looks like you haven't added any courses to your cart yet.</p>
                <a href="{{ route('courses') }}" class="btn-primary inline-flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    Browse Courses
                </a>
            </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) lucide.createIcons();

        // Update quantity
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const action = this.dataset.action;
                const display = this.closest('.cart-item').querySelector('.qty-display');
                let qty = parseInt(display.textContent);

                if (action === 'increase') {
                    qty++;
                } else if (action === 'decrease' && qty > 1) {
                    qty--;
                } else if (action === 'decrease' && qty <= 1) {
                    return;
                }

                // Update UI
                display.textContent = qty;

                // Send AJAX request
                fetch('{{ route("cart.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, quantity: qty })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });

        // Remove item
// Remove item
document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', function() {
        if (!confirm('Are you sure you want to remove this item?')) return;

        const id = this.dataset.id;

        fetch('/cart/remove/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
    });
</script>
</body>
</html>
