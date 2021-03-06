{{-- exp.box.header --}}

@php
  if ($post->iframe)
  {
    $width = 215;
    $height = 120; 
  }
  elseif ($post->isPhotoGallery() || $post->isOffer())
  {
    $width = 215;
    $height = 120;
  }
  elseif ($post->photos->count() >= 1)
  {
    if ($post->isApp() || $post->isUser())
    {
      $width = 378;
      $height = 51;
    }
    else
    {
      $width = 215;
      $height = 120;
    }
  }
  else
  {
    $width = 445;
    $height = 51;
  }
@endphp

@if (!isset($zcolor))
  @php ($zcolor="#d7e9f3")
@endif

<header class="xcontainer-flex xspace-between">
	<div class="date truncate" data-height="{{ $height }}" style="width:{{ $width }}px; padding:10px 5px 5px 10px; background-color:{{ $zcolor }}">
		@include('posts.box.featured')
    <a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
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