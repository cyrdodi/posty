<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    $post = Post::with(['user', 'likes'])->paginate(20);
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
