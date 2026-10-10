<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff;
            padding: 40px;
            margin: 0;
        }
        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #2563EB;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            color: #2563EB;
            margin: 0;
            font-size: 28px;
        }
        .invoice-header .order-number {
            color: #475569;
            font-size: 18px;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .invoice-info .left, .invoice-info .right {
            flex: 1;
        }
        .invoice-info .right {
            text-align: right;
        }
        .invoice-info p {
            margin: 5px 0;
            color: #475569;
        }
        .invoice-info strong {
            color: #0F172A;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table thead {
            background: #F8FAFC;
        }
        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #0F172A;
            border-bottom: 2px solid #E2E8F0;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #E2E8F0;
            color: #475569;
        }
        table tfoot td {
            border-bottom: none;
            font-weight: 600;
        }
        .total-row {
            background: #F8FAFC;
        }
        .total-row td {
            font-weight: 700;
            color: #0F172A;
        }
        .grand-total {
            font-size: 18px;
            color: #2563EB;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pending { background: #FEF3C7; color: #D97706; }
        .status-processing { background: #DBEAFE; color: #2563EB; }
        .status-completed { background: #D1FAE5; color: #059669; }
        .status-cancelled { background: #FEE2E2; color: #DC2626; }
        .status-refunded { background: #F3F4F6; color: #6B7280; }
        .invoice-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #E2E8F0;
            text-align: center;
            color: #94A3B8;
            font-size: 14px;
        }
        .print-btn {
            display: inline-block;
            padding: 10px 30px;
            background: #2563EB;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .print-btn:hover {
            background: #1D4ED8;
        }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
            .invoice-container { border: none; padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <button onclick="window.print()" class="print-btn no-print">
            <i class="fas fa-print"></i> Print Invoice
        </button>

        <!-- Header -->
        <div class="invoice-header">
            <div>
                <h1>INVOICE</h1>
                <p class="order-number">Order #{{ $order->order_number }}</p>
            </div>
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px;">
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <div class="left">
                <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                <p><strong>Payment Status:</strong> 
                    <span class="status-badge status-{{ $order->payment_status }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </p>
                <p><strong>Order Status:</strong> 
                    <span class="status-badge status-{{ $order->order_status }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </p>
            </div>
            <div class="right">
                <p><strong>Invoice To:</strong></p>
                <p>{{ $order->customer_name }}</p>
                <p>{{ $order->customer_email }}</p>
                <p>{{ $order->customer_phone }}</p>
                <p>{{ $order->shipping_address }}</p>
                @if($order->city)
                    <p>{{ $order->city }}{{ $order->state ? ', ' . $order->state : '' }}</p>
                @endif
                @if($order->country)
                    <p>{{ $order->country }} {{ $order->zip_code }}</p>
                @endif
            </div>
        </div>

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 40%;">Item</th>
                    <th style="width: 15%;">Price</th>
                    <th style="width: 10%;">Qty</th>
                    <th style="width: 15%;">Discount</th>
                    <th style="width: 15%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $item->item_name }}</strong>
                            <br>
                            <small style="color: #94A3B8;">Type: {{ ucfirst($item->item_type ?? 'Course') }}</small>
                        </td>
                        <td>Rs. {{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            @if($item->discount > 0)
                                <span style="color: #059669;">- Rs. {{ number_format($item->discount, 2) }}</span>
                            @else
                                Rs. 0.00
                            @endif
                        </td>
                        <td><strong>Rs. {{ number_format($item->total, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Subtotal:</strong></td>
                    <td><strong>Rs. {{ number_format($order->subtotal, 2) }}</strong></td>
                </tr>
                @if($order->discount > 0)
                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Discount:</strong></td>
                    <td style="color: #059669;">- Rs. {{ number_format($order->discount, 2) }}</td>
                </tr>
                @endif
                @if($order->tax > 0)
                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Tax:</strong></td>
                    <td><strong>Rs. {{ number_format($order->tax, 2) }}</strong></td>
                </tr>
                @endif
                @if($order->shipping_charge > 0)
                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Shipping:</strong></td>
                    <td><strong>Rs. {{ number_format($order->shipping_charge, 2) }}</strong></td>
                </tr>
                @endif
                <tr class="total-row">
                    <td colspan="5" style="text-align: right; font-size: 16px;"><strong>Grand Total:</strong></td>
                    <td class="grand-total"><strong>Rs. {{ number_format($order->total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <!-- Notes -->
        @if($order->notes)
            <div style="margin-top: 20px; padding: 15px; background: #F8FAFC; border-radius: 6px;">
                <p><strong>Order Notes:</strong></p>
                <p style="color: #475569;">{{ $order->notes }}</p>
            </div>
        @endif

        <!-- Footer -->
        <div class="invoice-footer">
            <p>Thank you for your business!</p>
            <p style="font-size: 12px;">This is a system generated invoice. No signature required.</p>
            <p style="font-size: 12px;">Medical.pk - {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>