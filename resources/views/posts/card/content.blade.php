@php
  if ($post->isText() || $post->isNotification())
  {
    $show_title = false;
  }
  else
  {
    $show_title = true;
  }
@endphp

<div class="truncate" data-height="128" style="width:287px; background-color:#fefdfd; padding:10px 10px 4px; 10px; text-align:justify;">
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