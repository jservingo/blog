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
					  	$msg_title = __('messages.catalog-empty');
					  	$msg_subtitle = __('messages.catalog-advice');
					@endphp	
					@include('catalogs.show_message')
				@endif								
			</div>
		</div>
	@endforeach
@else
	@php
  		$msg_title = __('messages.category-empty');
  		$msg_subtitle = __('messages.category-advice');
  	@endphp	
    <div class="posts container">
		@include('catalogs.show_message')
	</div>
@endif