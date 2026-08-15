<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // ---------- Top Stats ----------
        $totalEarnings  = Order::where('payment_status', 'paid')->sum('total_amount');
        $totalOrders    = Order::count();
        $pendingOrders  = Order::where('order_status', 'pending')->count();
        $deliveredOrders = Order::where('order_status', 'delivered')->count();
        $totalProducts  = Product::count();
        $inStockProducts = Product::where('stock', '>', 0)->count();
        $totalCustomers = User::where('role', 'customer')->count();

        $paidOrders   = Order::where('payment_status', 'paid')->count();
        $unpaidOrders = $totalOrders - $paidOrders;

        // ---------- Last 6 Months: Revenue, Orders, New Customers ----------
        $chartLabels   = [];
        $revenueData   = [];
        $ordersData    = [];
        $customersData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartLabels[] = $month->format('M');

            $monthOrders = Order::whereYear('created_at', $month->year)
                                 ->whereMonth('created_at', $month->month);

            $revenueData[]   = (float) (clone $monthOrders)->sum('total_amount');
            $ordersData[]    = (clone $monthOrders)->count();
            $customersData[] = User::where('role', 'customer')
                                    ->whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->count();
        }

        // Month-over-month growth (real, based on last 2 months of the chart data above)
        $lastMonthRevenue = $revenueData[count($revenueData) - 2] ?? 0;
        $thisMonthRevenue = $revenueData[count($revenueData) - 1] ?? 0;
        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : ($thisMonthRevenue > 0 ? 100 : 0);

        $lastMonthOrders = $ordersData[count($ordersData) - 2] ?? 0;
        $thisMonthOrders = $ordersData[count($ordersData) - 1] ?? 0;
        $ordersGrowth = $lastMonthOrders > 0
            ? round((($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 1)
            : ($thisMonthOrders > 0 ? 100 : 0);

        // ---------- Percentages for gauges ----------
        $paidPercent      = $totalOrders > 0 ? round(($paidOrders / $totalOrders) * 100) : 0;
        $deliveredPercent = $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100) : 0;
        $stockPercent     = $totalProducts > 0 ? round(($inStockProducts / $totalProducts) * 100) : 0;
        $pendingPercent   = $totalOrders > 0 ? round(($pendingOrders / $totalOrders) * 100) : 0;

        // ---------- Top Selling Products ----------
        $topSales = OrderItem::select('product_id', 'product_name')
            ->selectRaw('SUM(qty) as total_qty, SUM(subtotal) as total_revenue')
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_qty')
            ->limit(6)
            ->with('product:id,image,price')
            ->get();

        // ---------- Latest Orders ----------
        $recentOrders = Order::withCount('items')->latest()->take(5)->get();

        // ---------- Order Status Distribution ----------
        $statusCounts = [
            'pending'    => Order::where('order_status', 'pending')->count(),
            'processing' => Order::where('order_status', 'processing')->count(),
            'shipped'    => Order::where('order_status', 'shipped')->count(),
            'delivered'  => $deliveredOrders,
            'cancelled'  => Order::where('order_status', 'cancelled')->count(),
        ];

        return view('admin.pages.home', compact(
            'totalEarnings', 'totalOrders', 'pendingOrders', 'deliveredOrders',
            'totalProducts', 'inStockProducts', 'totalCustomers',
            'paidOrders', 'unpaidOrders',
            'chartLabels', 'revenueData', 'ordersData', 'customersData',
            'revenueGrowth', 'ordersGrowth',
            'paidPercent', 'deliveredPercent', 'stockPercent', 'pendingPercent',
            'topSales', 'recentOrders', 'statusCounts'
        ));
    }

    public function order()
    {
        return view('admin.pages.order.index');
    }
}
