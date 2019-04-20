<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class App extends Model
{
  public function pages()
  {
    return $this->hasMany(Page::class);
  }

  public function subscribers()
  {
  	return $this->belongsToMany(User::class);
  }

  public function owner()
  {
    return $this->belongsTo(User::class,'user_id');
  }

  public function getOwnerPostAttribute()
  {
    $post = Post
        ::where('ref_id','=',$this->user_id)
        ->where('type_id','=',24) 
        ->first();
    return $post;
  }
}
