<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
   public function index()
    {
        $socials = SocialMedia::all(); // Optional: pass data to view
        return view('admin.pages.socialmedia.index', compact('socials'));
    }

    public function store(Request $request)
    {
        $social = new SocialMedia();
        $social->facebook = $request->facebook;
        $social->instagram = $request->instagram;
        $social->tiktok = $request->tiktok;
        $social->whatsapp = $request->whatsapp;
        $social->save();

        return redirect()->back()->with([
            'message' => 'Social media link added successfully!',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $social = SocialMedia::findOrFail($id); // you were missing this line

        $social->facebook = $request->facebook;
        $social->instagram = $request->instagram;
        $social->tiktok = $request->tiktok;
        $social->whatsapp = $request->whatsapp;
        $social->save();
        return redirect()->back()->with([
            'message' => 'Social media link updated successfully!',
            'type' => 'success'
        ]);
        return redirect()->back()->with('success', 'Social media links updated successfully.');
    }

    public function destroy($id)
    {
        $social = SocialMedia::find($id);

        if ($social) {
            $social->delete();
        }

        return redirect()->back()->with([
            'message' => 'Social media link deleted successfully!',
            'type' => 'danger'
        ]);
        // return redirect()->back()->with('success', 'Social media link deleted successfully.');
    }
}
