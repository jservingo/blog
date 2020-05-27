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
    @if ($post->Kpost && $post->kpost->excerpt)
      {{ $post->kpost->excerpt }}
    @else
      {{ $post->excerpt }}
    @endif      
  </a>
</div>
