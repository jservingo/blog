{{-- posts.full.audios --}}

<div class="audios xcontainer-flex">
	<div id="audioWrap{{ $post->id }}" style="background:#333"></div>
	<div>
		@foreach ($post->audios->sortBy('featured')->sortBy('position') as $audio)
			<div style="background: #f4f4f4;">
				<span style="color:#155597;font-weight:700;">{{ $audio->description }}</span>		
				<audio preload="auto" src="{{ url('storage/'.$audio->url) }}"></audio>
			</div>
		@endforeach
	</div>
</div>