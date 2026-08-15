<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    // Show about list
    public function index()
    {
        $abouts = About::all();
        return view('admin.pages.about.index', compact('abouts'));
    }

    // Store new about entry
    public function store(Request $request)
    {
        // Check if it's the first entry
        $isFirstEntry = About::count() === 0;

        // Validation based on condition
        $validated = $request->validate([
            'banner_title' => $isFirstEntry ? 'required|string|max:255' : 'nullable|string|max:255',
            'banner_image' => $isFirstEntry ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240' : 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'feature_description' => $isFirstEntry ? 'required|string' : 'nullable|string',
            't_name' => 'required|string|max:255',
            't_title' => 'required|string|max:255',
            't_description' => 'required|string',
            't_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        // Banner Image Upload
        if ($request->hasFile('banner_image')) {

            $bannerImage = time() . '_banner.' . $request->banner_image->extension();

            $request->banner_image->move(public_path('uploads/about'), $bannerImage);

            $validated['banner_image'] = 'uploads/about/' . $bannerImage;
        }

        // Team Image Upload
        if ($request->hasFile('t_image')) {

            $teamImage = time() . '_team.' . $request->t_image->extension();

            $request->t_image->move(public_path('uploads/about'), $teamImage);

            $validated['t_image'] = 'uploads/about/' . $teamImage;
        }


        // Create about content
        About::create($validated);

        return redirect()->route('about.index')->with('success', 'About content created successfully.');
    }

    // Corrected update method in AboutController
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        // Validation rules for update
        $validated = $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'feature_description' => 'required|string',
            't_name' => 'required|string|max:255',
            't_title' => 'required|string|max:255',
            't_description' => 'required|string',
            't_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        // Handle banner image update
        if ($request->hasFile('banner_image')) {

            // Delete Old Banner
            if ($about->banner_image && file_exists(public_path($about->banner_image))) {

                unlink(public_path($about->banner_image));
            }

            // Upload New Banner
            $bannerImage = time() . '_banner.' . $request->banner_image->extension();

            $request->banner_image->move(public_path('uploads/about'), $bannerImage);

            $validated['banner_image'] = 'uploads/about/' . $bannerImage;

        } else {

            $validated['banner_image'] = $about->banner_image;
        }

        // Handle team image update
        if ($request->hasFile('t_image')) {

         // Delete Old Team Image
            if ($about->t_image && file_exists(public_path($about->t_image))) {

                unlink(public_path($about->t_image));
            }

            // Upload New Team Image
            $teamImage = time() . '_team.' . $request->t_image->extension();

            $request->t_image->move(public_path('uploads/about'), $teamImage);

            $validated['t_image'] = 'uploads/about/' . $teamImage;

        } else {

            $validated['t_image'] = $about->t_image;
        }

        // Update the about entry
        $about->update($validated);

        return redirect()->route('about.index')->with('success', 'About content updated successfully.');
    }

    // Delete about content
    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();
        return redirect()->route('about.index')->with('success', 'About content deleted successfully.');
    }
}
