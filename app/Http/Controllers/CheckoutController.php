<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cartItems = \Cart::getContent();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $total = \Cart::getTotal();

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request): RedirectResponse
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'delivery_date' => 'required|date|after_or_equal:today',
            'message' => 'nullable|string|max:500',
        ]);

        $cartItems = \Cart::getContent();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $total = \Cart::getTotal();

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'total' => $total,
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'delivery_address' => $request->delivery_address,
                'delivery_date' => $request->delivery_date,
                'message' => $request->message,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'flower_id' => $item->id,
                    'flower_name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ]);
            }

            \Cart::clear();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
