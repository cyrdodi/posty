<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    return view('posts.index');
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
