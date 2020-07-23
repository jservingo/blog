{{-- posts.full.audios --}}

<div class="audios xcontainer-flex">
	<div id="audioWrap{{ $post->id }}" style="background:#333"></div>
	<div>
		<ul>
			@foreach ($post->audios->sortBy('featured')->sortBy('position') as $audio)
				<li>
					<a class="btn_play_audio" 
							data-url="{{ url('storage/'.$audio->url) }}"
							data-post="{{ $post->id }}" 
							href="#">
							{{ $audio->description }}
					</a>
				</li>
			@endforeach
		</ul>
	</div>
</div>