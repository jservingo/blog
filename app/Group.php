<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  public function contacts()
  {
  	return $this->belongsToMany(User::class);
  }

  public function owner()
  {
    return $this->belongsTo(User::class,'user_id');
  }

  public function children() {
    return $this->hasMany(Group::class, 'parent_id', 'id');
	}

  public function parent() {
    return $this->belongsTo(Group::class, 'parent_id', 'id');
	}  
}
