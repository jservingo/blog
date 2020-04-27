<div class="truncate" data-height="24" style="width:210px; background-color:#d7e9f3;padding:6px 10px;">
	<div class="t-footnote" style="color:#0a1fa7;font-weight:800;">
		@if($post->kpost && $post->kpost->footnote)
			{{ $post->kpost->footnote }}
		@else
		  {{ $post->footnote }}
	  @endif
	</div>
</div>