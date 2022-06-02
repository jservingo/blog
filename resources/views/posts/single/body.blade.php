{{-- Source
  @fmath
  @inc
  @kpub
  @xml
  @json
  @url @api
--}} 

<div style="background-color:#7FB3D5; color:white; padding:10px; margin-top:10px; font-size:18px;">
  @if ($post->source == "@epub")
    <div id="area" data-id="{{ $post->id }}" data-source="{{ url('storage/posts/'.$post->id.'.epub') }}"></div>
  @elseif ($post->source == "@kpub")
    @include('posts.single.kpub')
  @elseif ($post->source == "@inc")
    @php 
      $file = asset("storage/posts/".$post->id.".inc"); 
      echo file_get_contents($file);
    @endphp    
  @else
    @php
      echo $post->body;
    @endphp
  @endif
</div>

<div>
   @if ($post->audios->count() >= 1)
    <h3>{{ __('messages.audios') }}:</h3>
     @include('posts.single.audios')
   @endif
</div>

<div class="image-w-text links">
   @if ($post->links)
    <h3>{{ __('messages.links') }}:</h3>
    {!! $post->links !!}
   @endif
</div>

<div class="image-w-text">
  @if ($post->kpost && $post->kpost->observation)
    <h3>{{ __('messages.observation') }}:</h3>
    {{ $post->kpost->observation }}
  @else
    {{ $post->observation }}
  @endif
</div>

<div class="image-w-text">
  @if ($post->kpost && $post->kpost->footnote)
    <h3>{{ __('messages.footnote') }}:</h3>
    {{ $post->kpost->footnote }}
  @else
    {{ $post->footnote }}
  @endif
</div>

<div class="image-w-text">
  @if ($post->tags->count() >= 1)
    @include('posts.box.tags')
  @endif
</div>

{{-- 
<div class="comments">
  <div class="divider"></div>
  <div id="disqus_thread"></div>
  @include('partials.disqus-scripts')
</div><!-- .comments -->
--}}  