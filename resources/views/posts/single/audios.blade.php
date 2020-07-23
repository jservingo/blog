{{-- posts.single.audios --}}

<div class="audios xcontainer-flex">
	<div id="audioWrap" style="background:#333"></div>
	<div>
		<ul>
			@foreach ($post->audios->sortBy('featured')->sortBy('position') as $audio)
				<li>
					<audio preload="auto" src="{{ url('storage/'.$audio->url) }}"></audio>
				</li>
			@endforeach
		</ul>
	</div>
</div>
