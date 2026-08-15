<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.category.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('admin.pages.category.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20240',
            'description' => 'nullable|string',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name); // slug generate
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $category->image = 'uploads/categories/' . $imageName;
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
// ...existing code...
    }

    // Show edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.category.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20240',
            'description' => 'nullable|string',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $category->image = 'uploads/categories/' . $imageName;
        }

        $category->save();

return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
