{{-- posts.single.audios --}}

<div class="audios container-flex">
	@foreach ($post->audios as $audio)
		<span class="tag c-gray-1 text-capitalize">
			{{ $audio->description }}
		</span>
	@endforeach
</div>
