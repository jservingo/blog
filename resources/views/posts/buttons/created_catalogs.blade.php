{{-- buttons.created_catalogs --}}

<div style="width:200px">
	<div class="btn tip" data-tip="{{ __('messages.tip-create-catalog') }}">
	<a class="btn_create_catalog">
		<img src="/img/add.png" width="28" />
	</a>
  </div>

  <div class="btn tip" data-tip="{{ __('messages.tip-sort') }}">
	<a class="btn_sort_created_catalogs">
		<img src="/img/sort.png" width="28" />
	</a>
	</div>

	<div id="menu_view_catalogs" class="btn xtip popr box_popup" 
			style = "width:28px; float:left;"
			data-id="view_catalogs"
			data-tip="{{ __('messages.tip-select-view') }}">
	  <img src="/img/view.png" width="28" />
	</div>
</div>