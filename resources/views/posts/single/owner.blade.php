<div style="width:95%; padding-right:20px;"> 	
	<div style="float:left; width:60%">	
		<div class="image-w-text">
		  <span class="cite-2">{{ __('messages.owner') }}:</span> {{ $post->owner->name }}
		</div>

		<div class="image-w-text">
		  <span class="cite-2">{{ __('messages.publication-date') }}:</span> {{ $post->published_at->format('d/m/y')}}
		</div> 

		@if ($post->published_at <> $post->updated_at)
			<div class="image-w-text">
		  	<span class="cite-2">{{ __('messages.updated-date') }}:</span> {{ $post->updated_at->format('d/m/y')}}
			</div> 
		@endif     

		@if ($post->kpost && ($post->sender->id <> $post->user_id))
		  <div class="image-w-text">
		    <span class="cite-2">{{ __('messages.sent-by') }}:</span> {{ $post->sender->name }}
		  </div>
		@endif  
	</div>

	<div style="float:right; width:40%">
		@if ($post->isUser())
			<div><a class="vlink" href="{{ route('apps.show_created_user',['user' => $post->user->id]) }}">{{ __('messages.apps') }} <span id="u_apps"></span></a></div>
			<div><a class="vlink" href="{{ route('pages.show_created_user',['user' => $post->user->id]) }}">{{ __('messages.pages') }} <span id="u_pages"></a></div>
			<div><a class="vlink" href="{{ route('catalogs.show_created_user',['user' => $post->user->id]) }}">{{ __('messages.catalogs') }} <span id="u_catalogs"></a></div>	
			<div><a class="vlink" href="{{ route('posts.show_created_user',['user' => $post->user->id, 'type' => 0]) }}">{{ __('messages.posts') }} <span id="u_posts"></a></div>
		@endif
		@if ($post->isPage())
			<div><a class="vlink" href="{{ route('page.show_page_category',['page' => $page->id, 'category' => 0]) }}">{{ __('messages.catalogs') }} <span id="p_catalogs"></a></div>
		@endif
		@if ($post->isCatalog())
			<div><a class="vlink" href="{{ route('catalog.show_catalog',['catalog' => $catalog->id]) }}">{{ __('messages.posts') }} <span id="c_posts"></a></div>
		@endif
  </div>
</div>

<div style="clear: both;"></div>
