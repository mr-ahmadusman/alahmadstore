<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function index($productId)
    {
        $product = Product::with('images')->findOrFail($productId);
        return view('admin.pages.product-images.index', compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imageName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/products/gallery'), $imageName);
                $product->images()->create([
                    'image_path' => 'uploads/products/gallery/'.$imageName,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully');
    }

    public function destroy($productId, $imageId)
    {
        $product = Product::findOrFail($productId);
        $image = ProductImage::where('product_id', $product->id)->findOrFail($imageId);

        if ($image->image_path && file_exists(public_path($image->image_path))) {
            @unlink(public_path($image->image_path));
        }
        $image->delete();

        return back()->with('success', 'Image deleted successfully');
    }
}
