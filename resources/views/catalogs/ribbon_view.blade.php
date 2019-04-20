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
							<div>
								<h4>Este catálogo no tiene posts</h4>
							</div>
						@endif			
					</div>
				</div>
			</div>

		</div>
	@endforeach
@else
	<div class="category container catcont">
		<div class="posts container">
			<h4>Esta categoría no tiene catálogos</h4>
		</div>
	</div>
@endif