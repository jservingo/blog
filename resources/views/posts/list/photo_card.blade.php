{{-- posts.list.photo_card --}}

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

<div style="width:98px; height:98px; background-color:{{ $zcolor }}">
	<img src="{{ $src }}" 
			alt="{{ $post->title }}" class="img-responsive-card" 
			width="98">
</div>