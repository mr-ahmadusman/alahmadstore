<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Famous;
use App\Models\FooterContact;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;
use App\Models\SocialMedia;
use App\Models\Blog;
use App\Models\Gallery;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();
        $carousels = Carousel::all();
        $about = About::first();
        $abouts = About::all();
        $categories = Category::with('subcategories.products.images')->get();

        $subcategories = Subcategory::all();
        $products = Product::all();
        $famous = Famous::all();
        $reviews = Review::with('product')->latest()->take(12)->get();
        $cartItems = session()->get('cart', []);
        $galleryPhotos = Gallery::latest()->take(8)->get(); // 👈 ye line add ki

        return view('web.pages.home', compact('logo', 'social', 'footerContact', 'carousels', 'about', 'abouts', 'categories', 'products', 'subcategories', 'famous', 'cartItems', 'reviews', 'galleryPhotos')); // 👈 galleryPhotos yahan bhi add karo
    }

    public function about(){
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();
        $categories = Category::all();
        $about = About::first(); // for banner
        $abouts = About::all();  // for carousel
        $cartItems = session()->get('cart', []);
        return view('web.pages.about', compact('logo', 'social', 'footerContact', 'categories', 'about', 'abouts', 'cartItems'));
    }

    public function blog(Request $request){
    $logo = Logo::first();
    $social = SocialMedia::first();
    $footerContact = FooterContact::first();
    $categories = Category::all();

    $keyword = $request->q;

    $blogs = Blog::when($keyword, function ($query) use ($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        })
        ->latest()
        ->paginate(6)
        ->withQueryString();

    $cartItems = session()->get('cart', []);
    return view('web.pages.blog', compact('logo', 'social', 'footerContact', 'categories', 'blogs', 'keyword', 'cartItems'));
}

    public function showFrontend($slug){
    $logo = Logo::first();
    $social = SocialMedia::first();
    $footerContact = FooterContact::first();
    $categories = Category::all();
    $blog = Blog::where('slug', $slug)->firstOrFail();
    $blogs = Blog::where('id', '!=', $blog->id)->latest()->take(5)->get();

    $prevBlog = Blog::where('created_at', '<', $blog->created_at)->orderBy('created_at', 'desc')->first();
    $nextBlog = Blog::where('created_at', '>', $blog->created_at)->orderBy('created_at', 'asc')->first();

    $cartItems = session()->get('cart', []);
    return view('web.pages.blog-detail', compact('logo', 'social', 'footerContact', 'categories', 'blog', 'blogs', 'prevBlog', 'nextBlog', 'cartItems'));
}

    public function gallery(){
    $logo = Logo::first();
    $social = SocialMedia::first();
    $footerContact = FooterContact::first();
    $categories = Category::all();
    $gallery = Gallery::first(); // for title & background
    $galleries = Gallery::all(); // for photos
    $cartItems = session()->get('cart', []);
    return view('web.pages.gallery', compact('logo', 'social', 'footerContact', 'categories', 'gallery', 'galleries', 'cartItems'));
    }

    public function showProduct($slug){
    $logo = Logo::first();
    $social = SocialMedia::first();
    $footerContact = FooterContact::first();
    $categories = Category::with('subcategories.products.images')->get();
    $subcategories = Subcategory::all();
    $product = Product::with(['images', 'reviews'])->where('slug', $slug)->firstOrFail();
    $relatedProducts = Product::where('subcategory_id', $product->subcategory_id)
        ->where('id', '!=', $product->id)
        ->take(6)
        ->get();
    $cartItems = session()->get('cart', []);
    return view('web.pages.product-detail', compact('logo', 'social', 'footerContact', 'product', 'categories', 'subcategories', 'relatedProducts', 'cartItems'));
    }
   public function search(Request $request)
    {
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();

        $categories = Category::with('subcategories')->get();
        $cartItems = session()->get('cart', []);

        $keyword = $request->q;

        $products = Product::with(['category','subcategory'])
            ->where('name', 'LIKE', "%{$keyword}%")

            ->orWhereHas('category', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%");
            })

            ->orWhereHas('subcategory', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%");
            })

            ->paginate(12)
            ->withQueryString();

        return view(
            'web.pages.search',
            compact(
                'logo',
                'social',
                'footerContact',
                'categories',
                'cartItems',
                'products',
                'keyword'
            )
        );
    }
    public function suggestions(Request $request)
    {
        $keyword = $request->q;

        if (!$keyword) {
            return response()->json([]);
        }

        $products = Product::where('name', 'LIKE', "%{$keyword}%")
            ->select('id', 'name', 'slug')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Product';
                return $item;
            });

        $categories = Category::where('name', 'LIKE', "%{$keyword}%")
            ->select('id', 'name', 'slug')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Category';
                return $item;
            });

        $subcategories = Subcategory::where('name', 'LIKE', "%{$keyword}%")
            ->select('id', 'name', 'slug')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Subcategory';
                return $item;
            });

        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
     public function terms(){
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();
        $categories = Category::with('subcategories.products.images')->get();
        $cartItems = session()->get('cart', []);
        return view('web.pages.terms', compact('logo', 'social', 'footerContact', 'categories', 'cartItems'));
    }

    public function privacy(){
    $logo = Logo::first();
    $social = SocialMedia::first();
    $footerContact = FooterContact::first();
    $categories = Category::with('subcategories.products.images')->get();
    $about = About::first();
    $cartItems = session()->get('cart', []);
    return view('web.pages.privacy', compact('logo', 'social', 'footerContact', 'categories', 'about', 'cartItems'));
    }
    public function paymentPolicy(){
    $logo = Logo::first();
    $social = SocialMedia::first();
    $footerContact = FooterContact::first();
    $categories = Category::with('subcategories.products.images')->get();
    $cartItems = session()->get('cart', []);
    return view('web.pages.payment-policy', compact('logo', 'social', 'footerContact', 'categories', 'cartItems'));
   }
   public function returnPolicy()
   {
    $logo = Logo::first();
    $social = SocialMedia::first();
    $footerContact = FooterContact::first();
    $categories = Category::with('subcategories.products.images')->get();
    $cartItems = session()->get('cart', []);

    return view('web.pages.return-policy', compact(
        'logo',
        'social',
        'footerContact',
        'categories',
        'cartItems'
    ));
  }
  public function shippingPolicy()
    {
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();
        $categories = Category::with('subcategories.products.images')->get();
        $cartItems = session()->get('cart', []);

        return view('web.pages.shipping-policy', compact(
            'logo',
            'social',
            'footerContact',
            'categories',
            'cartItems'
        ));
    }


}
