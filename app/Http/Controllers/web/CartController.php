<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Logo;
use App\Models\SocialMedia;
use App\Models\FooterContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    // Add to cart
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // price check (discount price use hoga agar exist kare)
        $price = $product->discount_price ?? $product->price;

        // quantity form se aayegi, agar nahi aayi to default 1
        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) {
            $quantity = 1;
        }

        if (Auth::check()) {
            // logged-in user → DB
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $id)
                            ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id'    => Auth::id(),
                    'product_id' => $id,
                    'quantity'   => $quantity,
                    'price'      => $price,
                ]);
            }
        } else {
            // guest user → session
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    'id'       => $product->id,
                    'name'     => $product->name,
                    'quantity' => $quantity,
                    'price'    => $price,
                    'image'    => $product->image,
                ];
            }
            session()->put('cart', $cart);
        }

        // ---- AJAX (drawer) request ----
        if ($request->wantsJson()) {
            $cartItems = $this->getCartItemsForDrawer();

            return response()->json([
                'success'     => true,
                'cart_count'  => count($cartItems),
                'drawer_html' => View::make('web.includes.cart-drawer', compact('cartItems'))->render(),
            ]);
        }

        // ---- Normal (non-AJAX) request ----
        // Agar form mein redirect_to_cart=1 bheja gaya hai (product-detail page ka Add to cart),
        // to seedha cart page par le jao. Baaki sab jagah (home page etc.) purana behavior waisa hi.
        if ($request->boolean('redirect_to_cart')) {
            return redirect()->route('cart.view')->with('success', 'Product added to cart!');
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // View cart
    public function viewCart()
    {
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();
        if (Auth::check()) {
            $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get()
                        ->map(function ($item) {
                            return [
                                'id'       => $item->product_id,
                                'name'     => $item->product->name,
                                'image'    => $item->product->image,
                                'price'    => $item->price,
                                'quantity' => $item->quantity,
                                'subtotal' => $item->price * $item->quantity,
                            ];
                        });
        } else {
            $cartItems = collect(session()->get('cart', []))->map(function ($item) {
                return [
                    'id'       => $item['id'],
                    'name'     => $item['name'],
                    'image'    => $item['image'],
                    'price'    => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ];
            });
        }

        $total = $cartItems->sum('subtotal');

        // Related products: cart mein jo products hain unki subcategory se milte-julte products,
        // cart mein already maujood products chhod kar (bilkul product-detail page wale pattern jaisa)
        $cartProductIds = $cartItems->pluck('id')->all();

        $subcategoryIds = Product::whereIn('id', $cartProductIds)
            ->pluck('subcategory_id')
            ->filter()
            ->unique();

        $relatedProducts = Product::with('images')
            ->whereIn('subcategory_id', $subcategoryIds)
            ->whereNotIn('id', $cartProductIds)
            ->take(8)
            ->get();

        // Cart khali ho ya subcategory na mile to kuch general products dikha do
        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::with('images')->whereNotIn('id', $cartProductIds)->latest()->take(8)->get();
        }

        return view('web.pages.cart', compact('logo', 'social', 'footerContact', 'cartItems', 'total', 'relatedProducts'));
    }

    // Remove item
    public function removeFromCart(Request $request, $id)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        // ---- AJAX (drawer) request ----
        if ($request->wantsJson()) {
            $cartItems = $this->getCartItemsForDrawer();

            return response()->json([
                'success'     => true,
                'cart_count'  => count($cartItems),
                'drawer_html' => View::make('web.includes.cart-drawer', compact('cartItems'))->render(),
            ]);
        }

        // ---- Normal (non-AJAX) request — purana behavior waisa hi ----
        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    // Update quantity
    public function updateCart(Request $request, $id)
    {
        // Agar drawer se AJAX request aa rahi hai (increase/decrease buttons)
        if ($request->has('action')) {
            $action = $request->input('action'); // 'increase' | 'decrease'

            if (Auth::check()) {
                $cartItem = Cart::where('user_id', Auth::id())
                                ->where('product_id', $id)
                                ->first();

                if ($cartItem) {
                    if ($action === 'increase') {
                        $cartItem->quantity += 1;
                    } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
                        $cartItem->quantity -= 1;
                    }
                    $cartItem->save();
                }
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$id])) {
                    if ($action === 'increase') {
                        $cart[$id]['quantity'] += 1;
                    } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
                        $cart[$id]['quantity'] -= 1;
                    }
                    session()->put('cart', $cart);
                }
            }
        } else {
            // Purana behavior — jab quantity seedhi bheji jati thi (cart page se)
            $quantity = $request->quantity;

            if (Auth::check()) {
                $cartItem = Cart::where('user_id', Auth::id())
                                ->where('product_id', $id)
                                ->first();

                if ($cartItem) {
                    $cartItem->quantity = $quantity;
                    $cartItem->save();
                }
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] = $quantity;
                    session()->put('cart', $cart);
                }
            }
        }

        // ---- AJAX (drawer) request ----
        if ($request->wantsJson()) {
            $cartItems = $this->getCartItemsForDrawer();

            return response()->json([
                'success'     => true,
                'cart_count'  => count($cartItems),
                'drawer_html' => View::make('web.includes.cart-drawer', compact('cartItems'))->render(),
            ]);
        }

        // ---- Normal (non-AJAX) request — purana behavior waisa hi ----
        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    // Poora cart khali karo
    public function clearCart(Request $request)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        // ---- AJAX (drawer) request ----
        if ($request->wantsJson()) {
            $cartItems = $this->getCartItemsForDrawer();

            return response()->json([
                'success'     => true,
                'cart_count'  => count($cartItems),
                'drawer_html' => View::make('web.includes.cart-drawer', compact('cartItems'))->render(),
            ]);
        }

        // ---- Normal (non-AJAX) request ----
        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }

    /**
     * Cart drawer ke liye fresh cart items array taiyar karta hai.
     * (view('cart-drawer') isi format ko use karta hai jo header/app.blade.php mein
     *  pehle se $cartItems ke naam se pass ho raha hota hai)
     */
    private function getCartItemsForDrawer()
    {
        if (Auth::check()) {
            return Cart::with('product')
                ->where('user_id', Auth::id())
                ->get()
                ->map(function ($item) {
                    return [
                        'id'       => $item->product_id,
                        'name'     => $item->product->name,
                        'image'    => $item->product->image,
                        'price'    => $item->price,
                        'quantity' => $item->quantity,
                    ];
                })
                ->toArray();
        }

        return session()->get('cart', []);
    }
}
