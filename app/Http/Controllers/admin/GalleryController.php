<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Show gallery list
    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.pages.gallery.index', compact('galleries'));
    }

    // Store new gallery entry
    public function store(Request $request){
        // Check if it's the first gallery entry
        $isFirstEntry = Gallery::count() === 0;

        // Validation based on condition
        $validated = $request->validate([
            'title' => $isFirstEntry ? 'required|string|max:255' : 'nullable|string|max:255',
            'background_image' => $isFirstEntry ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file uploads
        // Background Image
            if ($request->hasFile('background_image')) {

                $backgroundImage = time().'_bg.'.$request->background_image->extension();

                $request->background_image->move(public_path('uploads/gallery'), $backgroundImage);

                $validated['background_image'] = 'uploads/gallery/'.$backgroundImage;
            }

            // Gallery Photo
            if ($request->hasFile('photo')) {

                $photo = time().'_photo.'.$request->photo->extension();

                $request->photo->move(public_path('uploads/gallery'), $photo);

                $validated['photo'] = 'uploads/gallery/'.$photo;
            }

        // Create gallery entry
        Gallery::create($validated);

        return redirect()->route('gallery.index')->with('success', 'Gallery item created successfully.');
    }

    // Update existing gallery entry
    public function update(Request $request, $id){
        $gallery = Gallery::findOrFail($id);

        // Make title nullable to match store logic (adjust if business rules differ)
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('background_image')) {

            if ($gallery->background_image && file_exists(public_path($gallery->background_image))) {
                unlink(public_path($gallery->background_image));
            }

            $backgroundImage = time().'_bg.'.$request->background_image->extension();

            $request->background_image->move(public_path('uploads/gallery'), $backgroundImage);

            $validated['background_image'] = 'uploads/gallery/'.$backgroundImage;

        } else {

            unset($validated['background_image']);
        }

        if ($request->hasFile('photo')) {

            if ($gallery->photo && file_exists(public_path($gallery->photo))) {
                unlink(public_path($gallery->photo));
            }

            $photo = time().'_photo.'.$request->photo->extension();

            $request->photo->move(public_path('uploads/gallery'), $photo);

            $validated['photo'] = 'uploads/gallery/'.$photo;

        } else {

            unset($validated['photo']);
        }

        // Update the gallery entry
        $gallery->update($validated);

        return redirect()->route('gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    // Delete gallery content
    public function destroy($id){
        $gallery = Gallery::findOrFail($id);

        // Delete associated files
        if ($gallery->background_image) {
            Storage::disk('public')->delete($gallery->background_image);
        }
        if ($gallery->photo) {
            Storage::disk('public')->delete($gallery->photo);
        }

        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'Gallery item deleted successfully.');
    }
}
