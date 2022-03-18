<?php
//  auto generated from : php artisan make:mail PostLiked --markdown=emails.posts.post_liked  

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostLiked extends Mailable
{
  use Queueable, SerializesModels;
  // make liker/user & post public variable so it can be accessed in views (resources/mails/posts/post_liked.blade.php)
  public $liker;
  public $post;


  // set parameter for user dan post model from controller
  public function __construct(User $liker, Post $post)
  {
    // assign it to public variable
    $this->liker = $liker;
    $this->post = $post;
  }

  public function build()
  {
    return $this->markdown('emails.posts.post_liked') // specivy the markdown file, it's in resources/views 
      ->subject('Someone liked your post'); // modify subject text
  }
}
