<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    $post = Post::paginate(5);
    return view('posts.index', [
      'posts' => $post
    ]);
  }

  public function store(Request $request)
  {
    $request->validate(
      [
        'body' => 'required'
      ]
    );

    $request->user()->posts()->create($request->only('body'));

    return back();
  }
}
