<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20480',   // 20MB
            'video'   => 'nullable|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/webm|max:51200', // 50MB
        ]);

        $review = new Review();
        $review->product_id = $product->id;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->rating = $request->rating;
        $review->comment = $request->comment;

        if ($request->hasFile('image')) {
            $imageName = time() . '_img.' . $request->image->extension();
            $request->image->move(public_path('uploads/reviews'), $imageName);
            $review->image = 'uploads/reviews/' . $imageName;
        }

        if ($request->hasFile('video')) {
            $videoName = time() . '_vid.' . $request->video->extension();
            $request->video->move(public_path('uploads/reviews'), $videoName);
            $review->video = 'uploads/reviews/' . $videoName;
        }

        $review->save();

        return redirect()->back()->with('success', 'Thank you! Your review has been submitted.');
    }
}
