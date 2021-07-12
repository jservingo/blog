{{-- catalogs.ribbon_view --}}

@inject('provider', 'App\Http\Controllers\CatalogsController')

@php
	$i = 0;
@endphp

@if(!$catalogs->isEmpty())
	@foreach($catalogs as $catalog)
	  @php
	    $i = $i+1;
	    $posts =  $provider::get_posts($catalog->id);
		@endphp
		<div class="category container catcont" data-id="{{ $i }}" style="overflow: hidden">
			@include('catalogs.buttons_ribbon')

			<div class="posts container">
				@if(!$posts->isEmpty())
					<div id="slider{{ $i }}" class="slider">
						<div>					
							@foreach($posts as $post)
						  	<div>
						  		@include('posts.box.view')
						  	</div>
							@endforeach
						</div>
					</div>	
				@else
					@php
					  	$msg_title = __('messages.category-empty');
					  	$msg_subtitle = __('messages.category-advice');
					@endphp	
					@include('catalogs.show_message')
				@endif								
			</div>

		</div>
	@endforeach
@else
	<div class="category container catcont">
		<div class="posts container">
			@php
		  	$msg_title = "This category doesn't have catalogs.";
		  	$msg_subtitle = "You can add or paste a catalog.";
		  @endphp	
			@include('catalogs.show_message')
		</div>
	</div>
@endif