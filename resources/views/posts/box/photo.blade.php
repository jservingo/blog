{{-- posts.box_photo --}}

<div style="width:230px; height:135px; background-color:#d7e9f3">
	<img src="{{ Storage::url($post->photos->first()->url) }}" 
			alt="{{ $post->title }}" class="img-responsive ibox" 
			width="230">
</div>