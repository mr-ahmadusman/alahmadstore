<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Famous;
use Illuminate\Http\Request;

class FamousController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $famous = Famous::all();
        return view('admin.pages.famous.index', compact('famous'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.pages.famous.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'percentage' => 'required|string|max:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $famous = new Famous;
        $famous->title = $request->title;
        $famous->percentage = $request->percentage;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/famous'), $imageName);
            $famous->image = 'uploads/famous/' . $imageName;
        }

        $famous->save();
        return redirect()->route('admin.famous.index')->with('success', 'Famous item added successfully!');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $famous = Famous::findOrFail($id);
        return view('admin.pages.famous.edit', compact('famous'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $famous = Famous::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'percentage' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $famous->title = $request->title;
        $famous->percentage = $request->percentage;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($famous->image && file_exists(public_path($famous->image))) {
                unlink(public_path($famous->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/famous'), $imageName);
            $famous->image = 'uploads/famous/' . $imageName;
        }

        $famous->save();
        return redirect()->route('admin.famous.index')->with('success', 'Famous item updated successfully!');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $famous = Famous::findOrFail($id);

        if ($famous->image && file_exists(public_path($famous->image))) {
            unlink(public_path($famous->image));
        }

        $famous->delete();
        return redirect()->route('admin.famous.index')->with('success', 'Famous item deleted successfully!');
    }
}
