@php
	$width = 210;
  $height = 46; 
	if ($post->isApp() || $post->isUser())
  {
    if ($post->photos->count() >= 1)
    {
      $width = 133;
    }
  }
  elseif ($post->isPhotoGallery() || $post->isFrame() || $post->isOffer())
  {
    $height = 49;  
  }
@endphp


<div class="truncate" data-height="{{ $height }}" style="width:{{ $width }}px; background-color:#d7e9f3; padding:10px 10px;">
	<a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
			class="text-uppercase c-blue"
  		data-id="{{ $post->id }}">
		<h1 class="t-title" style="margin-top:0;margin-bottom:0px">{{ $post->title }}</h1>  
	</a>
</div>
