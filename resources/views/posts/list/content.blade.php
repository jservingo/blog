@php
  if ($post->isPhotoGallery() || $post->isFrame() || $post->isOffer())
  {
    $width = 496;
    $height = 110;
  }
  elseif ($post->photos->count() >= 1)
  {
    if ($post->isApp() || $post->isUser())
    {
      $width = 572;
      $height = 110;
    }
    else
    {
      $width = 670;
      $height = 110;
    }
  }
  else
  {
    $width = 670;
    $height = 110;
  }
@endphp

<!-- height:{{ $height }}px; -->
<div class="truncate content" data-height="{{ $height }}" data-adjust="false"
      style="width:{{ $width }}px; background-color:{{ $zcolor }}; padding:8px 10px;">
  <a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
      class="text-uppercase c-blue" 
      data-id="{{ $post->id }}">
    <h1 class="t-title" style="margin-top:0;margin-bottom:6px">{{ $post->title }}</h1>  
  </a>
  <div style="text-align:justify;">
  <a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
      class="t-excerpt c-negro" 
      data-id="{{ $post->id }}">
    @if ($post->isOffer() && $post->user_id <> auth()->id())
      <a class="button yellow">{{ __('messages.promoted-post') }}</a>
      <a class="button red">{{ __('messages.until') }} {{ $post->valid_until }}</a>
    @endif
    @if ($post->Kpost && $post->kpost->excerpt)
      {{ $post->kpost->excerpt }}
    @else
      {{ $post->excerpt }}
    @endif 
  </a>
  </div>
</div>

