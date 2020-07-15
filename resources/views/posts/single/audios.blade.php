{{-- posts.single.audios --}}

<div class="audios container-flex">
	<div id="audioWrap"></div>
		<ul>
			@foreach ($post->audios as $audio)
				<li>
					<a id="btn_play_audio" 
							data-url="{{ $audio->url }}" 
							href="#">
							{{ $audio->description }}
					</a>
				</li>
			@endforeach
		</ul>
	</div>
</div>
