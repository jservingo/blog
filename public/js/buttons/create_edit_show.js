// CREATE, EDIT & SHOW

$('.btn_create_catalog_from_category').bind('click', function(e){
  var category_id = $(this).data("id");
  btn_create_catalog_from_category(category_id);
}); 

$('.btn_create_catalog').bind('click', function(e){
  btn_create_catalog();
}); 

$('.btn_create_app').bind('click', function(e){
  $.growl.warning({ message: not_implemented });
}); 

$('.btn_create_page').bind('click', function(e){
  btn_create_page();
}); 

$('.btn_create_post').bind('click', function(e){
  btn_create_post(0);
});	

$('.btn_create_post_from_catalog').bind('click', function(e){
  var catalog_id = $(this).data("id");
  btn_create_post(catalog_id);
}); 

$('.btn_edit_post').bind('click', function(e){
  var post_id = $(this).data("id");
  //url = "/post/"+post_id;
  btn_edit ("post", post_id);
});

$('.btn_edit_catalog').bind('click', function(e){
  var catalog_id = $(this).data("id");
  //var url = "/catalog/"+catalog_id;
  btn_edit ("catalog", catalog_id);
});

$('.btn_edit_page').bind('click', function(e){
  var page_id = $(this).data("id");
  //var url = "/page/"+page_id;
  btn_edit ("page", page_id);
});

$('.btn_show_post').bind('click', function(e){
  var post_id = $(this).data("id");
  //url = "/posts/"+post_id;
  btn_show (url);
});

$('.btn_show_page_subscribers').bind('click', function(e){
  var page_id = $(this).data("id");
  location = "/page/subscribers/"+page_id;
});

$('.btn_show_app_subscribers').bind('click', function(e){
  var app_id = $(this).data("id");
  location = "/app/subscribers/"+app_id;
});

// FUNCTIONS

function btn_create_catalog_from_category(category_id)
{
  //Crear ventana modal
  var html = "<div id='edit'>";
  html = html + "<h3>"+create_catalog+"</h3>";
  html = html + "<p>"+title+"</p>";
  html = html + "<input id='title' type='text' style='width:95%;' class='form-control' placeholder='"+enter_catalog+"' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: create,
    refuse: cancel,
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
            url = "/post/"+data.post_id;
            btn_edit ("post", data.post_id);
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
  html = html + "<h3>"+create_catalog+"</h3>";
  html = html + "<p>"+title+"</p>";
  html = html + "<input id='title' type='text' style='width:95%;' class='form-control' placeholder='"+enter_catalog+"' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: create,
    refuse: cancel,
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
            url = "/post/"+data.post_id;
            btn_edit ("post", data.post_id);
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
  html = html + "<h3>"+create_page+"</h3>";
  html = html + "<p>"+title+"</p>";
  html = html + "<input id='title' type='text' style='width:95%;' class='form-control' placeholder='"+enter_page+"' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: create,
    refuse: cancel,
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
            url = "/post/"+data.post_id;
            btn_edit ("post", data.post_id);
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

function btn_create_post(catalog_id)
{
  //Crear ventana modal
  var html = "<div id='edit'>";
  html = html + "<h3>"+create_post+"</h3>";
  html = html + "<p>"+type+"</p>";
  html = html + "<select id='type'>";
  html = html + "<option value='3'>"+type_text+"</option>";
  html = html + "<option value='5'>"+type_web_page+"</option>";
  html = html + "<option value='1'>"+type_photo_gallery+"</option>";
  html = html + "<option value='2'>"+type_frame+"</option>";
  html = html + "<option value='4'>"+type_notification+"</option>";
  html = html + "<option value='6'>"+type_alert+"</option>";
  html = html + "<option value='7'>"+type_offer+"</option>";      
  html = html + "</select>";
  html = html + "<p>"+title+"</p>";
  html = html + "<input id='title' type='text' style='width:95%;' class='form-control' placeholder='"+enter_post+"' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: create,
    refuse: cancel,
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
      //var ref_id = $(this).data("id");  OJO QUITAR ESTO
      var data = {type_id:type_id, title:title, catalog_id:catalog_id};
      $.ajax({
        type: 'post',
        url: '/post',
        data: data,
        dataType: 'json',
        success: function(data) {
          if (data.success){
            url = "/post/"+data.post_id;
            btn_edit ("post", data.post_id);
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

function btn_edit(el, id)
{
  url = '/'+el+'/isOwner/'+id;
  $.ajax({
      url: url,
      dataType: 'json',
      success: function(data) {
        if (data.response=="Y")
        {
          url = '/'+el+'/'+id;
          edit_post(url);
        }
        else
        {
          if (el=="post")
          {
            //url = '/'+el+'/footer/'+id;
            edit_footer(el, id);
          }  
          else
            $.growl.warning({ message: you_are_not_authorized_to_edit_the_post });
        }  
      },
      error: function (data) {
        console.log('Error:', data);
      }
    }); 
}

function edit_footer(el, id)
{
  url = '/'+el+'/isSaved/'+id;
  $.ajax({
      url: url,
      dataType: 'json',
      success: function(data) {
        if (data.response=="Y")
        {
          url = '/'+el+'/footer/'+id;
          edit_post(url);
        }
        else
        {
          $.growl.warning({ message: you_are_not_authorized_to_edit_the_post });
        }  
      },
      error: function (data) {
        console.log('Error:', data);
      }
    }); 
}

function edit_post(url)
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
