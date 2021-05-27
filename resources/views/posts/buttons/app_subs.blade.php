{{-- buttons.app_subscriptions (OK) --}}

<div style="width:200px">
	<div class="btn tip" data-tip="{{ __('messages.tip-create-app') }}">
	<a class="btn_create_app_subs"
			data-id="{{ $app->id }}">
		<img src="/img/add.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-sort') }}">
	<a class="btn_sort_app_subs">
		<img src="/img/order.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-subscribers') }}">
	<a class="btn_show_app_subscribers"
			data-id="{{ $app->id }}">
		<img src="/img/group.png" width="28" />
	</a>
	</div>

	<div class="btn tip" data-tip="{{ __('messages.tip-info') }}">
	<a class="btn_show_info_app"
			data-id="{{ $app->id }}">
		<img src="/img/info.png" width="28" />
	</a>
	</div>

	<div id="menu_view_posts" class="btn xtip popr box_popup" 
			style = "width:28px; float:left;"
			data-id="view_posts"
			data-tip="{{ __('messages.tip-select-view') }}">
	  <img src="/img/view.png" width="28" />
	</div>
</div>