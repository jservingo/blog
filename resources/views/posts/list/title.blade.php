@php
  if ($post->isPhotoGallery() || $post->isFrame() || $post->isOffer())
  {
    $width = 324;
    $height = 178;
  }
  elseif ($post->photos->count() >= 1)
  {
    if ($post->isApp() || $post->isUser())
    {
      $width = 593;
      $height = 178;
    }
    else
    {
      $width = 670;
      $height = 178;
    }
  }
  else
  {
    $width = 670;
    $height = 178;
  }
@endphp

<div class="content" style="width:{{ $width }}px; background-color:{{ $zcolor }}; padding:8px 10px 0px 10px;">      
  <a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
      class="text-uppercase c-blue" 
      data-id="{{ $post->id }}">
    <h1 class="t-title" style="margin-top:0;margin-bottom:6px">{{ $post->title }}</h1>  
  </a>
</div>
<div style="background-color:#fefdfd; padding:0px 10px 4px 10px;">
    <span class="user c-blue">
      <a href="{{ route('post.show',[$post->owner_post,\Illuminate\Support\Str::slug($post->owner->name)]) }}">
        {{ $post->owner->name }}
      </a>
      @if ($post->owner->id != auth()->id()) 
        <a class="btn_add_user_to_contacts" 
            data-id="{{ $post->owner->id }}">
          <img src="/img/add_user.png" width="14" />
        </a>
      @endif 
      {{-- 
      @if ($post->kpost)
        <a href="{{ route('post.show',$post->sender_post) }}">
          {{ $post->sender->name }}
        </a>
      @endif
      --}}
      &nbsp;&nbsp;
    </span>
    <span class="c-gray-1" style="">
      {{ $post->published_at->format('d/m/y')}}
    </span>
</div>
