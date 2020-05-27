{{-- buttons.catalog_posts (OK) --}}

<div style="width:240px">
	<div class="btn tip" data-tip="{{ __('messages.tip-create-post') }}">
	<a class="btn_create_post_from_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/add.png" width="28" />
	</a>
	</div>	

	<div class="btn tip" data-tip="{{ __('messages.tip-edit') }}">
	<a class="btn_edit_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/edit.png" width="28" />
	</a>	
	</div>			

	<div class="btn tip" data-tip="{{ __('messages.tip-copy') }}">
	<a class="btn_copy_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/copy.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-paste') }}">
	<a class="btn_paste_post_to_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/paste.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-sort') }}">
	<a class="btn_sort_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/sort.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-info') }}">
	<a class="btn_show_info_catalog"
			data-id="{{ $catalog->id }}">
		<img src="/img/info.png" width="28" />
	</a>
	</div>

	<div id="menu_view_posts" class="btn tip popr box_popup" 
			style = "width:28px; float:left;"
			data-id="view_posts"
			data-tip="{{ __('messages.tip-select-view') }}">
	  <img src="/img/view.png" width="28" />
	</div>
</div>