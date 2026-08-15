<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Logo;
use App\Models\SocialMedia;
use App\Models\FooterContact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Add to wishlist
    public function addToWishlist(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (Auth::check()) {
            // logged-in user → DB
            $exists = Wishlist::where('user_id', Auth::id())
                        ->where('product_id', $id)
                        ->first();

            if (!$exists) {
                Wishlist::create([
                    'user_id'    => Auth::id(),
                    'product_id' => $id,
                ]);
            }
        } else {
            // guest user → session
            $wishlist = session()->get('wishlist', []);

            if (!isset($wishlist[$id])) {
                $wishlist[$id] = [
                    'id'    => $product->id,
                    'name'  => $product->name,
                    'price' => $product->discount_price ?? $product->price,
                    'image' => $product->image,
                    'slug'  => $product->slug,
                ];
            }
            session()->put('wishlist', $wishlist);
        }

        // ---- AJAX request ----
        if ($request->wantsJson()) {
            $count = Auth::check()
                ? Wishlist::where('user_id', Auth::id())->count()
                : count(session()->get('wishlist', []));

            return response()->json([
                'success' => true,
                'wishlist_count' => $count,
                'message' => 'Product added to wishlist!',
            ]);
        }

        // ---- Normal request — purana behavior waisa hi ----
        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    // View wishlist
    public function viewWishlist()
    {
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();
        $categories = Category::all();
        $cartItems = session()->get('cart', []);

        if (Auth::check()) {
            $wishlistItems = Wishlist::with('product')
                        ->where('user_id', Auth::id())
                        ->get()
                        ->map(function ($item) {
                            return [
                                'id'    => $item->product_id,
                                'name'  => $item->product->name,
                                'image' => $item->product->image,
                                'price' => $item->product->discount_price ?? $item->product->price,
                                'slug'  => $item->product->slug,
                            ];
                        });
        } else {
            $wishlistItems = collect(session()->get('wishlist', []))->map(function ($item) {
                return [
                    'id'    => $item['id'],
                    'name'  => $item['name'],
                    'image' => $item['image'],
                    'price' => $item['price'],
                    'slug'  => $item['slug'],
                ];
            });
        }

        return view('web.pages.wishlist', compact('logo', 'social', 'footerContact', 'categories', 'cartItems', 'wishlistItems'));
    }

    // Remove item
    public function removeFromWishlist(Request $request, $id)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        } else {
            $wishlist = session()->get('wishlist', []);
            if (isset($wishlist[$id])) {
                unset($wishlist[$id]);
                session()->put('wishlist', $wishlist);
            }
        }

        // ---- AJAX request ----
        if ($request->wantsJson()) {
            $count = Auth::check()
                ? Wishlist::where('user_id', Auth::id())->count()
                : count(session()->get('wishlist', []));

            return response()->json([
                'success' => true,
                'wishlist_count' => $count,
                'message' => 'Product removed from wishlist.',
            ]);
        }

        // ---- Normal request — purana behavior waisa hi ----
        return redirect()->back()->with('success', 'Product removed from wishlist.');
    }
    // Clear entire wishlist
    public function clearWishlist(Request $request)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('wishlist');
        }

        // ---- AJAX request ----
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'wishlist_count' => 0,
                'message' => 'Wishlist cleared successfully.',
            ]);
        }

        // ---- Normal request ----
        return redirect()->back()->with('success', 'Wishlist cleared successfully.');
    }
}
