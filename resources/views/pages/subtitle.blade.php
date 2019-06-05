{{-- pages.subtitle --}}

@if ($subtitle != "")
<div class="container">
	<div class="title">
		<h2>
			{{ $subtitle }}

			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			{{-- Category buttons (OK) --}}

			<a class="btn_create_catalog_from_category"
					data-id="{{ $category->id }}">
				<img src="/img/add.png" width="30" />
			</a>

			<a class="btn_paste_catalog_to_category"
					data-id="{{ $category->id }}">
				<img src="/img/paste.png" width="30" />
			</a>

			<a class="btn_sort_category"
					data-id="{{ $category->id }}">
				<img src="/img/sort.png" width="30" />
			</a>

			{{-- 
			<div id="menu_view_catalogs" class="popr box_popup" 
					style = "width:28px; float:left;"
					data-id="view_catalogs">
			  <img src="/img/view.png" width="28" />
			</div>
			--}}

		</h2>
	</div>
</div>
@endif