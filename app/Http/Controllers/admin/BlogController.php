<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // Display all blogs in admin panel
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.pages.blog.index', compact('blogs'));
    }

    // Show form to create a new blog
    public function create()
    {
        return view('admin.pages.blog.create');
    }

    // Store a newly created blog in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->date = $request->date;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/blogs'), $imageName);
            $blog->image = 'uploads/blogs/' . $imageName;
        }

        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Blog added successfully!');
    }

    // Show the form for editing the specified blog
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.pages.blog.edit', compact('blog'));
    }

    // Update the specified blog in storage
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->date = $request->date;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/blogs'), $imageName);
            $blog->image = 'uploads/blogs/' . $imageName;
        }

        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    // Remove the specified blog from storage
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }

    // Show blog detail by slug (frontend view)
    // public function showFrontend($slug)
    // {
    //     $blog = Blog::where('slug', $slug)->firstOrFail();
    //     return view('web.blog.index', compact('blog'));
    // }
}
