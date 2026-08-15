<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show customer profile
     */
    public function index()
    {
        $user = Auth::user();

        return view('web.pages.profile', compact('user'));
    }
}
