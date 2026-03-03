<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.index');
    }

    public function show(Order $order): View
    {
        $order->load('items.flower', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,delivered,cancelled',
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Order status updated!');
    }
}