<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Status filter (pending, processing, shipped, delivered, cancelled)
        if ($request->filled('order_status')) {
            $query->where('order_status', $request->order_status);
        }

        // Date range filter (bank statement wali tarah)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59',
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // DataTables client-side pagination ke liye poora filtered data get() karna hai
        $orders = $query->latest()->get();

        return view('admin.pages.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');

        return response()->json([
            'success' => true,
            'order' => [
                'id' => $order->id,
                'name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone,
                'address' => $order->address,
                'city' => $order->city,
                'postal_code' => $order->postal_code,
                'total_amount' => $order->total_amount,
                'payment_method' => $order->payment_method,
                'payment_status' => $order->payment_status,
                'order_status' => $order->order_status,
                'created_at' => optional($order->created_at)->toDateTimeString(),
            ],

            'items' => $order->items->map(function ($item) {

                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product_name,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,

                    'image' => optional($item->product)->image,
                ];

            }),
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'order_status' => ['required','in:pending,processing,shipped,delivered,cancelled'],
        ]);
        $order->update(['order_status' => $data['order_status']]);
        return response()->json(['success' => true, 'message' => 'Order status updated.']);
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'payment_status' => ['required','in:unpaid,paid'],
        ]);
        $order->update(['payment_status' => $data['payment_status']]);
        return response()->json(['success' => true, 'message' => 'Payment status updated.']);
    }
}
