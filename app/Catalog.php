<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
  protected $fillable = ['name','published_at','user_id'];

  public function owner()
  {
    return $this->belongsTo(User::class,'user_id');
  }

  public function posts()
  {
  	return $this->belongsToMany(Post::class);
  }

  public function categories()
  {
  	return $this->belongsToMany(Category::class);
  }

  public function getPostAttribute()
  {
    $post = Post
      ::where("type_id","=",21)
      ->where("ref_id","=",$this->id)
      ->first();
    return $post;
  }
}
