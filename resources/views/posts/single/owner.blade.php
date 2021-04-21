@if ($post->type_id >= 21)
	<div class="image-w-text">
	  <span class="cite-2">{{ $post->get_type() }}</span>
	</div>
@endif

<div class="image-w-text">
	<span class="cite-2">{{ __('messages.owner') }}: </span>
  <span class="user c-blue">
    <a id="t-user" href="/user/{{ $post->owner->id }}"></span> {{ $post->owner->name }}</a>
  </span>
</div>

<div class="image-w-text">
  <span class="cite-2">{{ __('messages.publication-date') }}:</span> {{ $post->published_at->format('d/m/y') }}
</div> 

@if ($post->published_at <> $post->updated_at)
	<div class="image-w-text">
  	<span class="cite-2">{{ __('messages.updated-date') }}:</span> {{ $post->updated_at->format('d/m/y') }}
	</div> 
@endif    

<div class="image-w-text">
  <span class="cite-2">{{ __('messages.views') }}:</span>{{ $post->views }}
</div>  

@if ($post->kpost && ($post->sender->id <> $post->user_id))
  <div class="image-w-text">
    <span class="cite-2">{{ __('messages.sent-by') }}:</span> {{ $post->sender->name }}
  </div>
@endif  
