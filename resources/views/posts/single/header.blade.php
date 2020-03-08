<div style="width:95%; padding-right:20px;"> 
	
	<h1>{{-- $post->type->name --}} {{ $post->title }}</h1>
	
	<div style="float:left; width:40%">	
		<div class="image-w-text">
		  {{ __('messages.owner') }}: {{ $post->owner->name }}
		</div>

		<div class="image-w-text">
		  {{ __('messages.publication-date') }}: {{ $post->published_at->format('d/m/y')}}
		</div> 

		@if ($post->published_at <> $post->updated_at)
			<div class="image-w-text">
		  	{{ __('messages.updated-date') }}: {{ $post->updated_at->format('d/m/y')}}
			</div> 
		@endif     

		@if ($post->kpost && ($post->sender->id <> $post->user_id))
		  <div class="image-w-text">
		    {{ __('messages.sent-by') }}: {{ $post->sender->name }}
		  </div>
		@endif  
	</div>
	<div style="float:right; width:60%">
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
