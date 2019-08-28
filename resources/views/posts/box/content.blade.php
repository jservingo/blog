{{-- posts.box.content --}} 

@php
  if ($post->isPhotoGallery() || $post->isFrame() || $post->isOffer())
  {
    $show_title = true;
    $show_excerpt = false;
    $width = 210;
    $height = 0;
    $long = 240;
  }
  elseif ($post->isText() || $post->isNotification()) 
  {
    $show_title = false;
    $show_excerpt = true;
    $width = 210;
    $height = 130;
    $long = 240;
  }
  elseif ($post->isApp() || $post->isUser())
  {
    if ($post->photos->count() >= 1)
    {
      $show_title = false;
      $show_excerpt = true;
      $width = 210;
      $height = 62;
      $long = 130;
    }
    else
    {
      $show_title = true;
      $show_excerpt = true;
      $width = 210;
      $height = 130;
      $long = 240;
    }
  }
  else
  {
    $show_title = true;
    $show_excerpt = true;
    $width = 210;
    $height = 130;
    $long = 200;
  }
@endphp

<div class="truncate" data-height="{{ $height }}" style="width:{{ $width }}px; background-color:#fefdfd; padding:10px 10px 2px 10px; text-align:justify;">
  @if ($show_excerpt)
  <a href="{{ route('post.show_post',$post) }}"
      class="t-excerpt c-negro" 
      data-id="{{ $post->id }}">
    @if ($post->Kpost && $post->kpost->excerpt)
      {{ $post->kpost->excerpt }}
    @else
      {{ $post->excerpt }}
    @endif 
  </a>
  @endif
</div>
