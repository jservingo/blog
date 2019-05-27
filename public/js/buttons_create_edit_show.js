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

// FUNCTIONS

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
      //var ref_id = $(this).data("id");  OJO QUITAR ESTO
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
