<div style="width:95%; padding-right:20px;"> 
	
	<h1>{{-- $post->type->name --}} {{ $post->title }}</h1>
	
	<div style="float:left; width:40%">	
		<div class="image-w-text">
		  Owner: {{ $post->owner->name }}
		</div>

		<div class="image-w-text">
		  Publication date: {{ $post->published_at->format('d M Y')}}
		</div> 

		@if ($post->published_at <> $post->updated_at)
			<div class="image-w-text">
		  	Updated date: {{ $post->updated_at->format('d M Y')}}
			</div> 
		@endif     

		@if ($post->kpost && ($post->sender->id <> $post->user_id))
		  <div class="image-w-text">
		    Sent by: {{ $post->sender->name }}
		  </div>
		@endif  
	</div>
	<div style="float:right; width:60%">
		@if ($post->isUser())
			<div><a class="vlink" href="{{ route('apps.show_created_user',['user' => $post->user->id]) }}">Apps</a></div>
			<div><a class="vlink" href="{{ route('pages.show_created_user',['user' => $post->user->id]) }}">Pages</a></div>
			<div><a class="vlink" href="{{ route('catalogs.show_created_user',['user' => $post->user->id]) }}">Catalogs</a></div>	
			<div><a class="vlink" href="{{ route('posts.show_created_user',['user' => $post->user->id]) }}">Posts</a></div>
		@endif
		@if ($post->isPage())
			<div><a class="vlink" href="{{ route('page.show_page_category',['page' => $page->id, 'category' => 0]) }}">Catalogs</a></div>
		@endif
		@if ($post->isCatalog())
			<div><a class="vlink" href="{{ route('catalog.show_catalog',['catalog' => $catalog->id]) }}">Posts</a></div>
		@endif
  </div>
</div>
<div style="clear: both;"></div>
