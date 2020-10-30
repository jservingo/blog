{{-- posts.list.photo --}}

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

<div class="image-full" style="height:auto; overflow:auto; background-color:{{ $zcolor }}">
	<img src="{{ $src }}" 
		alt="{{ $post->title }}" class="img-responsive ifull">
</div>