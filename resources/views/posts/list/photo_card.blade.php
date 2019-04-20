{{-- posts.list.photo_card --}}

<div style="width:98px; height:98px; background-color:{{ $zcolor }}">
	<img src="{{ url('storage/'.$post->photos->first()->url) }}" 
			alt="{{ $post->title }}" class="img-responsive-card" 
			width="98">
</div>