/*
 * jQuery Kodelia operations
 *  *
 * Copyright 2018, Jorge Servin
 */

$(function(){
	/*
  $.growl({ title: "Growl", message: "The kitten is awake!" });
  $.growl.error({ message: "The kitten is attacking!" });
  $.growl.notice({ message: "The kitten is cute!" });
  $.growl.warning({ message: "The kitten is ugly!" }); 
  */
}); 

$('#menu_profile').on("click","div.popr-item", function(){
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

$('.app-posts').on("click",".btn_save_app_post", function(){
  var app_id = $(this).data("id");
  var source = $(this).data("source");
  var custom_type = $(this).data("custom_type");
  btn_save_app_post(app_id, source, custom_type); 
});

//OJO FALTA POR HACER EL BOTON COPIAR AL CLIPBOARD

$('#menu_view_posts').on("click","div.popr-item", function(){
  var view = $(this).data('view');
  set_view(view,"posts");
});

$('#menu_view_catalogs').on("click","div.popr-item", function(){
  var view = $(this).data('view');
  set_view(view,"catalogs");
});

$('.box_popup').on("click","div.popr-item", function(){
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

/******************************************************************

                        BUTTONS

*******************************************************************/

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

// CREATE, EDIT & SHOW

$('.btn_create_catalog_from_category').bind('click', function(e){
  var category_id = $(this).data("id");
  btn_create_catalog_from_category(category_id);
}); 

$('.btn_create_catalog').bind('click', function(e){
  btn_create_catalog();
}); 

$('.btn_create_page').bind('click', function(e){
  btn_create_page();
}); 

$('.btn_create_post').bind('click', function(e){
  btn_create_post();
});	

$('.btn_edit_post').bind('click', function(e){
  var post_id = $(this).data("id");
  url = "/post/"+post_id;
  btn_edit (url);
  //location = "/post/"+post_id;
});

$('.btn_edit_catalog').bind('click', function(e){
  var catalog_id = $(this).data("id");
  var url = "/catalog/"+catalog_id;
  btn_edit (url);
  //location = "/catalog/"+catalog_id;
});

$('.btn_edit_page').bind('click', function(e){
  var page_id = $(this).data("id");
  var url = "/page/"+page_id;
  btn_edit (url);
  //location = "/page/"+page_id;
});

$('.btn_show_post').bind('click', function(e){
  var post_id = $(this).data("id");
  url = "/posts/"+post_id;
  btn_show (url);
  //location = "/post/"+post_id;
});

// ADD USER, ADD SUBSCRIPTION SAVE & DISCARD POST

$('.btn_add_subscription').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_add_subscription(post_id);
});

$('.btn_add_user_to_contacts').bind('click', function(e){
  var user_id = $(this).data("id");
  btn_add_user_to_contacts(user_id);
});

$('.btn_save_post').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_save_post(post_id);
});

$('.btn_discard_post').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_discard_post(post_id);
});

// COPY & PASTE

$('.btn_copy_catalog').bind('click', function(e){
	e.preventDefault();
  var ref_id = $(this).data("id");
  btn_copy_catalog(ref_id);
});

$('.btn_copy_post').bind('click', function(e){
	e.preventDefault();
  var post_id = $(this).data("id");
  btn_copy_post(post_id);
});

$('.btn_paste_post_to_catalog').bind('click', function(e){
	e.preventDefault();
	var catalog_id = $(this).data("id");
  btn_paste_post_to_catalog(catalog_id);
});

$('.btn_paste_catalog_to_category').bind('click', function(e){
	e.preventDefault();
	var category_id = $(this).data("id");
  btn_paste_catalog_to_category(category_id);
});

$('.btn_paste_post_to_contacts').bind('click', function(e){
  e.preventDefault();
  var group_id = $(this).data("id");
  btn_paste_post_to_contacts(group_id);
});

// DELETE OPERATIONS

$('.btn_delete_catalog_from_category').bind('click', function(e){
  var catalog_id = $(this).data("id");
  var category_id = $(this).data("category");
  btn_delete_catalog_from_category(catalog_id, category_id);
});

$('.btn_delete_catalog_from_created_catalogs').bind('click', function(e){
  var catalog_id = $(this).data("id");
  btn_delete_catalog_from_created_catalogs(catalog_id);
});

$('.btn_delete_post_from_catalog').bind('click', function(e){
  var post_id = $(this).data("id");
  var catalog_id = $(this).data("catalog");
  btn_delete_post_from_catalog(post_id, catalog_id);
});

$('.btn_delete_post_from_created_posts').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_delete_post_from_created_posts(post_id);
});

$('.btn_delete_post_from_created_pages').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_delete_post_from_created_pages(post_id);
});

$('.btn_delete_post_from_subscription').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_delete_post_from_subscription(post_id);
});

$('.btn_delete_post_from_contacts').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_delete_post_from_contacts(post_id);
});

$('.btn_delete_post_from_contacts_group').bind('click', function(e){
  var post_id = $(this).data("id");
  var group_id = $(this).data("group");
  btn_delete_post_from_contacts_group(post_id, group_id);
});

// CATALOG RIBBON

//$('.catalog-buttons').hide();

$('.catcont').bind('mouseover',function() {
  var id = $(this).data("id");
  //$('#catalog_buttons'+id).show();
});

$('.catcont').bind('mouseout',function() {
  var id = $(this).data("id");
  //$('#catalog_buttons'+id).hide();
});

$('.go-xleft').bind('click', function(){
  var id = $(this).data("id"); 
  for(i=0;i<=3;i++)
    $('#slider'+id).diyslider('move', 'back');
});

$('.go-left').bind('click', function(){
  var id = $(this).data("id");
  $('#slider'+id).diyslider('move', 'back');
});

$('.go-right').bind('click', function(){
  var id = $(this).data("id");
  $('#slider'+id).diyslider('move', 'forth');
});

$('.go-xright').bind('click', function(){
  var id = $(this).data("id");
  for(i=0;i<=3;i++)
    $('#slider'+id).diyslider('move', 'forth');
});

/******************************************************************

                        FUNCTIONS

******************************************************************/

//*****************************************************************
// CREATE & EDIT
//*****************************************************************

function btn_create_catalog_from_category(category_id)
{
  //Crear ventana modal
  var html = "<div id='edit'>";
  html = html + "<h3>Create catalog</h3>";
  html = html + "<p>Título del catálogo</p>";
  html = html + "<input id='title' type='text' class='form-control' placeholder='Ingrese el título del aviso' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: 'Crear',
    refuse: 'Cancelar',
    acceptStyle: 'blue',
    refuseStyle: 'red',
    acceptAction: function(){
      title = $('#title').val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });      
      var data = {category_id:category_id, title:title};
      $.ajax({
        type: 'post',
        url: '/catalog',
        data: data,
        dataType: 'json',
        success: function(data) {
          if (data.success){
            location = "/post/"+data.post_id;
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
  });
  $.showDialog();  
}

function btn_create_catalog()
{
  //Crear ventana modal
  var html = "<div id='edit'>";
  html = html + "<h3>Create catalog</h3>";
  html = html + "<p>Título del catálogo</p>";
  html = html + "<input id='title' type='text' class='form-control' placeholder='Ingrese el título del aviso' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: 'Crear',
    refuse: 'Cancelar',
    acceptStyle: 'blue',
    refuseStyle: 'red',
    acceptAction: function(){
      title = $('#title').val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var data = {title:title};
      $.ajax({
        type: 'post',
        url: '/catalog',
        data: data,
        dataType: 'json',
        success: function(data) {
          if (data.success){
            location = "/post/"+data.post_id;
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
  });
  $.showDialog();  
}

function btn_create_page()
{
  //Crear ventana modal
  var html = "<div id='edit'>";
  html = html + "<h3>Create page</h3>";
  html = html + "<p>Título de la página</p>";
  html = html + "<input id='title' type='text' class='form-control' placeholder='Ingrese el título del aviso' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: 'Crear',
    refuse: 'Cancelar',
    acceptStyle: 'blue',
    refuseStyle: 'red',
    acceptAction: function(){
      title = $('#title').val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var data = {title:title};
      $.ajax({
        type: 'post',
        url: '/page',
        data: data,
        dataType: 'json',
        success: function(data) {
          if (data.success){
            location = "/post/"+data.post_id;
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
  });
  $.showDialog();  
}

function btn_create_post()
{
  //Crear ventana modal
  var html = "<div id='edit'>";
  html = html + "<h3>Create post</h3>";
  html = html + "<p>Tipo de post</p>";
  html = html + "<select id='type'>";
  html = html + "<option value='1'>Photo gallery</option>";
  html = html + "<option value='2'>Frame: video or soundcloud</option>";
  html = html + "<option value='3'>Text</option>";
  html = html + "<option value='4'>Notification</option>";
  html = html + "<option value='11'>Web Page link</option>";
  html = html + "</select>";
  html = html + "<p>Título del post</p>";
  html = html + "<input id='title' type='text' class='form-control' placeholder='Ingrese el título del aviso' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: 'Crear',
    refuse: 'Cancelar',
    acceptStyle: 'blue',
    refuseStyle: 'red',
    acceptAction: function(){
      title = $('#title').val();
      type_id = $('#type').val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var ref_id = $(this).data("id");
      var data = {type_id:type_id, title:title};
      $.ajax({
        type: 'post',
        url: '/post',
        data: data,
        dataType: 'json',
        success: function(data) {
          if (data.success){
            location = "/post/"+data.post_id;
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
  });
  $.showDialog();
}

function btn_edit(url)
{
  var myWidth = screen.width - 100;
  var myHeight = screen.height - 200;
  var left = (screen.width - myWidth) / 2;
  var top = (screen.height - myHeight) / 4;
  var myWindow = window.open(url, 'Edit', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
}

function btn_show($url)
{
  var myWidth = screen.width - 100;
  var myHeight = screen.height - 200;
  var left = (screen.width - myWidth) / 2;
  var top = (screen.height - myHeight) / 4;
  var myWindow = window.open(url, 'Edit', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);  
}

//*****************************************************************
// ADD USER, ADD SUBSCRIPTION SAVE & DISCARD POST
//*****************************************************************

function btn_save_app_post(app_id, source, custom_type)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea guardar este post?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      save_app_post(app_id, source, custom_type);
    }
  });
  $.showDialog();  
}

function btn_add_subscription(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea suscribirse?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      add_subscription(post_id);
    }
  });
  $.showDialog();  
}

function btn_add_user_to_contacts(user_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea añadir este usuario a sus contactos?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      add_user_to_contacts(user_id);
    }
  });
  $.showDialog();  
} 

function btn_save_post(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea guardar este post?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      save_post(post_id);
    }
  });
  $.showDialog();  
}

function btn_discard_post(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea descartar este post?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      discard_post(post_id);
    }
  });
  $.showDialog();  
}

function save_app_post(app_id, source, custom_type)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {app_id: app_id, source: source, custom_type: custom_type};
  $.ajax({
    type: 'post',
    url: '/apps/post',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El post fue guardado");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero no fue posible guardar el post. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function add_subscription(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {post_id: post_id};
  $.ajax({
    type: 'post',
    url: '/subscriptions/add',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","La suscripcion fue exitosa");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero no fue posible realizar la suscripcion. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function add_user_to_contacts(user_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {user_id: user_id};
  $.ajax({
    type: 'post',
    url: '/contacts/add',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El usuario fue añadido a los contactos");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el usuario no fue añadido a los contactos. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function save_post(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {post_id: post_id};
  $.ajax({
    type: 'post',
    url: '/posts/save',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El post fue guardado");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el post no fue guardado. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function discard_post(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {post_id: post_id};
  $.ajax({
    type: 'post',
    url: '/posts/discard',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El post fue descartado");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el post no fue descartado. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });   
}

//*****************************************************************
// COPY & PASTE
//*****************************************************************

function btn_copy_catalog(ref_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {ref_id: ref_id};
  $.ajax({
    type: 'post',
    url: '/clipboards/copy/catalog',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        location.reload();
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

function btn_copy_post(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });  
  var data = {post_id: post_id};
  $.ajax({
    type: 'post',
    url: '/clipboards/copy/post',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        location.reload();
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

function btn_paste_post_to_catalog(catalog_id)
{
  //Obtener posts del clipboard
  $.ajax({
    url: '/clipboards/posts',
    type: 'get',
    dataType: 'json',
    success: function(data) {
      //Crear ventana modal
      var html = "<div id='clipboard' class='multiselect'>";
      data.rows.forEach(function (post) {
        var type = get_type(post.type_id);
        html = html + "<div><label><input type='checkbox' name='option[]' value="+post.id+" /> "+type+" - "+post.title+"</label></div>";
      });
      html = html + "</div>";
      $.createDialog({
        attachAfter: '#main_panel',
        title: html,
        accept: 'Pegar',
        refuse: 'Cancelar',
        acceptStyle: 'red',
        refuseStyle: 'gray',
        acceptAction: function(){
          //Crear arreglo con posts seleccionados
          var selected = [];
          $('div#clipboard input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
              selected.push($(this).attr('value'));
            }
          });
          paste_post_to_catalog(selected, catalog_id);
        }
      });
      $.showDialog();
      $(".multiselect").multiselect();
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });     
}

function btn_paste_post_to_contacts(group_id)
{
  //Obtener posts del clipboard
  $.ajax({
    url: '/clipboards/contacts',
    type: 'get',
    dataType: 'json',
    success: function(data) {
      //Crear ventana modal
      var html = "<div id='clipboard' class='multiselect'>";
      data.rows.forEach(function (post) {
        html = html + "<div><label><input type='checkbox' name='option[]' value="+post.id+" />"+post.title+"</label></div>";
      });
      html = html + "</div>";
      $.createDialog({
        attachAfter: '#main_panel',
        title: html,
        accept: 'Pegar',
        refuse: 'Cancelar',
        acceptStyle: 'red',
        refuseStyle: 'gray',
        acceptAction: function(){
          //Crear arreglo con posts seleccionados
          var selected = [];
          $('div#clipboard input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
              selected.push($(this).attr('value'));
            }
          });
          paste_post_to_contacts(selected, group_id);
        }
      });
      $.showDialog();
      $(".multiselect").multiselect();
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });     
}

function btn_paste_catalog_to_category(category_id)
{
  //Obtener posts del clipboard
  $.ajax({
    url: '/clipboards/catalogs',
    type: 'get',
    dataType: 'json',
    success: function(data) {
      //Crear ventana modal
      var html = "<div id='clipboard' class='multiselect'>";
      data.rows.forEach(function (catalog) {
        html = html + "<div><label><input type='checkbox' name='option[]' value="+catalog.id+" />"+catalog.name+"</label></div>";
      });
      html = html + "</div>";
      $.createDialog({
        attachAfter: '#main_panel',
        title: html,
        accept: 'Pegar',
        refuse: 'Cancelar',
        acceptStyle: 'red',
        refuseStyle: 'gray',
        acceptAction: function(){
          //Crear arreglo con posts seleccionados
          var selected = [];
          $('div#clipboard input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
              selected.push($(this).attr('value'));
            }
          });
          paste_catalog_to_category(selected, category_id);
        }
      });
      $.showDialog();
      $(".multiselect").multiselect();
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });   
}

function paste_post_to_catalog(selected, catalog_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {selected:selected, catalog_id:catalog_id};
  $.ajax({
    type: 'post',
    url: '/clipboards/paste/post',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El catálogo fue actualizado");
        location.reload();
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

function paste_catalog_to_category(selected, category_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {selected:selected, category_id:category_id};
  $.ajax({
    type: 'post',
    url: '/clipboards/paste/catalog',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","La página fue actualizada");
        location.reload();
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

function paste_post_to_contacts(selected, group_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {selected:selected, group_id:group_id};
  $.ajax({
    type: 'post',
    url: '/clipboards/paste/contact',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","Los contactos fueron actualizados");
        location.reload();
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

//*****************************************************************
// DELETE OPERATIONS
//*****************************************************************

function btn_delete_catalog_from_category(catalog_id, category_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar este catalogo de la categoría?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_catalog_from_category(catalog_id,category_id);
    }
  });
  $.showDialog();
}

function btn_delete_catalog_from_created_catalogs(catalog_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar este catálogo?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_catalog_from_created_catalogs(catalog_id);
    }
  });
  $.showDialog();  
}

function btn_delete_post_from_catalog(post_id, catalog_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar este post del catálogo?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_catalog(post_id,catalog_id);
    }
  });
  $.showDialog();  
}

function btn_delete_post_from_created_posts(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar este post?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_created_posts(post_id);
    }
  });
  $.showDialog();  
}

function btn_delete_post_from_created_pages(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar esta página?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_created_pages(post_id);
    }
  });
  $.showDialog();
}

function btn_delete_post_from_subscription(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar esta subscripción?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_subscription(post_id);
    }
  });
  $.showDialog();  
}

function btn_delete_post_from_contacts(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar este contacto?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_contacts(post_id);
    }
  });
  $.showDialog();
}

function btn_delete_post_from_contacts_group(post_id, group_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea eliminar este contacto?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_contacts_group(post_id,group_id);
    }
  });
  $.showDialog();
}

function delete_catalog_from_category(catalog_id,category_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/catalogs/'+category_id+'/'+catalog_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El catálogo fue eliminado.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el catálogo no fue eliminado. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
} 

function delete_catalog_from_created_catalogs(catalog_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/catalogs/'+catalog_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El catálogo fue eliminado.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else
      {
        set_message("error","Lo sentimos pero el catálogo no fue eliminado. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
} 

function delete_post_from_catalog(post_id,catalog_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/posts/'+catalog_id+'/'+post_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El post fue eliminado.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el post no fue eliminado. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function delete_post_from_created_posts(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/posts/'+post_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El post fue eliminado.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el post no fue eliminado. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function delete_post_from_created_pages(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/pages/'+post_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","La página fue eliminada.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero la página no fue eliminada. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function delete_post_from_subscription(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/subscriptions/'+post_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","La subscripción fue eliminada.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero la subscripción no fue eliminada. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function delete_post_from_contacts(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/contacts/'+post_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El contacto fue eliminado.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el contacto no fue eliminado. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function delete_post_from_contacts_group(post_id,group_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/contacts/group/'+post_id+'/'+group_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","El contacto fue eliminado de la lista.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Lo sentimos pero el contacto no fue eliminado de la lista. Intente de nuevo");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}
//*****************************************************************
// LIKES UP & DOWN 
//*****************************************************************

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

//*****************************************************************
// Generales
//*****************************************************************

function replaceAll(str,x,y)
{
  var regex = new RegExp(x, "g");
  return(str.replace(regex, y)); 
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
