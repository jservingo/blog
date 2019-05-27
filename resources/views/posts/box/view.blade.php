{{-- posts.box.view --}}

<div class="post pbox">     
  <div class="content-post">
    @include('posts.box.header')
    
    @if ($post->iframe)
      @include('posts.box.iframe')
      @include('posts.box.empty')
      @include('posts.box.date')
      @include('posts.box.footer')
    @elseif ($post->isPhotoGallery())
      @if ($post->photos->count() >= 1)
        @include('posts.box.photo')
        @include('posts.box.empty')
        @include('posts.box.date')
        @include('posts.box.footer')
      @else
        @include('posts.box.photo_empty')
        @include('posts.box.empty')
        @include('posts.box.date')
        @include('posts.box.footer')     
      @endif
    @elseif ($post->photos->count() >= 1)
      @if ($post->isApp() || $post->isUser())
        <div>
          <div style="float:right">
            @include('posts.box.title')
          </div>
          <div style="float:left">
            @include('posts.box.photo_card')
          </div>
          <div style="clear:both;"></div>
        </div>
        @include('posts.box.content')
        @include('posts.box.date')
        @include('posts.box.footer')
      @else  
        @include('posts.box.photo')
        @include('posts.box.empty')
        @include('posts.box.date')
        @include('posts.box.footer')
      @endif
    @else
      @include('posts.box.content')
      @include('posts.box.date')
      @include('posts.box.footer')
    @endif
  </div>
</div>