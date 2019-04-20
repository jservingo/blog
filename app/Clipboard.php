<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clipboard extends Model
{
    protected $fillable = ['user_id','post_id'];
}
