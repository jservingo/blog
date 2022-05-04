<div class="image-w-text" style="background-color:#2662DF; color:white; padding:10px; margin-top:10px; border:10px solid #7FB3D5;font-family:cursive; font-size:20px;">
  @if ($post->kpost && $post->kpost->excerpt)
    {{ $post->kpost->excerpt }}
  @else
    {{ $post->excerpt }}
  @endif
</div>

<div class="image-w-text" style="background-color:#7FB3D5; color:white; padding:10px; margin-top:10px; font-size:18px;">
  @php
    if ($post->source == "@kpub")
    {
      echo "<div><div style='float:right;'><button onclick='btn_kpub_prev()'>\<\<</button></div><div style='float:right;'><button onclick='btn_kpub_next()'>\>\></button></div></div>";
      $file = "/prog.txt"; 
      echo file_get_contents($file);     
    }
    elseif($post->source == "@fmath") {
      $body = $post->body;
      //$body = htmlentities($body);
      echo $body;
    } 
    elseif ($post->source == "@inc")
    {
      $file = asset("storage/posts/".$post->id.".inc"); 
      echo file_get_contents($file);     
    }
    elseif ($post->source == "@json")
    {
      
    }
    elseif ($post->source == "@xml")
    {
      
    }
    elseif ($post->source == "@url")
    {
      
    }
    else
    {
      echo $post->body;  
    }
  @endphp
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
    <h3>{{ __('messages.tags') }}:</h3>
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