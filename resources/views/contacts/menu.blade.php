{{-- contacts.menu --}}

<div id="menu_panel" class="tree gradient-left" 
	style="position:fixed;
			top:95px; left:20px; 
			padding:20px; box-sizing:border-box;
			box-shadow: 0px 0px 2px 2px #186a7f;
			visibility:hidden; 
			width:415px; height:510px; 
			background-color:#e6f2ff;
			z-index:2">
	<div style="float:left">
  	<h2>Listas de contactos</h2>
  </div>
	<div style="float:right">
		<a class="btn_close_menu_panel">
			<img src="/img/close.png" />
		</a>
	</div>
	<div style="clear: both"></div>
  <div id="contacts_tree" style="width:100%;position:fixed;z-index:3;"></div>
  <!--<div id="SimpleJSTree" style="width:100%;position:fixed;z-index:3"></div>-->
</div>  