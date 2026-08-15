<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'comment' => 'required|string'
    ]);

    Comment::create([
        'blog_id' => $id,
        'name' => $request->name,
        'email' => $request->email,
        'comment' => $request->comment
    ]);

    return redirect()->back()->with('success', 'Comment posted successfully!');
    }
}
