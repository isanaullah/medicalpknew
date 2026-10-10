<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Enrollment;

class OrderController extends Controller
{
        public function index()
    {
        $orders = Order::with(['user', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('order_status', 'pending')->count(),
            'processing' => Order::where('order_status', 'processing')->count(),
            'completed' => Order::where('order_status', 'completed')->count(),
            'cancelled' => Order::where('order_status', 'cancelled')->count(),
        ];

        return view('dashboard.admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with(['user', 'items'])->findOrFail($id);
        return view('dashboard.admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::with(['user', 'items'])->findOrFail($id);
        return view('dashboard.admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'order_status' => 'required|in:pending,processing,completed,cancelled,refunded',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->order_status;
        $newStatus = $request->order_status;

        $order->update([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'order_status' => $newStatus,
            'payment_status' => $request->payment_status,
            'notes' => $request->notes,
        ]);

        // Process enrollment if order is completed
        if ($newStatus === 'completed' && $oldStatus !== 'completed') {
            $enrolled = $order->processEnrollment();
            if ($enrolled) {
                // You can add a success message or log here
                \Log::info('Enrollment processed for order: ' . $order->order_number);
            }
        }

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Update order status via AJAX.
     */
    public function updateStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $oldStatus = $order->order_status;
        $newStatus = $request->status;

        $order->order_status = $newStatus;
        $order->save();

        // Process enrollment if order is completed
        if ($newStatus === 'completed' && $oldStatus !== 'completed') {
            $enrolled = $order->processEnrollment();
            if ($enrolled) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order status updated and enrollment processed successfully!'
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully!'
        ]);
    }

    /**
     * Process enrollment manually for an order
     */
    public function processEnrollment($id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        if ($order->order_status !== 'completed') {
            return redirect()->back()
                ->with('warning', 'Order must be completed first!');
        }

        $enrolled = $order->processEnrollment();
        
        if ($enrolled) {
            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Enrollment processed successfully!');
        }

        return redirect()->route('orders.show', $order->id)
            ->with('error', 'Failed to process enrollment. User not found or already enrolled.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Delete order items first
        $order->items()->delete();
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }

    /**
     * Generate invoice for order.
     */
    public function invoice($id)
    {
        $order = Order::with(['user', 'items'])->findOrFail($id);
        return view('dashboard.admin.orders.invoice', compact('order'));
    }
}
