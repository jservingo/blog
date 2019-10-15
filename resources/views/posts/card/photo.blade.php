{{-- posts.card.photo --}}

@php
	$src = $post->photos->first()->url; 
	if (substr($src,0,4) != "http")
	{
		$src = Storage::url($post->photos->first()->url);
	}
@endphp

<div style="height:66px; background-color:#d7e9f3">
	<img src="{{ $src }}" 
			alt="{{ $post->title }}" class="img-responsive icard" 
			width="66">
</div>