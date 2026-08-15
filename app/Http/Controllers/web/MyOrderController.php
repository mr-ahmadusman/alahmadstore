<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $orders = Order::with('items.product')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        } else {
            $token = $request->cookie('guest_token');
            $orders = $token
                ? Order::with('items.product')->where('guest_token', $token)->latest()->get()
                : collect();
        }

        return view('web.pages.my-order', compact('orders'));
    }
    public function guestView(Request $request, Order $order)
{
    $token = $request->query('token');

    // Guest token match karna zaroori hai
    if (!$token || $order->guest_token !== $token) {
        abort(403, 'Unauthorized access to this order.');
    }

    // Cookie set kar dete hain taake wo aage bhi "My Orders" dekh sake usi browser se
    $orders = Order::with('items.product')
        ->where('guest_token', $token)
        ->latest()
        ->get();

    return view('web.pages.my-order', compact('orders'))
        ->withCookie(cookie('guest_token', $token, 60 * 24 * 365));
  }
}
