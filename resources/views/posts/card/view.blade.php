{{-- posts.card.view --}}

<div class="post pcard">     
  <div class="content-post">
  	<div style="float:right;">
  		@include('posts.card.header')
  	</div>
  	<div style="float:left;">
      @if ($post->iframe)
        @include('posts.card.iframe')
      @elseif ($post->isPhotoGallery() || $post->isOffer())
        @if ($post->photos->count() >= 1)
          @include('posts.card.photo')
        @else
          @include('posts.card.photo_empty')
        @endif
      @elseif ($post->photos->count() >= 1)
        @include('posts.card.photo')
      @endif
    </div> 
    <div style="clear:both;"></div>        
    <div>
    	@include('posts.card.content')
    </div>	
    <div>
      @include('posts.card.date')
      @include('posts.card.footer')
    </div>  
  </div>
</div>