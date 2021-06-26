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
  @if ($post->isUser())
    @if ($post->isContact())
      <span style="color:green">(contacto)</span>
    @endif 
  @endif
</div>

<div class="image-w-text">
  <span class="cite-2">{{ __('messages.publication-date') }}:</span> 
  <span class="fdate">{{ $post->published_at }}</span>
</div> 

@if ($post->published_at <> $post->updated_at)
	<div class="image-w-text">
  	<span class="cite-2">{{ __('messages.updated-date') }}:</span>
    <span class="fdate">{{ $post->updated_at }}</span>
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
    <span class="fdate">{{ $post->kpost->created_at }}</span>
  </div>
@endif   

<div class="image-w-text">
  <span class="cite-2">{{ __('messages.views') }}:</span> {{ $post->views }}
</div>  
