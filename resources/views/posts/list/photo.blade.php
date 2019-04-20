{{-- posts.list.photo --}}

<div style="width:174px; height:102px; background-color:{{ $zcolor }}">
	<img src="{{ url('storage/'.$post->photos->first()->url) }}" 
			alt="{{ $post->title }}" class="img-responsive ilist" 
			width="188">
</div>