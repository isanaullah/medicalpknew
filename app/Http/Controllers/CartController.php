<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = $this->calculateTotal($cart);
        $subtotal = $this->calculateSubtotal($cart);
        $cartCount = $this->getCartCount();

        return view('frontend.cart', compact('cart', 'total', 'subtotal', 'cartCount'));
    }

    public function add(Request $request)
    {
        $courseId = $request->course_id;
        $course = Course::findOrFail($courseId);

        $cart = Session::get('cart', []);

        if (isset($cart[$courseId])) {
            $cart[$courseId]['quantity']++;
        } else {
            $cart[$courseId] = [
                'id' => $course->id,
                'title' => $course->title,
                'slug' => $course->slug,
                'price' => $course->discount_price ?? $course->price,
                'original_price' => $course->price,
                'image' => $course->image,
                'quantity' => 1,
                'category' => $course->category->name ?? 'General',
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Course added to cart successfully!');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);

            if (request()->ajax()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Item removed from cart!');
        }

        if (request()->ajax()) {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }

        return redirect()->back()->with('error', 'Item not found!');
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($cart[$id])) {
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]);
            }
            Session::put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $this->calculateTotal($cart);
        $subtotal = $this->calculateSubtotal($cart);
        $cartCount = $this->getCartCount();

        return view('frontend.checkout', compact('cart', 'total', 'subtotal', 'cartCount'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cash,card,bank_transfer',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Create order
        $subtotal = $this->calculateSubtotal($cart);
        $total = $this->calculateTotal($cart);

        // Create order
    $order = Order::create([
        'user_id' => auth()->id(),
        'order_number' => 'ORD-' . strtoupper(uniqid()),
        'customer_name' => $request->customer_name,
        'customer_email' => $request->customer_email,
        'customer_phone' => $request->customer_phone,
        'shipping_address' => $request->shipping_address,
        'city' => $request->city,
        'state' => $request->state,
        'country' => $request->country,
        'zip_code' => $request->zip_code,
        'subtotal' => $subtotal,
        'discount' => 0,
        'tax' => 0,
        'shipping_charge' => 0,
        'total' => $total,
        'payment_method' => $request->payment_method,
        'payment_status' => 'pending',
        'order_status' => 'pending',
        'notes' => $request->notes,
    ]);

    // Create order items
    foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'course_id' => $item['id'],
            'item_type' => 'course',
            'item_name' => $item['title'],
            'item_slug' => $item['slug'],
            'item_image' => $item['image'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'discount' => ($item['original_price'] ?? $item['price']) - $item['price'],
            'total' => $item['price'] * $item['quantity'],
        ]);
    }

    // If payment method is cash, auto-complete order and enroll
    if ($request->payment_method === 'cash') {
        $order->update([
            'order_status' => 'completed',
            'payment_status' => 'paid',
        ]);
        $order->processEnrollment();
    }

    // Clear cart
    Session::forget('cart');

    return redirect()->route('cart.confirmation', $order->id)
        ->with('success', 'Order placed successfully!');
}

    public function confirmation($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('frontend.order-confirmation', compact('order'));
    }

    private function calculateSubtotal($cart)
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal;
    }

    private function calculateTotal($cart)
    {
        return $this->calculateSubtotal($cart);
    }

    private function getCartCount()
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}
