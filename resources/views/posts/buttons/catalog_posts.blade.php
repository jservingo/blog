{{-- buttons.catalog_posts (OK) --}}

<div style="float:left">
	<a class="btn_edit_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/edit.png" width="28" />
	</a>				

	<a class="btn_copy_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/copy.png" width="28" />
	</a>

	<a class="btn_create_post_from_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/add.png" width="28" />
	</a>	

	<a class="btn_paste_post_to_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/paste.png" width="28" />
	</a>

	<a class="btn_sort_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/sort.png" width="28" />
	</a>

	<a class="btn_show_info_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/info.png" width="28" />
	</a>
</div>

<div id="menu_view_posts" class="popr box_popup" 
		style = "width:28px; float:left;"
		data-id="view_posts">
  <img src="/img/view.png" width="28" />
</div>