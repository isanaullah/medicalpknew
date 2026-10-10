@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- CONFIRMATION -->
<section class="pt-36 pb-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
        <div class="fade-up">
            <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-6">
                <i data-lucide="check-circle" class="w-12 h-12 text-green-500"></i>
            </div>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] mb-3">Order Placed Successfully! 🎉</h1>
            <p class="text-[#475569] mb-6">Thank you for your purchase. Your order has been confirmed.</p>

            <div class="bg-[#F8FBFF] rounded-2xl p-6 border border-[#E2E8F0] text-left mb-8">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-[#64748B] uppercase font-semibold">Order Number</p>
                        <p class="font-bold text-[#0F172A]">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#64748B] uppercase font-semibold">Order Date</p>
                        <p class="font-bold text-[#0F172A]">{{ $order->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#64748B] uppercase font-semibold">Payment Method</p>
                        <p class="font-bold text-[#0F172A]">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#64748B] uppercase font-semibold">Total</p>
                        <p class="font-bold text-[#2563EB]">Rs. {{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#F8FBFF] rounded-2xl p-6 border border-[#E2E8F0] text-left mb-8">
                <h3 class="font-bold text-[#0F172A] mb-4">Order Items</h3>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between py-2 border-b border-[#E2E8F0] last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center overflow-hidden">
                                    @if($item->item_image)
                                        <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="w-full h-full object-cover">
                                    @else
                                        <i data-lucide="graduation-cap" class="w-5 h-5 text-white/50"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-[#0F172A] text-sm">{{ $item->item_name }}</p>
                                    <p class="text-xs text-[#64748B]">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <span class="font-semibold text-[#2563EB]">Rs. {{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('home') }}" class="btn-primary inline-flex items-center gap-2">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    Go to Home
                </a>
                <a href="{{ route('courses') }}" class="btn-outline inline-flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    Browse More Courses
                </a>
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