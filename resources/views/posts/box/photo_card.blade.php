{{-- posts.box.photo_card --}}

<div style="width:66px; height:66px; background-color:#d7e9f3">
	<img src="{{ url('storage/'.$post->photos->first()->url) }}" 
			alt="{{ $post->title }}" class="img-responsive-card" 
			width="66">
</div>