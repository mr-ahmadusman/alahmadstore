<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Cart as CartModel;
use App\Models\Discount;
use App\Models\FooterContact;
use App\Models\Logo;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Paginator::useBootstrapFive();

    // Share common web data with all web views
    View::composer('web.*', function ($view) {
            $logo = Logo::query()->latest('id')->first();
            $footerContact = FooterContact::query()->latest('id')->first();
            $social = SocialMedia::query()->latest('id')->first();
            $categories = Category::with('subcategories')->get();
            $discounts = Discount::latest()->take(4)->get();

            // Build a normalized cart items array compatible with header expectations
            $cartItems = [];
            if (Auth::check()) {
                $rows = CartModel::with('product')->where('user_id', Auth::id())->get();
                foreach ($rows as $row) {
                    $cartItems[] = [
                        'id' => $row->product_id,
                        'name' => optional($row->product)->name ?? 'Item',
                        'image' => optional($row->product)->image ?? '',
                        'price' => (float)$row->price,
                        'quantity' => (int)$row->quantity,
                    ];
                }
            } else {
                $sessionCart = session('cart', []);
                if (is_array($sessionCart)) {
                    foreach ($sessionCart as $pid => $it) {
                        $cartItems[] = [
                            'id' => $it['id'] ?? $pid,
                            'name' => $it['name'] ?? 'Item',
                            'image' => $it['image'] ?? '',
                            'price' => (float)($it['price'] ?? 0),
                            'quantity' => (int)($it['quantity'] ?? ($it['qty'] ?? 1)),
                        ];
                    }
                }
            }

            $view->with(compact('logo', 'footerContact', 'cartItems', 'social', 'categories', 'discounts'));
        });
    }
}
