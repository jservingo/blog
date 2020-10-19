<div id="content-post" style="width:100%;"> 
  @if ($post->iframe)
    @include('posts.single.iframe')
  @elseif ($post->photos->count() === 1)
    @include('posts.single.photo')
  @elseif ($post->photos->count() > 1)
    @include('posts.box.carousel')       
  @endif   
</div>
