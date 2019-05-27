{{-- posts.full.photo --}}

<div style="width:345px; height:auto; overflow:auto; background-color:#d7e9f3">
	@if ($post->photos->count() >= 1)
		<img src="{{ Storage::url($post->photos->first()->url) }}" 
				alt="{{ $post->title }}" class="img-responsive ifull">
	@else
	  <img src="/img/empty-image.png" 
				alt="{{ $post->title }}" class="img-responsive ifull">
	@endif
</div>