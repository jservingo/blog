{{-- posts.full.view --}}

<div class="post pfull">     
  <div class="content-post" style="background-color:{{ $zcolor }}">
    @if ($post->isPhotoGallery() || $post->isFrame() || $post->isOffer())
    <div style="float:right;">
      <div class="header" style="float:right;">
        @include('posts.full.header')
      </div>
      <div style="float:left;">
        @include('posts.full.title')            
      </div>
      <div style="clear:both;"></div>
      <div>
        @include('posts.full.scontent')
      </div>
    </div>
    <div class="media" style="float:left;">
      @if ($post->isFrame())
        @include('posts.full.iframe')
      @else
        @include('posts.full.photo')
      @endif
    </div>
    <div style="clear:both;"></div>      
    @elseif ($post->photos->count() >= 1)
      @if ($post->isApp() || $post->isUser())
      <div>
        <div class="header" style="float:right;">
          @include('posts.full.header')
        </div>
        <div class="media" style="float:left;">
          @include('posts.box.photo_card')
        </div>
        <div style="float:left;">
          @include('posts.full.title')
          <div style="padding:4px 10px 4px 10px; text-align:justify; max-height:320px; overflow:hidden;">
            @include('posts.full.content')
          </div>
        </div>        
        <div style="clear:both;"></div>
      </div>
      @else
      <div style="float:right;">
        <div class="header" style="float:right;">
          @include('posts.full.header')
        </div>
        <div style="float:left;">
          @include('posts.full.title')            
        </div>
        <div style="clear:both;"></div>
        <div>
          @include('posts.full.scontent')
        </div>
      </div>
      <div class="media" style="float:left;">
        @if ($post->isFrame())
          @include('posts.full.iframe')
        @else
          @include('posts.full.photo')
        @endif
      </div>
      <div style="clear:both;"></div>  
      @endif
    @else
    <div>
      <div class="header" style="float:right;">
        @include('posts.full.header')
      </div>
      <div class="media" style="float:left;"></div> 
      <div style="float:left;">
        @include('posts.full.title')  
      </div>
      <div style="clear:both;"></div>
      <div style="padding:4px 10px 0px 10px; text-align:justify; max-height:320px; overflow:hidden;">
        @include('posts.full.content')
        <hr/>
      </div>
    </div>    
    @endif
    <div style="padding:2px 10px 4px 10px; text-align:justify; max-height:320px; overflow:hidden;">
      {!! $post->body !!}
    </div>
    <div style="padding-left:10px;padding-right:10px;">
      @if ($post->audios->count() >= 1)
        <h3>{{ __('messages.audios') }}:</h3>
        @include('posts.single.audios')
      @endif
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
        @include('posts.full.footer') 
      </div>
      <div style="float:left;">               
        @include('posts.full.footnote')
      </div>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>