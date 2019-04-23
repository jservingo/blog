{{-- posts.full.photo --}}

<div style="width:345px; height:auto; overflow:auto; background-color:#d7e9f3">
	<img src="{{ Storage::url($post->photos->first()->url) }}" 
			alt="{{ $post->title }}" class="img-responsive ifull">
</div>