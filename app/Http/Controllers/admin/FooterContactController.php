<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FooterContact;
use Illuminate\Http\Request;

class FooterContactController extends Controller
{
    public function index()
    {
        $footerContacts = FooterContact::all();
        return view('admin.pages.footercontact.index', compact('footerContacts'));
    }

    public function create()
    {
        return view('admin.footercontact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'mail' => 'required|email',
        ]);
        FooterContact::create($validated);
        return redirect()->route('footercontact.index')->with('success', 'Contact added successfully!');
    }

    public function edit($id)
    {
        $footerContact = FooterContact::findOrFail($id);
        return view('admin.footercontact.edit', compact('footerContact'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'mail' => 'required|email',
        ]);
        $footerContact = FooterContact::findOrFail($id);
        $footerContact->update($validated);
        return redirect()->route('footercontact.index')->with('success', 'Contact updated successfully!');
    }

    public function destroy($id)
    {
        $footerContact = FooterContact::findOrFail($id);
        $footerContact->delete();
        return redirect()->route('footercontact.index')->with('success', 'Contact deleted successfully!');
    }
}
