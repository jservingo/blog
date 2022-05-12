@if (($post->iframe || $post->photos->count() === 1 || $post->photos->count() > 1) && ($post->source != "@kpub"))
  <div id="content-post" style="background-color:#7FB3D5; padding:10px; margin-top:10px;"> 
    @if ($post->iframe)
      @include('posts.single.iframe')
    @elseif ($post->photos->count() === 1)
      @if ($post->source != "@kpub")
        @include('posts.single.photo')
      @endif
    @elseif ($post->photos->count() > 1)
      @include('posts.box.carousel')       
    @endif   
  </div>
@endif
