<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; margin: 0; padding: 30px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #dc2626; padding-bottom: 15px; }
        .header h1 { color: #dc2626; margin: 0; font-size: 24px; }
        .header p { color: #999; margin: 5px 0 0; font-size: 11px; }
        .receipt-title { text-align: center; background: #f9fafb; padding: 10px; margin: 20px 0; border-radius: 4px; }
        .receipt-title h2 { margin: 0; font-size: 16px; color: #1f2937; }
        .info-grid { width: 100%; margin-bottom: 20px; }
        .info-grid td { padding: 4px 0; vertical-align: top; }
        .info-grid .label { color: #6b7280; width: 140px; }
        .info-grid .value { color: #1f2937; font-weight: 600; }
        .items-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .items-table th { background: #f9fafb; padding: 8px 10px; text-align: left; font-size: 11px; text-transform: uppercase; color: #6b7280; border-bottom: 2px solid #e5e7eb; }
        .items-table td { padding: 8px 10px; border-bottom: 1px solid #f3f4f6; }
        .items-table .right { text-align: right; }
        .total-row { border-top: 2px solid #dc2626; }
        .total-row td { padding: 12px 10px; font-size: 16px; font-weight: bold; color: #dc2626; }
        .footer { text-align: center; margin-top: 40px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #9ca3af; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Flores De</h1>
        <p>Fresh Flowers for Every Occasion</p>
    </div>

    <div class="receipt-title">
        <h2>Order Receipt</h2>
    </div>

    <table class="info-grid">
        <tr><td class="label">Order Number:</td><td class="value">{{ $order->order_number }}</td></tr>
        <tr><td class="label">Order Date:</td><td class="value">{{ $order->created_at->format('F d, Y h:i A') }}</td></tr>
        <tr><td class="label">Customer:</td><td class="value">{{ $order->customer_name }}</td></tr>
        <tr><td class="label">Phone:</td><td class="value">{{ $order->customer_phone }}</td></tr>
        <tr><td class="label">Delivery Address:</td><td class="value">{{ $order->delivery_address }}</td></tr>
        <tr><td class="label">Delivery Date:</td><td class="value">{{ $order->delivery_date->format('F d, Y') }}</td></tr>
        @if($order->message)
            <tr><td class="label">Special Message:</td><td class="value">{{ $order->message }}</td></tr>
        @endif
        <tr><td class="label">Status:</td><td class="value">{{ ucfirst($order->status) }}</td></tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th class="right">Price</th>
                <th class="right">Qty</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->flower_name }}</td>
                <td class="right">{{ number_format($item->price, 2) }}</td>
                <td class="right">{{ $item->quantity }}</td>
                <td class="right">{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="right">TOTAL</td>
                <td class="right">PHP {{ number_format((float)$order->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Thank you for choosing Flores De!</p>
        <p>This is a computer-generated receipt. No signature required.</p>
        <p>&copy; {{ date('Y') }} Flores De. All rights reserved.</p>
    </div>
</body>
</html>
