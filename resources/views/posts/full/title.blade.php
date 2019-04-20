@php
  if ($post->isPhotoGallery() || $post->isFrame())
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
  <a href="{{ route('post.show_post',$post) }}"
      class="text-uppercase c-blue" 
      data-id="{{ $post->id }}">
    <h1 class="t-title" style="margin-top:0;margin-bottom:6px">{{ $post->title }}</h1>  
  </a>
</div>