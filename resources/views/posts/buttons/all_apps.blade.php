{{-- buttons.all_apps --}}

<div style="width:200px">
  <div class="btn tip" data-tip="{{ __('messages.tip-create-app') }}">
	<a class="btn_create_app">
		<img src="/img/add.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-sort') }}">
	<a class="btn_sort_created_apps">
		<img src="/img/sort.png" width="28" />
	</a>
	</div>

	<div id="menu_view_posts" class="btn xtip popr box_popup" 
			style = "width:28px; float:left;"
			data-id="view_posts"
			data-tip ="{{ __('messages.tip-select-view') }}">
	  <img src="/img/view.png" width="28" />
	</div>
</div>
