<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    // Admin panel mein sab contacts dikhana
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.pages.contacts.index', compact('contacts'));
    }

    // Delete karna
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully!');
    }
}
