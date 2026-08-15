<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\LogoController;
use App\Http\Controllers\admin\SocialMediaController;
use App\Http\Controllers\admin\FooterContactController;
use App\Http\Controllers\admin\CarouselController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\Admin\FamousController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\SubcategoryController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\web\WebController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\MyOrderController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\web\CommentController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\admin\ContactController as AdminContactController;
use App\Http\Controllers\Web\WishlistController;
use App\Http\Controllers\web\ReviewController;
use App\Http\Controllers\admin\OrderItemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [WebController::class, 'home'])->name('web.home');
Route::get('/about', [WebController::class, 'about'])->name('web.about');
Route::get('/gallery', [WebController::class, 'gallery'])->name('web.gallery');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/blogs', [WebController::class, 'blog'])->name('web.blogs');
Route::get('/blogs/{slug}', [WebController::class, 'showFrontend'])->name('blog.detail');
Route::post('/blogs/{id}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::get('/product/{slug}', [WebController::class, 'showProduct'])->name('product.detail');
Route::post('/product/{id}/review', [ReviewController::class, 'store'])->name('review.store');
Route::get('/product-quickview/{id}', [ProductController::class, 'quickview'])->name('product.quickview');
Route::get('/search', [WebController::class, 'search'])->name('search');
Route::get('/terms', [WebController::class, 'terms'])->name('terms');
Route::get('/privacy', [WebController::class, 'privacy'])->name('privacy');
Route::get('/payment-policy', [WebController::class, 'paymentPolicy'])->name('payment.policy');
Route::get('/return-policy', [WebController::class, 'returnPolicy'])->name('return.policy');
Route::get('/shipping-policy', [WebController::class, 'shippingPolicy'])->name('shipping.policy');
Route::get('/search/suggestions',[WebController::class,'suggestions']) ->name('search.suggestions');


// Cart Routes
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');


// wishlist Routes
 Route::post('/wishlist/add/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::delete('/wishlist/clear', [WishlistController::class, 'clearWishlist'])->name('wishlist.clear');

// Checkout (public)
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('thankyou');

    Route::get('/my-orders', [MyOrderController::class, 'index'])->name('my.orders');
    Route::get('/order/view/{order}', [MyOrderController::class, 'guestView'])
    ->name('order.guest.view')
    ->middleware('signed');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/admin/order', [AdminController::class, 'order'])->name('admin.order');

    // Orders Management
    Route::get('admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::post('admin/orders/{order}/payment', [AdminOrderController::class, 'updatePaymentStatus'])->name('admin.orders.updatePaymentStatus');

    // Order Items Management
    Route::get('admin/order-items', [OrderItemController::class, 'index'])->name('admin.orderitems.index');
    // Add more routes for order items as needed

    // Store Logo Routes
    Route::get('admin/logo', [LogoController::class, 'index'])->name('admin.pages.store_logo.index');
    Route::post('admin/logo', [LogoController::class, 'store'])->name('logos.store');
    Route::put('admin/logo/{logo}', [LogoController::class, 'update'])->name('logos.update');
    Route::delete('admin/logo/{logo}', [LogoController::class, 'destroy'])->name('logos.destroy');
    // Social Media Routes
    Route::get('admin/socialmedia', [SocialMediaController::class, 'index'])->name('admin.pages.socialmedia.index');
    Route::post('admin/socialmedia', [SocialMediaController::class, 'store'])->name('socialmedia.create');
    Route::put('admin/socialmedia/{id}', [SocialMediaController::class, 'update'])->name('socialmedia.update');
    Route::delete('admin/socialmedia/{id}', [SocialMediaController::class, 'destroy'])->name('socialmedia.delete');

    // FooterContact Routes
    Route::get('admin/footercontact', [FooterContactController::class, 'index'])->name('footercontact.index');
    Route::get('admin/footercontact/create', [FooterContactController::class, 'create'])->name('footercontact.create');
    Route::post('admin/footercontact', [FooterContactController::class, 'store'])->name('footercontact.store');
    Route::get('admin/footercontact/{id}/edit', [FooterContactController::class, 'edit'])->name('footercontact.edit');
    Route::put('admin/footercontact/{id}', [FooterContactController::class, 'update'])->name('footercontact.update');
    Route::delete('admin/footercontact/{id}', [FooterContactController::class, 'destroy'])->name('footercontact.destroy');

    // About Routes
    Route::get('admin/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('admin/about/create', [AboutController::class, 'create'])->name('about.create');
    Route::post('admin/about', [AboutController::class, 'store'])->name('about.store');
    Route::get('admin/about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('admin/about/{id}', [AboutController::class, 'update'])->name('about.update');
    Route::delete('admin/about/{id}', [AboutController::class, 'destroy'])->name('about.destroy');

    // Carousel Routes
    Route::get('admin/carousel', [CarouselController::class, 'index'])->name('carousel.index');
    Route::get('admin/carousel/create', [CarouselController::class, 'create'])->name('carousel.create');
    Route::post('admin/carousel', [CarouselController::class, 'store'])->name('carousel.store');
    Route::get('admin/carousel/{id}/edit', [CarouselController::class, 'edit'])->name('carousel.edit');
    Route::put('admin/carousel/{id}', [CarouselController::class, 'update'])->name('carousel.update');
    Route::delete('admin/carousel/{id}', [CarouselController::class, 'destroy'])->name('carousel.destroy');

                // Famous Routes (Admin)
    Route::get('admin/famous', [FamousController::class, 'index'])->name('admin.famous.index');
    Route::post('admin/famous', [FamousController::class, 'store'])->name('admin.famous.store');
    Route::put('admin/famous/{id}', [FamousController::class, 'update'])->name('admin.famous.update');
    Route::delete('admin/famous/{id}', [FamousController::class, 'destroy'])->name('admin.famous.destroy');

    // Blog Routes
    Route::get('admin/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('admin/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('admin/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('admin/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('admin/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('admin/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');

   // Gallery Routes
    Route::get('admin/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('admin/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('admin/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('admin/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Category Routes
   Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('category.create');
    Route::put('admin/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('admin/categories/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    // Subcategory Routes
    Route::get('admin/subcategories', [SubcategoryController::class, 'index'])->name('admin.subcategories.index');
    Route::get('admin/categories/{category}/subcategories', [SubcategoryController::class, 'getByCategory'])->name('admin.categories.subcategories');
    Route::get('admin/subcategories/create', [SubcategoryController::class, 'create'])->name('admin.subcategories.create');
    Route::post('admin/subcategories', [SubcategoryController::class, 'store'])->name('admin.subcategories.store');
    Route::get('admin/subcategories/{id}/edit', [SubcategoryController::class, 'edit'])->name('admin.subcategories.edit');
    Route::put('admin/subcategories/{id}', [SubcategoryController::class, 'update'])->name('admin.subcategories.update');
    Route::delete('admin/subcategories/{id}', [SubcategoryController::class, 'destroy'])->name('admin.subcategories.destroy');

    // Dependent dropdown (AJAX) — for Products form later
    Route::get('admin/categories/{id}/subcategories', [SubcategoryController::class, 'byCategory'])->name('admin.categories.subcategories');

    // Product Routes
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Toggle Status (POST request ke liye)
    Route::post('admin/products/{id}/togglestatus', [ProductController::class, 'toggleStatus'])->name('admin.products.togglestatus');

    // Product Images (Gallery) Routes
    Route::get('admin/products/{product}/images', [ProductImageController::class, 'index'])->name('admin.product-images.index');
    Route::post('admin/products/{product}/images', [ProductImageController::class, 'store'])->name('admin.product-images.store');
    Route::delete('admin/products/{product}/images/{image}', [ProductImageController::class, 'destroy'])->name('admin.product-images.destroy');

    // Contact Messages (Admin)
Route::get('admin/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
Route::delete('admin/contacts/{id}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');

    // Discount Routes
Route::get('admin/discounts', [DiscountController::class, 'index'])->name('discount.index');
Route::post('admin/discounts', [DiscountController::class, 'store'])->name('discount.create');
Route::put('admin/discounts/{id}', [DiscountController::class, 'update'])->name('discount.update');
Route::delete('admin/discounts/{id}', [DiscountController::class, 'destroy'])->name('discount.delete');

});
