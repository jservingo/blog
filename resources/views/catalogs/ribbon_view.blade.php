{{-- catalogs.ribbon_view --}}

@php
	$i = 0;
@endphp

@if(!$catalogs->isEmpty())
	@foreach($catalogs as $catalog)
	  @php
	    $i = $i+1;
		@endphp
		<div class="category container catcont" data-id="{{ $i }}" style="overflow: hidden">
			@include('catalogs.buttons')

			<div class="posts container">
				<div id="slider{{ $i }}" class="slider">
					<div>
						@if(!$catalog->posts->isEmpty())
							@foreach($catalog->posts as $post)
						  	<div>
						  		@include('posts.box.view')
						  	</div>
							@endforeach
						@else
						  @php
						  	$msg_title = __('messages.category-empty');
						  	$msg_subtitle = __('messages.category-advice');
						  @endphp	
							@include('catalogs.show_message')
						@endif			
					</div>
				</div>
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