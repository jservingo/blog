{{-- pages.subtitle --}}

@if ($subtitle != "")
<div class="container">
	<div class="title">
		<div style="float:left;">
			<h2>{{ $subtitle }}</h2>
		</div>
		<div style="float:left;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>

		<div style="float:left; padding-top:20px;">
			{{-- Category buttons (OK) --}}

			<div class="btn tip" data-tip="{{ __('messages.tip-create-catalog') }}">
			<a class="btn_create_catalog_from_category"
					data-id="{{ $category->id }}">
				<img src="/img/add.png" width="30" />
			</a>
			</div>

			<div class="btn tip" data-tip="{{ __('messages.tip-paste') }}">
			<a class="btn_paste_catalog_to_category"
					data-id="{{ $category->id }}">
				<img src="/img/paste.png" width="30" />
			</a>
			</div>

			<div class="btn tip" data-tip="{{ __('messages.tip-sort') }}">
			<a class="btn_sort_category"
					data-id="{{ $category->id }}">
				<img src="/img/sort.png" width="30" />
			</a>
			</div>

			{{-- 
			<div id="menu_view_catalogs" class="popr box_popup" 
					style = "width:28px; float:left;"
					data-id="view_catalogs">
			  <img src="/img/view.png" width="28" />
			</div>
			--}}
		</div>
		<div style="clear: both;"></div>
	</div>
</div>
@endif