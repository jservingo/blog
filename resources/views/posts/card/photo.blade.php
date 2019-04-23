{{-- posts.card.photo --}}

<div style="height:66px; background-color:#d7e9f3">
	<img src="{{ Storage::url($post->photos->first()->url) }}" 
			alt="{{ $post->title }}" class="img-responsive icard" 
			width="66">
</div>