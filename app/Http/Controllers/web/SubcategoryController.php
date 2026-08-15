<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    // List all subcategories
    public function index()
    {
        // with('category') taake list me category ka naam bhi mil jaye
        $subcategories = Subcategory::with('category')->latest()->get();
        $categories = Category::all(); // index page me create form ho to dropdown
        return view('admin.pages.subcategory.index', compact('subcategories', 'categories'));
    }

    // (Optional) Separate create page
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.subcategory.create', compact('categories'));
    }

    // Store new subcategory
    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'name'         => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:20240',
            'description'  => 'nullable|string',
        ]);

        $slug = $this->uniqueSlug($request->name, $request->category_id);

        $subcategory = new Subcategory();
        $subcategory->category_id  = $request->category_id;
        $subcategory->name         = $request->name;
        $subcategory->slug         = $slug;
        $subcategory->description  = $request->description;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/subcategories'), $imageName);
            $subcategory->image = 'uploads/subcategories/'.$imageName;
        }

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory added successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories  = Category::all();
        return view('admin.pages.subcategory.edit', compact('subcategory', 'categories'));
    }

    // Update subcategory
    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'name'         => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:20240',
            'description'  => 'nullable|string',
        ]);

        $subcategory->category_id = $request->category_id;
        $subcategory->name        = $request->name;
        $subcategory->slug        = $this->uniqueSlug($request->name, $request->category_id, $subcategory->id);
        $subcategory->description = $request->description;

        if ($request->hasFile('image')) {
            if ($subcategory->image && file_exists(public_path($subcategory->image))) {
                @unlink(public_path($subcategory->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/subcategories'), $imageName);
            $subcategory->image = 'uploads/subcategories/'.$imageName;
        }

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory updated successfully!');
    }

    // Delete subcategory
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        if ($subcategory->image && file_exists(public_path($subcategory->image))) {
            @unlink(public_path($subcategory->image));
        }

        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory deleted successfully!');
    }

    // AJAX: get subcategories for a category (for Product form dependent dropdown)
    public function byCategory($categoryId)
    {
        return Subcategory::where('category_id', $categoryId)
            ->orderBy('name')
            ->get(['id','name']);
    }

    // Helper: unique slug under a category (handles duplicates by suffix -2, -3 ...)
    private function uniqueSlug(string $name, int $categoryId, int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;

        $exists = Subcategory::where('category_id', $categoryId)
            ->when($ignoreId, fn($q) => $q->where('id','!=',$ignoreId))
            ->where('slug', $slug)
            ->exists();

        while ($exists) {
            $slug = $base.'-'.$i;
            $i++;
            $exists = Subcategory::where('category_id', $categoryId)
                ->when($ignoreId, fn($q) => $q->where('id','!=',$ignoreId))
                ->where('slug', $slug)
                ->exists();
        }

        return $slug;
    }
}
