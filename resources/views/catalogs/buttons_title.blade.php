{{-- catalogs.buttons_title --}}

<div class="container">
	<div class="title">
		<h2 style="float:left;">
			{{ $title }}
		</h2>
		<div style="float:left;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<div style="float:left; width:200px; padding-top:20px;">
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
					data-tip="Select view">
			  <img src="/img/view.png" width="28" />
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>