@if ($post->isUser())
	<div><a class="vlink" href="{{ route('apps.show_created_by_user',['user' => $post->user->id]) }}">{{ __('messages.apps') }} <span id="u_apps"></span></a></div>
	<div><a class="vlink" href="{{ route('pages.show_created_by_user',['user' => $post->user->id]) }}">{{ __('messages.pages') }} <span id="u_pages"></a></div>
	<div><a class="vlink" href="{{ route('catalogs.show_created_by_user',['user' => $post->user->id]) }}">{{ __('messages.catalogs') }} <span id="u_catalogs"></a></div>	
	<div><a class="vlink" href="{{ route('posts.show_created_by_user',['user' => $post->user->id, 'type' => 0]) }}">{{ __('messages.posts') }} <span id="u_posts"></a></div>
@endif

@if ($post->isPage())
	<div><a class="vlink" href="{{ route('page.show_page_category',['page' => $page->id, 'category' => 0]) }}">{{ __('messages.catalogs') }} <span id="p_catalogs"></a></div>
@endif

@if ($post->isCatalog())
	<div><a class="vlink" href="{{ route('catalog.show_catalog',['catalog' => $catalog->id]) }}">{{ __('messages.posts') }} <span id="c_posts"></a></div>
@endif