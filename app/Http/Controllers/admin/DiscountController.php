<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $discounts = Discount::latest()->get();
        return view('admin.pages.discount.index', compact('discounts'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $discount = new Discount();
        $discount->name = $request->name;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/discounts'), $imageName);
            $discount->image = 'uploads/discounts/' . $imageName;
        }

        $discount->save();

        return redirect()->route('discount.index')->with('success', 'Discount added successfully!');
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $discount->name = $request->name;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($discount->image && file_exists(public_path($discount->image))) {
                unlink(public_path($discount->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/discounts'), $imageName);
            $discount->image = 'uploads/discounts/' . $imageName;
        }

        $discount->save();

        return redirect()->route('discount.index')->with('success', 'Discount updated successfully!');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        if ($discount->image && file_exists(public_path($discount->image))) {
            unlink(public_path($discount->image));
        }

        $discount->delete();

        return redirect()->route('discount.index')->with('success', 'Discount deleted successfully!');
    }
}
