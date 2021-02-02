{{-- posts.list.view --}}

<div class="post plist">     
  <div class="content-post" style="background-color:{{ $zcolor }}">
    <div>
      <div class="header" style="float:right;">
        @include('posts.list.header')
      </div>
      <div class="media" style="float:left;">
        @if ($post->iframe)
          @include('posts.list.iframe')
        @elseif ($post->isPhotoGallery() || $post->isOffer())
          @if ($post->photos->count() >= 1)
            @include('posts.list.photo')
          @else
            @include('posts.list.photo_empty')     
          @endif
        @elseif ($post->photos->count() >= 1)
          @if ($post->isApp() || $post->isUser())
            @include('posts.box.photo_card')
          @else  
            @include('posts.list.photo')
          @endif
        @endif
      </div>
      <div style="float:left; background-color:lightgray">
        @include('posts.list.content')
      </div>
      <div style="clear:both;"></div>
    </div>
    <div>
      <div style="float:right;">
        @include('posts.full.date') 
      </div>
      <div style="float:left;">               
        @include('posts.full.tags')
      </div>
      <div style="clear:both;"></div>
    </div>
    <div>
      <div style="float:right;">
        @include('posts.list.footer') 
      </div>
      <div style="float:left;">               
        @include('posts.list.footnote')
      </div>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>