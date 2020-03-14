{{-- exp.box.header --}}

@php
  if ($post->iframe)
  {
    $width = 215;
    $height = 51; 
  }
  elseif ($post->isPhotoGallery() || $post->isOffer())
  {
    $width = 226;
    $height = 51;
  }
  elseif ($post->photos->count() >= 1)
  {
    $width = 226;
    $height = 51;
  }
  else
  {
    $width = 292;
    $height = 51;
  }
@endphp

@if (!isset($zcolor))
  @php ($zcolor="#d7e9f3")
@endif

<header class="xcontainer-flex xspace-between">
	<div class="date truncate" data-height="{{ $height }}" style="width:{{ $width }}px; padding:10px 5px 5px 10px; background-color:{{ $zcolor }}">
    @if ($post->featured)
      <div style="position:absolute; top:-3px; left:-10px;">
        <img src="/img/featured.png" width="20" style="z-index:10;" />
      </div> 
    @endif
    <a href="{{ route('post.show_post',$post) }}"
				class="text-uppercase c-blue"
	  		data-id="{{ $post->id }}">
	  	<h1 class="t-title" style="margin-top:0;margin-bottom:0px;margin-right:22px;">{{ $post->title }}</h1>  
		</a>		
	  <div> 
	    <div class="popr box_popup" style="position:absolute; top:10px; right:5px;"
	        data-id="{{ $post->id }}">
	      <img src="/img/options.png" width="20" />
	    </div> 
	  </div> 
  </div>
  @include('posts.box.type')
</header>