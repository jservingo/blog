{{-- catalogs.buttons --}}

<div class="catalog-title">
	<p>
		<a class="vlink" style="font-size:20px;"
			href="{{route('catalog.show_catalog',$catalog->id) }}">
		{{ $catalog->name }}</a>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		{{-- Catalog buttons (OK) --}}

		<a class="go-xleft" data-id="{{ $i }}">
			<img src="/img/begin.png" width="30" />
		</a>

		<a class="go-left" data-id="{{ $i }}">
			<img src="/img/back.png" width="30" />
		</a>

		<a class="btn_edit_catalog" 
				data-id="{{ $catalog->id }}">
			<img src="/img/edit.png" width="30" />
		</a>				

		<a class="btn_copy_catalog" 
				data-id="{{ $catalog->id }}">
			<img src="/img/copy.png" width="30" />
		</a>

		<a class="btn_paste_post_to_catalog" 
				data-id="{{ $catalog->id }}">
			<img src="/img/paste.png" width="30" />
		</a>

		@if($category)
			<a class="btn_delete_catalog_from_category" 
					data-id="{{ $catalog->id }}"
					data-category="{{ $category->id }}">
				<img src="/img/delete.png" width="30" />
			</a>
		@else
			<a class="btn_delete_catalog_from_created_catalogs" 
					data-id="{{ $catalog->id }}">
				<img src="/img/delete.png" width="30" />
			</a>
		@endif

		<a class="btn_sort_catalog"
				data-id="{{ $catalog->id }}">
			<img src="/img/sort.png" width="30" />
		</a>

		<a class="btn_show_info_catalog" 
				data-id="{{ $catalog->id }}">
			<img src="/img/info.png" width="30" />
		</a>
	
		<a class="go-right" data-id="{{ $i }}">
			<img src="/img/next.png" width="30" />
		</a>
		
		<a class="go-xright" data-id="{{ $i }}">
			<img src="/img/end.png" width="30" />
		</a>				
	</p>
</div>