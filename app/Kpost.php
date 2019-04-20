<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kpost extends Model
{
	protected $fillable = ['post_id','status_id','user_id','sent_by','sent_at'];

  public function post()
  {
  	return $this->belongsTo(Post::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class,'user_id');
  }
}
