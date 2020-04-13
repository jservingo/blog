<div id="content-post" style="width:95%;"> 
  @if ($post->iframe)
    @include('posts.single.iframe')
  @elseif ($post->photos->count() === 1)
    @include('posts.single.photo')
  @elseif ($post->photos->count() > 1)
    @include('posts.box.carousel')       
  @endif   
</div>
