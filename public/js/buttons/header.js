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
      location = "/user/account";
      break;
    case 'btn_logout':
      logout();
      break;
  } 
});

$('#menu_languages').on("click","div.popr-item", function(e){
  var btn = $(this).data('btn');
  switch(btn)
  {
    case 'btn_en':
      location = "/user/language?lang=en";
      break;
    case 'btn_es':
      location = "/user/language?lang=es";
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
      var title = $('#t-title').text();
      var excerpt = $('#t-excerpt').text();
      var img = $('#t-img').attr("src");
      var tags = $('#t-tags').text();
      var links = "";
      var footnote = $('#t-footnote').text();
      var date = $('#t-date').text();
      var user = $('#t-user').text();
      var source = $(this).data("source");
      var custom_type = $(this).data("custom_type");
      btn_save_app_post(app_id, title, excerpt, img, tags, links, footnote, date, user, source, custom_type); 
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
      btn_edit ("post", post_id);
      break;
    case 'btn_edit_catalog':
      var catalog_id = $(this).data("id");
      btn_edit ("catalog", post_id);
      break;
    case 'btn_edit_page':
      var page_id = $(this).data("id");
      btn_edit ("page", post_id);
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
    case 'btn_send_post':
      var post_id = $(this).data("id");
      btn_send_post(post_id);
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
  location = "/user/configuration";
});

$('.btn_show_alerts').bind('click', function(e){
  btn_show_alerts();
});

$('.btn_options').bind('click', function(e){
  $.growl.warning({ message: msg_not_implemented });
});

$('.btn_update_likes').bind('click', function(e){
  var post_id = $(this).data("id");
  var mode = $(this).data("mode");
  //console.log($(this));
  btn_update_likes (post_id, mode, $(this));
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

function btn_show_alerts()
{
    $.ajax({
    url: '/alerts/get',
    type: 'get',
    dataType: 'json',
    success: function(data) {
      if (data.rows.length > 0)
      {
        //Crear ventana modal
        var html = "<div id='alerts' style='height:370px;overflow-y:scroll;'>";
        var zcolor="#d5fcfd";
        data.rows.forEach(function (post) {
          if (post.type_id==4)
            var img = '<img src="/img/featured_notification.png" width="16">';
          else 
            var img = '<img src="/img/featured_alert.png" width="16">';
          var date = new Date(post.published_at);
          date = fdate(date);
          html = html + "<div style='padding:8px; background-color:"+zcolor+";'>";
          html = html + "<div>" + img + '  ';  
          html = html + '<a href="http://127.0.0.1:8000/posts/'+post.id+'" class="text-uppercase c-blue" data-id="'+post.id+'">';      
          html = html + '<span class="c-blue" style="margin-top:0;margin-bottom:6px">'+post.title+'</span></a>  ';
          html = html + '<span class="c-negro">'+post.excerpt +'</span>';
          html = html + '</div>';
          html = html + '<div style="text-align:right;">';
          html = html + '<span class="user c-blue"><a href="/user/'+post.owner.id+'">'+post.owner.name+'  </a></span>';
          html = html + '<span class="c-gray-1" style="font-size:14px">'+date+'</span>';
          html = html + '</div>';
          html = html + '<div>';
          html = html + '<div style="float:right;">';
          html = html + '<footer class="xcontainer-flex xspace-between" style="width:210px; height:24px; padding: 6px 10px; text-align:right;">';
          html = html + '<a class="btn_save_post" data-id="'+post.id+'">'; 
          html = html + '<img src="/img/save.png" width="24">';
          html = html + '</a><a class="btn_discard_post" data-id="'+post.id+'">';
          html = html + '<img src="/img/delete.png" width="24"></a>';  
          html = html + '<a class="btn_update_likes" data-id="'+post.id+'" data-mode="up">'; 
          html = html + '<img src="/img/likes_white.png" width="24"></a><span id="likes">'+post.likes+'</span>';
          html = html + '</footer>';
          html = html + '</div>';
          html = html + '<div style="float:left;">';               
          html = html + '<div class="truncate footnote" data-height="24" data-adjust="false" style="width: 200px; color:#0a1fa7; font-weight: 800; padding: 6px 10px;">';     
          html = html + '<div class="t-footnote">'+'footnote';
          html = html + '</div></div></div></div>';
          html = html + '<div style="clear:both;"></div>';
          html = html + '</div>';
          if (zcolor=="#d5fcfd")
            zcolor="#cee3ea";
          else
            zcolor="#d5fcfd";
        });
        html = html + "</div>";
        $.createDialog({
          attachAfter: '#main_panel',
          title: html,
          accept: show_all,
          refuse: msg_cancel,
          acceptStyle: 'green',
          refuseStyle: 'gray',
          acceptAction: function(){
            location = "/posts/alerts/notifications";
          }
        });
        $.showDialog();
      }
      else
      {
        $.growl.warning({ message: msg_notifications_empty });  
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

