<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart as CartModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        [$items, $total] = $this->resolveCart();

        return view('web.pages.checkout', [
            'cartItems' => $items,
            'cartTotal' => $total,
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['nullable','email'],
            'phone' => ['required','string'],
            'address' => ['required','string'],
            'city' => ['nullable','string','max:255'],
            'postal_code' => ['nullable','string','max:255'],
            'payment_method' => ['required','in:COD'],
        ]);

        [$items, $total] = $this->resolveCart();
        if (empty($items)) {
            return back()->withErrors(['cart' => 'Your cart is empty.'])->withInput();
        }

        // Guest token resolve (agar login nahi hai to)
        $guestToken = null;
        if (!Auth::check()) {
            $guestToken = $request->cookie('guest_token') ?? (string) Str::uuid();
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'guest_token' => $guestToken,
                'name' => $data['name'],
                'email' => $data['email'] ?? (Auth::check() ? Auth::user()->email : null),
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'total_amount' => $total,
                'payment_method' => 'COD',
                'payment_status' => 'unpaid',
                'order_status' => 'pending',
            ]);

            foreach ($items as $it) {
                $productId = $it['id'] ?? null;
                $qty = (int)($it['qty'] ?? $it['quantity'] ?? 1);
                $price = (float)$it['price'];
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $it['name'] ?? ($productId ? optional(Product::find($productId))->name : 'Item'),
                    'qty' => $qty,
                    'price' => $price,
                    'subtotal' => $qty * $price,
                ]);

                // Optional stock decrement
                // if ($productId) { Product::where('id',$productId)->decrement('stock',$qty); }
            }

            DB::commit();

            $this->clearCart();

            // Email bhejna (agar email diya gaya hai)
            if (!empty($order->email)) {
                Mail::to($order->email)->queue(new OrderConfirmationMail($order));
            }

            $this->clearCart();

            $response = redirect()
                ->route('thankyou', ['order_id' => $order->id])
                ->with('success', 'Order placed successfully.');

            // Guest ke liye cookie set karo (1 saal validity)
            if ($guestToken) {
                $response->cookie('guest_token', $guestToken, 60 * 24 * 365);
            }

            return $response;
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors(['checkout' => 'Something went wrong. Please try again.'])->withInput();
        }
    }

    public function thankyou(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = $orderId ? Order::with('items')->find($orderId) : null;
        return view('web.pages.thankyou', compact('order'));
    }

    protected function resolveCart(): array
    {
        $items = [];
        $total = 0.0;

        if (Auth::check()) {
            $rows = CartModel::with('product')->where('user_id', Auth::id())->get();
            foreach ($rows as $row) {
                $name = optional($row->product)->name ?? 'Item';
                $image = optional($row->product)->image;
                $slug = optional($row->product)->slug;
                $price = (float)$row->price;
                $qty = (int)$row->quantity;
                $items[] = [
                    'id' => $row->product_id,
                    'name' => $name,
                    'image' => $image,
                    'slug' => $slug,
                    'price' => $price,
                    'qty' => $qty,
                    'subtotal' => $price * $qty,
                ];
                $total += $price * $qty;
            }
            return [$items, round($total, 2)];
        }

        $sessionCart = session('cart', []);
        if (is_array($sessionCart) && !empty($sessionCart)) {
            foreach ($sessionCart as $pid => $it) {
                $name = $it['name'] ?? 'Item';
                $image = $it['image'] ?? null;
                $product = Product::find($it['id'] ?? $pid);
                $slug = optional($product)->slug;
                $price = (float)($it['price'] ?? 0);
                $qty = (int)($it['qty'] ?? $it['quantity'] ?? 1);
                $items[] = [
                    'id' => $it['id'] ?? $pid,
                    'name' => $name,
                    'image' => $image,
                    'slug' => $slug,
                    'price' => $price,
                    'qty' => $qty,
                    'subtotal' => $price * $qty,
                ];
                $total += $price * $qty;
            }
            return [$items, round($total, 2)];
        }

        return [[], 0.0];
    }

    protected function clearCart(): void
    {
        if (Auth::check()) {
            CartModel::where('user_id', Auth::id())->delete();
        }
        if (session()->has('cart')) {
            session()->forget('cart');
        }
    }
}
