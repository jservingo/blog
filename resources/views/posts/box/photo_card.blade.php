{{-- posts.box.photo_card --}}

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

<div style="width:66px; height:66px; background-color:#d7e9f3">
	<img src="{{ $src }}" 
			alt="{{ $post->title }}" class="img-responsive-card" 
			width="66">
</div>