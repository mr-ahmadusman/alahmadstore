<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\FooterContact;
use App\Models\Logo;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Contact page dikhana (frontend)
    public function show()
    {
        $logo = Logo::first();
        $social = SocialMedia::first();
        $footerContact = FooterContact::first();
        $categories = Category::with('subcategories.products.images')->get();
        $cartItems = session()->get('cart', []);

        return view('web.pages.contact', compact('logo', 'social', 'footerContact', 'categories', 'cartItems'));
    }

    // Form submit hone par save karna
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'email', 'phone', 'message'));

        return redirect()->back()->with('success', 'Your message has been received! We will get back to you shortly.');
    }
}
