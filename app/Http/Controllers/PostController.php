<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function __construct()
  {
    // set auth only to store and delete method
    $this->middleware(['auth'])->only(['store', 'delete']);
  }
  public function index()
  {
    $post = Post::latest()->with(['user', 'likes'])->paginate(20);
    return view('posts.index', [
      'posts' => $post
    ]);
  }

  public function show(Post $post)
  {
    return view('posts.show', [
      'post' => $post
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

  public function destroy(Post $post)
  {
    // authorize who can delete post,first paramereter is method's name, second is Model 
    $this->authorize('delete', $post);
    $post->delete();

    return back();
  }
}
