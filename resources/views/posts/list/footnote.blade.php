@php 
  if ($post->isPhotoGallery() || $post->isFrame() || $post->isOffer())
 	{
		$width = 494;
	}
	elseif (($post->isApp() || $post->isUser()) && $post->photos->count() >= 1)
	{
		$width = 572;
	}
	else
	{
		$width = 670;
	}
@endphp

<div class="truncate footnote" data-height="24" data-adjust="false" 
		style="width:{{ $width }}px; color:#0a1fa7; font-weight:800; background-color:{{ $zcolor }}; padding:6px 10px;">     
	<div class="t-footnote">
		@if($post->kpost && $post->kpost->footnote)
			{{ $post->kpost->footnote }}
		@else
		  {{ $post->footnote }}
	  @endif
	</div>
</div>