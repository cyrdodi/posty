<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function store(Post $post, Request $request)
  {
    if ($post->likedBy($request->user())) {
      return response(null, 409);
    }

    $post->likes()->create([
      'user_id' => $request->user()->id
    ]);

    /*
      hitung berapa likes yang sudah di delete dengan user_id == user id yang sedang ngelike,
      jika ada jangan kirim email, jika tidak ada maka kirimkan email
     */
    if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
      /* 
        we called Mail class in here after create record in database.
        to($param) is email that sends to,
        PostLiked($param1, $param2) ,
        parameter will be used in app/Mail/PostLiked.php/__construct().
      */
      Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
    }

    return back();
  }

  public function destroy(Post $post, Request $request)
  {
    $request->user()->likes()->where('post_id', $post->id)->delete();

    return back();
  }
}
