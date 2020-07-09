{{-- posts.exp.content --}} 

@php
  $height = 122;

  if ($post->isPhotoGallery() || $post->isFrame() || $post->isOffer())
  {
    $height = 53;
  }
@endphp

<div class="truncate" data-height="{{ $height }}" style="width:440px; background-color:#fefdfd; padding:10px 10px 4px 10px; text-align:justify;">
  <a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
      class="t-excerpt c-negro" 
      data-id="{{ $post->id }}">
    @if ($post->isOffer() && $post->user_id <> auth()->id())
      <span style="background-color:#F0E68C;padding:4px;">{{ __('messages.promoted-post') }}</span>
      <span style="background-color:#DC143C;color:#ffffff;padding:4px;">{{ __('messages.until') }} {{ $post->valid_until }}</span>
    @endif
    @if ($post->Kpost && $post->kpost->excerpt)
      {{ $post->kpost->excerpt }}
    @else
      {{ $post->excerpt }}
    @endif      
  </a>
</div>
