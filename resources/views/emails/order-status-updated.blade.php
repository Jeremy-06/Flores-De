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
        .status { display: inline-block; padding: 6px 16px; border-radius: 20px; font-weight: bold; font-size: 14px; margin: 8px 0; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-delivered { background: #d1fae5; color: #065f46; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        .detail { padding: 8px 0; border-bottom: 1px solid #f3f4f6; font-size: 14px; color: #6b7280; }
        .footer { padding: 16px 24px; background: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌸 Order Status Update</h1>
        </div>
        <div class="body">
            <h2>Hi {{ $order->user->name }},</h2>
            <p style="color: #6b7280; font-size: 14px;">Your order <strong>{{ $order->order_number }}</strong> has been updated.</p>

            <p style="font-size: 14px; color: #374151;">New Status:</p>
            <span class="status status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>

            @if($order->status === 'delivered')
                <p style="color: #065f46; font-size: 14px; margin-top: 16px;">🎉 Your order has been delivered! We hope you enjoy your flowers.</p>
            @elseif($order->status === 'processing')
                <p style="color: #1e40af; font-size: 14px; margin-top: 16px;">Your order is now being prepared. We'll notify you when it's out for delivery.</p>
            @elseif($order->status === 'cancelled')
                <p style="color: #991b1b; font-size: 14px; margin-top: 16px;">Your order has been cancelled. If you have questions, please contact us.</p>
            @endif

            <div class="detail" style="margin-top: 16px;">
                <strong>Order:</strong> {{ $order->order_number }}<br>
                <strong>Total:</strong> ₱{{ number_format((float)$order->total, 2) }}<br>
                <strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Flores De. All rights reserved.
        </div>
    </div>
</body>
</html>
