{{-- catalogs.title --}}

<div class="container">
	<div class="title">
		<h2 style="float:left;">
			{{ $title }}
		</h2>
		<div style="float:left;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<div style="float:left; padding-top:20px;">
			<div style="float:left">
				<a class="btn_create_catalog">
					<img src="/img/add.png" width="28" />
				</a>

				<a class="btn_sort_created_catalogs">
					<img src="/img/sort.png" width="28" />
				</a>
			</div>

			<div id="menu_view_catalogs" class="popr box_popup" 
					style = "width:28px; float:left;"
					data-id="view_catalogs">
			  <img src="/img/view.png" width="28" />
			</div>

			<div style="clear: both;"></div>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>