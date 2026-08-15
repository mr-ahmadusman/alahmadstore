<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // DataTables client-side pagination handle karta hai,
        // isliye yahan paginate() nahi, poora data get() karna hai
        $products = Product::with(['category','subcategory'])->latest()->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.pages.product.index', compact('products','categories','subcategories'));
    }

    // Create page (optional)
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.pages.product.create', compact('categories','subcategories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'subcategory_id'  => 'required|exists:subcategories,id',
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric',
            'discount_price'  => 'nullable|numeric',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'stock'           => 'nullable|integer|min:0',
        ]);

        $slug = $this->uniqueSlug($request->name);

        $product = new Product();
        $product->category_id    = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->name           = $request->name;
        $product->slug           = $slug;
        $product->price          = $request->price;
        $product->discount_price = $request->discount_price;
        $product->short_description = $request->short_description;
        $product->description    = $request->description;
        $product->status         = $request->status ?? 1;
        $product->stock          = $request->stock ?? 0;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/'.$imageName;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success','Product added successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.pages.product.edit', compact('product','categories','subcategories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'subcategory_id'  => 'required|exists:subcategories,id',
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric',
            'discount_price'  => 'nullable|numeric',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'stock'           => 'nullable|integer|min:0',
        ]);

        $product->category_id    = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->name           = $request->name;
        $product->slug           = $this->uniqueSlug($request->name, $product->id);
        $product->price          = $request->price;
        $product->discount_price = $request->discount_price;
        $product->short_description = $request->short_description;
        $product->description    = $request->description;
        $product->status         = $request->status ?? 1;
        $product->stock          = $request->stock ?? 0;

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/'.$imageName;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success','Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path($product->image))) {
            @unlink(public_path($product->image));
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success','Product deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product status updated successfully!');
    }

    private function uniqueSlug(string $name, int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;

        $exists = Product::when($ignoreId, fn($q) => $q->where('id','!=',$ignoreId))
            ->where('slug', $slug)
            ->exists();

        while ($exists) {
            $slug = $base.'-'.$i;
            $i++;
            $exists = Product::when($ignoreId, fn($q) => $q->where('id','!=',$ignoreId))
                ->where('slug', $slug)
                ->exists();
        }

        return $slug;
    }

    public function showProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('web.pages.product-detail', compact('product'));
    }

    // Quickview modal ke liye JSON data
    public function quickview($id)
    {
        $product = Product::with('images')->findOrFail($id);

        $soldCount = OrderItem::where('product_id', $product->id)
            ->whereHas('order', function ($q) {
                $q->whereIn('order_status', ['processing', 'shipped', 'delivered']);
            })
            ->sum('qty');

        $images = collect();
        if ($product->image) {
            $images->push(asset($product->image));
        }
        foreach ($product->images as $img) {
            $images->push(asset($img->image_path));
        }
        if ($images->isEmpty()) {
            $images->push(asset('web/img/product/home1-pro-1.jpg'));
        }

        $discountPercent = $product->discount_price
            ? round((($product->price - $product->discount_price) / $product->price) * 100)
            : null;

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'short_description' => $product->short_description,
            'price' => number_format($product->price, 2),
            'discount_price' => $product->discount_price ? number_format($product->discount_price, 2) : null,
            'discount_percent' => $discountPercent,
            'stock' => $product->stock,
            'sold_count' => $soldCount,
            'images' => $images,
            'detail_url' => route('product.detail', $product->slug),
            'add_to_cart_url' => route('cart.add', $product->id),
            'wishlist_url' => route('wishlist.add', $product->id),
        ]);
    }
}
