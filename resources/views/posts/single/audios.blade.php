{{-- posts.single.audios --}}

<div class="audios xcontainer-flex">
	<div id="audioWrap" style="background:#333"></div>
	<div>
		<ul>
			@foreach ($post->audios as $audio)
				<li>
					<a id="btn_play_audio" 
							data-url="{{ url('storage/'.$audio->url) }}" 
							href="#">
							{{ $audio->description }}
					</a>
				</li>
			@endforeach
		</ul>
	</div>
</div>
