@if ($post->type_id >= 21)
	<div class="image-w-text">
	  <span class="cite-2">{{ $post->get_type() }}</span>
	</div>
@endif

<div class="image-w-text">
	<span class="cite-2">{{ __('messages.owner') }}: </span>
  <span class="user c-blue">
    <a id="t-user" href="/user/{{ $post->owner->id }}"> 
      {{ $post->owner->name }}
    </a>
  </span>
</div>

<div class="image-w-text">
  <span class="cite-2">{{ __('messages.publication-date') }}:</span> 
  {{ $post->published_at->format('d/m/y') }}
</div> 

@if ($post->published_at <> $post->updated_at)
	<div class="image-w-text">
  	<span class="cite-2">{{ __('messages.updated-date') }}:</span>
    {{ $post->updated_at->format('d/m/y') }}
	</div> 
@endif   

@if ($post->kpost && ($post->kpost->send_by <> $post->kpost->user_id))
  <div class="image-w-text">
    <span class="cite-2">{{ __('messages.sent-by') }}:</span> 
    <span class="user c-blue">
      <a id="t-user" href="/user/{{ $post->sender->id }}">
        {{ $post->sender->name }}
      </a>
    </span>
    {{ $post->kpost->created_at->format('d/m/y') }}
  </div>
@endif   

<div class="image-w-text">
  <span class="cite-2">{{ __('messages.views') }}:</span> {{ $post->views }}
</div>  
