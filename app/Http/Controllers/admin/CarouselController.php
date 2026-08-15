<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Display a listing of the resource.
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.pages.carousel.index', compact('carousels'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.pages.carousel.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $carousel = new Carousel;
        $carousel->title = $request->title;
        $carousel->sub_title = $request->sub_title;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/carousel'), $imageName);
            $carousel->image = 'uploads/carousel/' . $imageName;
        }

        if ($request->hasFile('mobile_image')) {
            $mobileImageName = time().'_mobile.'.$request->mobile_image->extension();
            $request->mobile_image->move(public_path('uploads/carousel'), $mobileImageName);
            $carousel->mobile_image = 'uploads/carousel/' . $mobileImageName;
        }

        $carousel->save();
        return redirect()->route('carousel.index')->with('success', 'Carousel added successfully!');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.pages.carousel.edit', compact('carousel'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $carousel->title = $request->title;
        $carousel->sub_title = $request->sub_title;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($carousel->image && file_exists(public_path($carousel->image))) {
                unlink(public_path($carousel->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/carousel'), $imageName);
            $carousel->image = 'uploads/carousel/' . $imageName;
        }

        if ($request->hasFile('mobile_image')) {
            // Delete old mobile image if exists
            if ($carousel->mobile_image && file_exists(public_path($carousel->mobile_image))) {
                unlink(public_path($carousel->mobile_image));
            }
            $mobileImageName = time().'_mobile.'.$request->mobile_image->extension();
            $request->mobile_image->move(public_path('uploads/carousel'), $mobileImageName);
            $carousel->mobile_image = 'uploads/carousel/' . $mobileImageName;
        }

        $carousel->save();
        return redirect()->route('carousel.index')->with('success', 'Carousel updated successfully!');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        // Delete images from storage
        if ($carousel->image && file_exists(public_path($carousel->image))) {
            unlink(public_path($carousel->image));
        }
        if ($carousel->mobile_image && file_exists(public_path($carousel->mobile_image))) {
            unlink(public_path($carousel->mobile_image));
        }
        $carousel->delete();
        return redirect()->route('carousel.index')->with('success', 'Carousel deleted successfully!');
    }
}
