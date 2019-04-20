<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function kposts()
    {
        return $this->hasMany(Kpost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);   
    } 

    public function catalogs()
    {
        return $this->hasMany(Catalog::class);   
    }

    public function pageSubscriptions()
    {
        return $this->belongsToMany(Page::class);
    }

    public function appSubscriptions()
    {
        return $this->belongsToMany(App::class);
    } 
    
    public function groups()
    {
        return $this->hasMany(Group::class);
    }  

    public function getPostAttribute()
    {
        $post = Post
            ::where("type_id","=",24)
            ->where("ref_id","=",$this->id)
            ->first();
        return $post;
    } 
}
