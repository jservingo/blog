<div id="content-post" style="width:60%;padding-top:20px;"> 
  @if ($post->iframe)
    @include('posts.single.iframe')
  @elseif ($post->photos->count() === 1)
    @include('posts.full.photo')
  @elseif ($post->photos->count() > 1)
    @include('posts.box.carousel')    
  @else
    <div>
      {{ $post->excerpt }}
    </div>    
  @endif   
</div>