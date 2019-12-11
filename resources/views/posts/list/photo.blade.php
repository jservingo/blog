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

<div style="width:174px; height:102px; background-color:{{ $zcolor }}">
	<img src="{{ $src }}" 
			alt="{{ $post->title }}" class="img-responsive ilist" 
			width="188">
</div>