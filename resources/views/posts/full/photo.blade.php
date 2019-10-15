{{-- posts.full.photo --}}

@php
	if ($post->photos->count() >= 1)
	{
	  $src = $post->photos->first()->url; 
		if (substr($src,0,4) != "http")
			$src = Storage::url($post->photos->first()->url);
	}
	else
	  $src = "/img/empty-image.png";
@endphp

<div style="width:345px; height:auto; overflow:auto; background-color:#d7e9f3">
	<img src="{{ $src }}" 
		alt="{{ $post->title }}" class="img-responsive ifull">
</div>