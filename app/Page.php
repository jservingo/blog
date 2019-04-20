<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $fillable = ['name','published_at','user_id'];
    
  public function categories()
  {
  	return $this->hasMany(Category::class);
  }

  public function subscribers()
  {
  	return $this->belongsToMany(User::class);
  }

  public function owner()
  {
    return $this->belongsTo(User::class,'user_id');
  }

  public function getPostAttribute()
  {
    $post = Post
      ::where("type_id","=",22)
      ->where("ref_id","=",$this->id)
      ->first();
    return $post;
  }
}
