<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App as Kapp;
use App\Catalog;
use App\Contact;
use App\Page;
use App\User;
use App\App;

class Post extends Model
{
    protected $fillable = ['title','body','iframe','excerpt','footnote','links','published_at','type_id','ref_id','user_id','app_id','source','custom_type'];

    protected $dates = ['published_at'];

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }

    public function kposts()
    {
        return $this->hasMany(Kpost::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function audios()
    {
        return $this->hasMany(Audio::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sent_by()
    {
        // NO SE UTILIZA. $post->sent_by()
        // UTILIZAR $post->kpost->sent_by
        $kpost = Kpost
            ::where('user_id','=',auth()->id())  
            ->where('post_id','=',$this->id)
            ->first();
        if ($kpost)
            return $kpost->sent_by;
        return null; 
    }

    public function isContact()
    {
        $user_ref = $this->user_id;
        $contact = Contact
            ::where('user_id','=',auth()->id())
            ->where('user_ref','=',$user_ref)
            ->first();
        if ($contact)
            return true;
        return false;
    }

    public function strTags()
    {
        $str = "";
        foreach ($this->tags as $tag)
        {
            if ($str=="")
                $str = $tag->name;
            else
                $str = $str.",".$tag->name;
        }
        return $str;
    }

    public function scopePublishedOffer($query)
    {
        $current = new Carbon();
        $fromDate = $current->format('Y-m-d H:i:s');
        $toDate = $current->addDays(30)->format('Y-m-d H:i:s');

        $query->where('cstr_privacy','=',1)
            ->whereNotNull('posts.published_at')
            ->where($fromDate,'>=','posts.published_at')
            ->where('posts.published_at','<=',$toDate);
            //->whereBetween('posts.published_at', array($fromDate, $toDate));
    }

    public function scopePublished($query)
    {
        //$now = date("Y-m-d");
        $now = getUTCDate();
        $query->where(function ($query) {
            $query->where('posts.user_id','=',auth()->id());
        })->orWhere(function ($query) use ($now) {
            $query->where('posts.user_id','<>',auth()->id())
                ->where('posts.cstr_privacy','=',1)
                ->whereNotNull('posts.published_at')
                ->where('posts.published_at','<=',$now);
        }); 
    }

    public function scopeHide($query)
    {
        $query->where('kposts.hide','=',0);
    }

    public function scopeTitle($query, $title)
    {
        if (trim($title) != "")
        {
            $query->where('title','like','%'.$title.'%');
        }
    }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = Carbon::parse($published_at);
    }

    public function getKpostAttribute()
    {
        $kpost = Kpost
            ::where('user_id','=',auth()->id()) 
            ->where('post_id','=',$this->id)
            ->first();
        return $kpost;
    }

    public function getFirstAudioAttribute()
    {
        $audio = Audio
            ::where('post_id','=',$this->id)
            ->first();

        if ($audio)
            $url = url('storage/'.$audio->url);
        else
            $url = "";

        return $url;
    }

    public function getCatalogAttribute()
    {
        $catalog = Catalog
            ::where('id','=',$this->ref_id)
            ->first();
        return $catalog;
    }

    public function getPageAttribute()
    {
        $page = Page
            ::where('id','=',$this->ref_id)
            ->first();
        return $page;
    }

    public function getAppAttribute()
    {
        $app = App
            ::where('id','=',$this->ref_id)
            ->first();
        return $app;
    }

    public function getUserAttribute()
    {
        $user = User
            ::where('id','=',$this->ref_id)
            ->first();
        return $user;
    }

    public function getSenderAttribute()
    {
        $user = User
            ::where('id','=',$this->kpost->sent_by) 
            ->first();
        return $user;
    }

    public function getOwnerPostAttribute()
    {
        $post = Post
            ::where('ref_id','=',$this->user_id)
            ->where('type_id','=',24) 
            ->first();
        return $post;
    }

    public function getSenderPostAttribute()
    {
        $post = Post
            ::where('ref_id','=',$this->kpost->sent_by)
            ->where('type_id','=',24) 
            ->first();
        return $post;
    }    

    public function getStatusAttribute()
    {
        $status_id = $this->kpost->status_id;
        if ($status_id == 0)
            return "Sent";
        if ($status_id == 1)
            return "Discarded";
        if ($status_id == 2)
            return "Saved";
        /* UTILIZAR: $post->kpost->status_id
        $kpost = Kpost
            ::where('user_id','=',auth()->id()) 
            ->where('post_id','=',$this->id)
            ->first();
        return (! is_null($kpost) ? $kpost->status_id : null);
        */
    }

    public function getPublishedDateAttribute()
    {
        if (Kapp::isLocale('en')) 
            return $this->published_at->format('m/d/y');
        else if (Kapp::isLocale('es')) 
            return $this->published_at->format('d/m/y');
        return $this->published_at->format('m/d/y');
    }

    public function getCreatedDateAttribute()
    {
        if (Kapp::isLocale('en')) 
            return $this->created_at->format('m/d/y');
        else if (Kapp::isLocale('es')) 
            return $this->created_at->format('d/m/y');
        return $this->created_at->format('m/d/y');
    }

    public function getValidUntilAttribute()
    {
        $valid_until = $this->published_at->addDays(7);
        if (Kapp::isLocale('en')) 
            return $valid_until->format('m/d/y');
        else if (Kapp::isLocale('es')) 
            return $valid_until->format('d/m/y');
        return $valid_until->format('m/d/y');
    }

    public function getUserLikesAttribute()
    {
        if($this->kpost)
            return $this->kpost->likes;
        return 0;
    }

    public function viewType($view='')
    {
        /*
        if ($this->isCatalog)
            return 'posts.catalog';
        if ($this->isPage)
            return 'posts.page';
        if ($this->isApp)
            return 'posts.app';
        if ($this->isUser)
            return 'posts.user';
        if ($this->isCompany)
            return 'posts.company';
        if ($this->isOffer)
            return 'posts.offer';         
        */
        if ($this->iframe)
            return 'posts.box.iframe';

        if ($this->photos->count() === 1)
            return 'posts.box.photo';

        if ($this->photos->count() > 1)
        {
            if ($view==='home')
                return 'posts.box.carousel-preview'; 
            return 'posts.box.carousel';
        }

        return 'posts.box.undefined';        
    }

    function get_type()
    {
        switch($this->type_id)
        {
          case 1:
            return __('messages.type-photo-gallery');
          case 2:
            return __('messages.type-frame');
          case 3:
            return __('messages.type-text');
          case 4:
            return __('messages.type-notification');
          case 5:
            return __('messages.type-web-page');
          case 6:
            return __('messages.type-alert');
          case 7:
            return __('messages.type-offer');
          case 8:
            return $this->custom_type;
          case 9: 
            return __('messages.type-message');
          case 21:
            return __('messages.type-catalog');
          case 22:
            return __('messages.type-page');
          case 23:
            return __('messages.type-app');
          case 24:
            return __('messages.type-user');    
        }
    }

    public function isPublished()
    {
        return(bool) ! is_null($this->publishedAt) && $this->publishedAt < today();
    }

    public function isPhotoGallery()
    {
        return $this->type_id===1 ? true : false;
    }

    public function isFrame()
    {
        return $this->type_id===2 ? true : false;
    }

    public function isText()
    {
        return $this->type_id===3 ? true : false;
    }

    public function isNotification()
    {
        return $this->type_id===4 ? true : false;
    }

    public function isWebPage()
    {
        return $this->type_id===5 ? true : false;
    }

    public function isAlert()
    {
        return $this->type_id===6 ? true : false;
    }  

    public function isOffer()
    {
        return $this->type_id===7 ? true : false;
    }  

    public function isCustom()
    {
        return $this->type_id===8 ? true : false;
    } 

    public function isMessage()
    {
        return $this->type_id===9 ? true : false;
    }

    public function isCatalog()
    {
        return $this->type_id===21 ? true : false;
    }

    public function isPage()
    {
        return $this->type_id===22 ? true : false;
    }

    public function isApp()
    {
        return $this->type_id===23 ? true : false;
    }

    public function isUser()
    {
        return $this->type_id===24 ? true : false;
    }

    public function isCompany()
    {
        return $this->type_id===25 ? true : false;
    }  
}
