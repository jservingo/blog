{{-- buttons.app_subscriptions (OK) --}}

<div style="float:left">
	<div style="float:left">
		<a class="btn_sort_app_subs">
			<img src="/img/order.png" width="28" />
		</a>
	</div>

	<a class="btn_show_app_subscribers"
			data-id="{{ $app->id }}">
		<img src="/img/group.png" width="28" />
	</a>

	<a class="btn_show_info_app"
			data-id="{{ $app->id }}">
		<img src="/img/info.png" width="28" />
	</a>
</div>

<div id="menu_view_posts" class="popr box_popup" 
		style = "width:28px; float:left;"
		data-id="view_posts">
  <img src="/img/view.png" width="28" />
</div>