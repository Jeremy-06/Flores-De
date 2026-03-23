<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Flower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $stats = [
            'total_flowers' => Flower::count(),
            'total_orders' => Order::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_revenue' => (float) Order::where('status', 'delivered')->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Chart 1: Yearly Sales (last 5 years)
        $yearlySales = Order::where('status', 'delivered')
            ->where('created_at', '>=', now()->subYears(5)->startOfYear())
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total) as total_revenue'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Chart 2: Product Sales Contribution (by revenue)
        $productSales = DB::table('order_items')
            ->join('flowers', 'order_items.flower_id', '=', 'flowers.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'delivered')
            ->select('flowers.name', DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'))
            ->groupBy('flowers.name')
            ->orderByDesc('total_revenue')
            ->limit(10)
            ->get();

        // Chart 3: Date Range Sales (with filter)
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        $dateRangeSales = Order::where('status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
            ->select(
                DB::raw("DATE(created_at) as date"),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'stats', 'recentOrders',
            'yearlySales', 'productSales', 'dateRangeSales',
            'startDate', 'endDate'
        ));
    }
}
