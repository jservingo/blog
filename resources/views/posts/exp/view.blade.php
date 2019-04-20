{{-- posts.exp.view --}}

<div class="post pexp">     
  <div class="content-post">
    @if ($post->iframe)  
    	<div style="float:right;">
    		@include('posts.exp.header')  
    	</div>
      <div style="float:left;">
        @include('posts.box.iframe')
      </div>
      <div style="clear:both;"></div>
    @elseif ($post->photos->count() >= 1)
      @if ($post->isApp() || $post->isUser())
        <div style="float:right">
          @include('posts.exp.header')
        </div>
        <div style="float:left">
          @include('posts.box.photo_card')
        </div>
        <div style="clear:both;"></div>
      @else
        <div style="float:right;">
          @include('posts.exp.header')  
        </div>
        <div style="float:left;">
          @include('posts.box.photo')
        </div>
        <div style="clear:both;"></div>
      @endif
    @else
      <div>
        @include('posts.exp.header')
      </div>
    @endif  
    @include('posts.exp.content')
    @include('posts.exp.date')
    <div style="float:right">
      @include('posts.box.footer')
    </div>  
    <div style="float:left;">
        @include('posts.box.footnote')
    </div>
    <div style="clear:both;"></div>          
  </div>
</div>
