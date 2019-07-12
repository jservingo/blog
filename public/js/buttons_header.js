$(function(){
	/*
  $.growl({ title: "Growl", message: "The kitten is awake!" });
  $.growl.error({ message: "The kitten is attacking!" });
  $.growl.notice({ message: "The kitten is cute!" });
  $.growl.warning({ message: "The kitten is ugly!" }); 
  */
}); 

$('#menu_profile').on("click","div.popr-item", function(e){
  var btn = $(this).data('btn');
  switch(btn)
  {
    case 'btn_account':
      alert("/user/account");
      break;
    case 'btn_logout':
      logout();
      break;
  } 
});

$('#menu_view_posts').on("click","div.popr-item", function(e){
  var view = $(this).data('view');
  set_view(view,"posts");
});

$('#menu_view_catalogs').on("click","div.popr-item", function(e){
  var view = $(this).data('view');
  set_view(view,"catalogs");
});

$('.box_popup').on("click","div.popr-item", function(e){
  var btn = $(this).data('btn');
  switch(btn)
  {
    case 'btn_save_app_post':
      var app_id = $(this).data("id");
      var source = $(this).data("source");
      var custom_type = $(this).data("custom_type");
      btn_save_app_post(app_id, source, custom_type);
      break;
    case 'btn_create_catalog_from_category':
      var category_id = $(this).data("id");
      btn_create_catalog_from_category(category_id);
      break; 
    case 'btn_create_catalog':
      btn_create_catalog();
      break;
    case 'btn_create_page':
      btn_create_page();
      break;
    case 'btn_create_post':
      btn_create_post();
      break;
    case 'btn_edit_post':
      var post_id = $(this).data("id");
      var url = "/post/"+post_id;
      btn_edit (url);
      //location = "/post/"+post_id;
      break;
    case 'btn_edit_catalog':
      var catalog_id = $(this).data("id");
      var url = "/catalog/"+catalog_id;
      btn_edit (url);
      //location = "/catalog/"+catalog_id;
      break;
    case 'btn_edit_page':
      var page_id = $(this).data("id");
      var url = "/page/"+page_id;
      btn_edit (url);
      //location = "/page/"+page_id;
      break;
    case 'btn_add_subscription':
      var post_id = $(this).data("id");
      btn_add_subscription(post_id);
      break;
    case 'btn_add_user_to_contacts':
      var user_id = $(this).data("id");
      btn_add_user_to_contacts(user_id);
      break;
    case 'btn_save_post':
      var post_id = $(this).data("id");
      btn_save_post(post_id);
      break;
    case 'btn_discard_post':
      var post_id = $(this).data("id");
      btn_discard_post(post_id);
      break;
    case 'btn_copy_catalog':
      e.preventDefault();
      var ref_id = $(this).data("id");
      btn_copy_catalog(ref_id);
      break;
    case 'btn_copy_post':
      e.preventDefault();
      var post_id = $(this).data("id");
      btn_copy_post(post_id);
      break;
    case 'btn_paste_post_to_catalog':
      e.preventDefault();
      var catalog_id = $(this).data("id");
      btn_paste_post_to_catalog(catalog_id);
      break;
    case 'btn_paste_catalog_to_category':
      e.preventDefault();
      var category_id = $(this).data("id");
      btn_paste_catalog_to_category(category_id);
      break;
    case 'btn_paste_post_to_contacts':
      e.preventDefault();
      var group_id = $(this).data("id");
      btn_paste_post_to_contacts(group_id);
      break;
    case 'btn_delete_catalog_from_category':
      var catalog_id = $(this).data("id");
      var category_id = $(this).data("category");
      btn_delete_catalog_from_category(catalog_id, category_id);
      break;
    case 'btn_delete_catalog_from_created_catalogs':
      var catalog_id = $(this).data("id");
      btn_delete_catalog_from_created_catalogs(catalog_id);
      break;
    case 'btn_delete_post_from_catalog':
      var post_id = $(this).data("id");
      var catalog_id = $(this).data("catalog");
      btn_delete_post_from_catalog(post_id, catalog_id);
      break;
    case 'btn_delete_post_from_created_posts':
      var post_id = $(this).data("id");
      btn_delete_post_from_created_posts(post_id);
      break;
    case 'btn_delete_post_from_created_pages':
      var post_id = $(this).data("id");
      btn_delete_post_from_created_pages(post_id);
      break;
    case 'btn_delete_post_from_subscription':
      var post_id = $(this).data("id");
      btn_delete_post_from_subscription(post_id);
      break;
    case 'btn_delete_post_from_contacts':
      var post_id = $(this).data("id");
      btn_delete_post_from_contacts(post_id);
      break;
    case 'btn_delete_post_from_contacts_group':
      var post_id = $(this).data("id");
      var group_id = $(this).data("group");
      btn_delete_post_from_contacts_group(post_id, group_id);
      break;
  } 
});

// HEADER

$('.btn_login').bind('click', function(e){
  location = "/user/login";
}); 

$('.btn_register').bind('click', function(e){
  location = "/user/register";
}); 

$('.btn_configuration').bind('click', function(e){
  alert("/user/configuration");
});

$('.btn_notifications').bind('click', function(e){
  alert("/user/notifications");
});

$('.btn_options').bind('click', function(e){
  alert("btn_options");
});

$('.btn_update_likes').bind('click', function(e){
  var post_id = $(this).data("id");
  var mode = $(this).data("mode");
  //console.log($(this));
  btn_update_likes (post_id, mode, $(this));
});

$('.searchButton').bind('click', function(e){
  alert("Sorry! Search button is not implemented yet");
});

// FUNCTIONS

function logout()
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'post',
    url: '/logout',
    dataType: 'json',
    success: function(data) {
      location = "/";
    },
    error: function (data) {
      location = "/";
    }
  });  
}

function btn_update_likes(post_id, mode, e)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });  
  var data = {post_id: post_id, mode: mode};
  $.ajax({
    type: 'post',
    url: '/posts/likes/'+post_id+'/'+mode,
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        if (mode=="down")
        {          
          e.find('img').attr("src",'/img/likes_white.png');
          e.next().text(data.likes);
          e.data("mode","up");
        }
        else
        {          
          e.find('img').attr("src",'/img/likes_red.png');
          e.next().text(data.likes);
          e.data("mode","down");
        }
        //location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        alert('error');
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function set_message(type, message)
{
	$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {type:type, message:message};
	$.ajax({
    type: 'post',
    url: '/message',
    data: data,
    dataType: 'json',
    success: function(data) {
    	//alert("set_message OK");
    },
    error: function (data) {
      console.log('Error:', data);
      //alert("set_message ERROR. Ver consola");
    }
	});	
}

function set_view(view,root)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {view:view,root:root};
  $.ajax({
    type: 'post',
    url: '/view',
    data: data,
    dataType: 'json',
    success: function(data) {
      //alert("set_message OK");
      location.reload();
    },
    error: function (data) {
      console.log('Error:', data);
      //alert("set_message ERROR. Ver consola");
      location.reload();
    }
  }); 
}

function replaceAll(str,x,y)
{
  var regex = new RegExp(x, "g");
  return(str.replace(regex, y)); 
}

function get_month(f)
{
  var meses = new Array ("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
  return (meses[f.getMonth()]);  
}

function get_type(type)
{
	switch(type)
	{
		case 1:
			return "Photo gallery";
		case 2:
			return "Frame";
		case 3:
			return "Text";
		case 4:
			return "Notification";
    case 5:
      return "Web page";
    case 6:
      return "Offer";		
		case 21:
			return "Catalog";
		case 22:
			return "Page";
		case 23:
			return "App";		
    case 24:
      return "User";
    case 25:
      return "Company";
    case 26:
      return "Offer";
    case 27:
      return "Custom";  
	}
} 

