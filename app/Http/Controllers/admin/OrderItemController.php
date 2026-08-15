<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderItem::query()->with('order');

        if ($request->filled('order_id')) {
            $query->where('order_id', $request->integer('order_id'));
        }

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('product_name', 'like', "%{$q}%");
            });
        }

        $items = $query->latest()->paginate(20)->withQueryString();

        return view('admin.pages.orderitem.index', compact('items'));
    }
}
