<div class="image-w-text" style="padding-right:20px;">
  <h3>{{ __('messages.excerpt') }}:</h3>
  @if ($post->kpost && $post->kpost->excerpt)
    {{ $post->kpost->excerpt }}
  @else
    {{ $post->excerpt }}
  @endif
</div>

<div class="image-w-text" style="padding-right:20px;">
  <h3>{{ __('messages.content') }}:</h3>
  {!! $post->body !!}
</div>

<div style="padding-right:20px;">
   @if ($post->audios)
    <h3>{{ __('messages.audios') }}:</h3>
     @include('posts.single.audios')
   @endif
</div>

<div class="image-w-text links" style="padding-right:20px;">
   @if ($post->links)
    <h3>{{ __('messages.links') }}:</h3>
    {!! $post->links !!}
   @endif
</div>

<div class="image-w-text" style="padding-right:20px;">
  @if ($post->kpost && $post->kpost->observation)
    <h3>{{ __('messages.observation') }}:</h3>
    {{ $post->kpost->observation }}
  @else
    {{ $post->observation }}
  @endif
</div>

<div class="image-w-text" style="padding-right:20px;">
  @if ($post->kpost && $post->kpost->footnote)
    <h3>{{ __('messages.footnote') }}:</h3>
    {{ $post->kpost->footnote }}
  @else
    {{ $post->footnote }}
  @endif
</div>

<div class="image-w-text" style="padding-right:20px;">
  @if ($post->tags)
    <h3>{{ __('messages.tags') }}:</h3>
    @include('posts.box.tags')
  @endif
</div>

<div class="image-w-text" style="padding-right:20px;">
  <p>id: {{ $post->id}}</p>
</div>


{{-- 
<div class="comments">
  <div class="divider"></div>
  <div id="disqus_thread"></div>
  @include('partials.disqus-scripts')
</div><!-- .comments -->
--}}  