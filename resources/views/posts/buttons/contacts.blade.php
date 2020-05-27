{{-- buttons.contacts --}}
		
<div style="width:200px">
	<div class="btn tip" data-tip="{{ __('messages.tip-categories') }}">
	<a class="btn_show_contacts_categories">
		<img src="/img/categories.png" width="28" />
	</a> 
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-paste') }}">
	<a class="btn_paste_post_to_contacts"
			data-id="{{ $group_id }}">
		<img src="/img/paste.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-sort') }}">
	<a class="btn_sort_contacts">
		<img src="/img/sort.png" width="28" />
	</a>
	</div>

	<div id="menu_view_posts" class="btn xtip popr box_popup" 
			style = "width:28px; float:left;"
			data-id="view_posts"
			data-tip="{{ __('messages.tip-select-view') }}">
  	<img src="/img/view.png" width="28" />
	</div>
</div>