{{-- posts.full.photo --}}

@php
	if ($post->photos->count() >= 1)
	{
	  $src = $post->photos->first()->url; 
		if (substr($src,0,4) != "http" && substr($src,0,4) != "/img")
			$src = Storage::url($post->photos->first()->url);
	}
	else
	  $src = "/img/empty-image.png";
@endphp

<div style="width:550px; height:auto; margin-top:20px; overflow:auto; background-color:#d7e9f3">
	<img src="{{ $src }}" width="550px" 
		alt="{{ $post->title }}" class="">
</div>