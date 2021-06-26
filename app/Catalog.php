<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

  public function scopePublished($query)
    {
        $current = Carbon::now('UTC');
        $query->where(function ($query) {
            $query->where('posts.user_id','=',auth()->id());
        })->orWhere(function ($query) use ($current) {
            $query->where('posts.user_id','<>',auth()->id())
                ->where('cstr_privacy','=',1)
                ->whereNotNull('published_at')
                ->where('published_at','<=',$current);
        }); 
    }

    public function scopeHide($query)
    {
        $query->where(function ($query) {
            $query->where('posts.user_id','=',auth()->id());
        })->orWhere(function ($query) {  
            $query->where('posts.user_id','<>',auth()->id())      
                ->where('kposts.hide','=',0);
        });
    }

    public function scopeTitle($query, $title)
    {
        if (trim($title) != "")
        {
            $query->where('posts.title','like','%'.$title.'%');
        }
    }
}


