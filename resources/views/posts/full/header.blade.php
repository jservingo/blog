<header class="xcontainer-flex xspace-between">
	<div class="date truncate" data-height="51" style="width:20px; padding:10px 5px 2px 10px; background-color:{{ $zcolor }}">
	  @if ($post->featured)
	    <div style="position:absolute; top:-3px; left:-10px;">
	      <img src="/img/featured.png" width="20" />
	    </div> 
    @endif
	  <div> 
	    <div class="popr box_popup" style="position:absolute; top:10px; right:5px;"
	        data-id="{{ $post->id }}">
	      <img src="/img/options.png" width="20" />
	    </div> 
	  </div> 
  </div>
  @include('posts.box.type')
</header>