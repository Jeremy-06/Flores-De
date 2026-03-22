<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f9fafb; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .header { background: #dc2626; color: white; padding: 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 20px; }
        .body { padding: 24px; }
        .body h2 { color: #1f2937; font-size: 18px; margin-top: 0; }
        .detail { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f3f4f6; font-size: 14px; }
        .detail span:first-child { color: #6b7280; }
        .detail span:last-child { color: #1f2937; font-weight: 600; }
        .items { margin: 16px 0; }
        .items table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .items th { background: #f9fafb; padding: 8px; text-align: left; font-size: 12px; color: #6b7280; text-transform: uppercase; }
        .items td { padding: 8px; border-bottom: 1px solid #f3f4f6; }
        .total { text-align: right; font-size: 18px; font-weight: bold; color: #dc2626; padding: 16px 0; }
        .footer { padding: 16px 24px; background: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌸 Order Confirmed!</h1>
        </div>
        <div class="body">
            <h2>Thank you for your order, {{ $order->user->name }}!</h2>
            <p style="color: #6b7280; font-size: 14px;">Your order has been received and is being processed. Here are your order details:</p>

            <div class="detail"><span>Order Number</span><span>{{ $order->order_number }}</span></div>
            <div class="detail"><span>Date</span><span>{{ $order->created_at->format('M d, Y') }}</span></div>
            <div class="detail"><span>Delivery To</span><span>{{ $order->customer_name }}</span></div>
            <div class="detail"><span>Phone</span><span>{{ $order->customer_phone }}</span></div>
            <div class="detail"><span>Delivery Address</span><span>{{ $order->delivery_address }}</span></div>
            <div class="detail"><span>Delivery Date</span><span>{{ $order->delivery_date->format('M d, Y') }}</span></div>
            @if($order->message)
                <div class="detail"><span>Message</span><span>{{ $order->message }}</span></div>
            @endif

            <div class="items">
                <table>
                    <thead>
                        <tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->flower_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₱{{ number_format($item->price, 2) }}</td>
                            <td>₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="total">Total: ₱{{ number_format((float)$order->total, 2) }}</div>

            <p style="color: #6b7280; font-size: 13px;">A PDF receipt is attached to this email for your records.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Flores De. All rights reserved.
        </div>
    </div>
</body>
</html>
