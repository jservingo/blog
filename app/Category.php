<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name','page_id'];

  public function page()
  {
  	return $this->belongsTo(Page::class);
  }

  public function catalogs()
  {
  	return $this->belongsToMany(Catalog::class);
  }

  public function children() {
    return $this->hasMany(Category::class, 'parent_id', 'id');
	}

  public function parent() {
    return $this->belongsTo(Category::class, 'parent_id', 'id');
	}
}
