<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    /**
     * Display all logos
     */
    public function index()
    {
        $logos = Logo::latest()->get();
        return view('admin.pages.store_logo.index', compact('logos'));
    }

    /**
     * Store new logo
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $logo = new Logo();

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/logos'), $imageName);

            $logo->image = 'uploads/logos/' . $imageName;
        }

        $logo->save();

        return redirect()->back()->with('success', 'Logo uploaded successfully.');
    }

    /**
     * Update logo
     */
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // Delete old image
            if ($logo->image && file_exists(public_path($logo->image))) {
                unlink(public_path($logo->image));
            }

            // Upload new image
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/logos'), $imageName);

            $logo->image = 'uploads/logos/' . $imageName;
        }

        $logo->save();

        return redirect()->back()->with('success', 'Logo updated successfully.');
    }

    /**
     * Delete logo
     */
    public function destroy(Logo $logo)
    {
        if ($logo->image && file_exists(public_path($logo->image))) {
            unlink(public_path($logo->image));
        }

        $logo->delete();

        return redirect()->back()->with('success', 'Logo deleted successfully.');
    }
}