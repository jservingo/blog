// SHOW CATEGORIES (PAGE & CONTACTS)

$('.btn_show_page_categories').bind('click', function(e){
  e.preventDefault();
  var page_id = $(this).data("id");
  $('#menu_panel').css("visibility","visible");
});

$('.btn_show_contacts_categories').bind('click', function(e){
	e.preventDefault();
  $('#menu_panel').css("visibility","visible");
});

$('.btn_close_menu_panel').bind('click', function(e){
	e.preventDefault();
  $('#menu_panel').css("visibility","hidden");
});

