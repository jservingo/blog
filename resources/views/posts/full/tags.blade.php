<div class="truncate footnote" data-height="24" data-adjust="false" 
		style="width:400px; color:#155597; font-weight:800; background-color:{{ $zcolor }}; padding:6px 10px;">     
	<div class="t-tags">
		@foreach ($post->tags as $tag)
		<span class="tag c-gray-1 text-capitalize">
			<a href="{{ route('tags.show',$tag) }}">#{{ $tag->name }}</a>
		</span>
	@endforeach
	</div> 
</div>	