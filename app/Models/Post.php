<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'body'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function likes()
  {
    return $this->hasMany(Like::class);
  }

  public function likedBy(User $user)
  {
    // jika dalam postingan yang di likes ini ada user_id tersebut maka mengembalikan nilai true 
    return $this->likes->contains('user_id', $user->id);
  }

  public function ownedBy(User $user)
  {
    return $user->id === $this->user_id;
  }
}
