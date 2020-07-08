
<div class="truncate" data-height="46" style="width:144px;background-color:#fefdfd; padding:10px 10px;">
	<a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
			class="text-uppercase c-blue"
  		data-id="{{ $post->id }}">
  	<h1 class="t-title" style="margin-top:0;margin-bottom:0px">{{ $post->title }}</h1>  
		@if ($post->isOffer())
			<h2><a class="button yellow">{{ __('messages.prometed-post') }}</a></h2>
		@endif
	</a>
</div>
