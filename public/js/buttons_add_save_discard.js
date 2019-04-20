// ADD USER, ADD SUBSCRIPTION SAVE & DISCARD POST

$('.app-posts').on("click",".btn_save_app_post", function(){
  var app_id = $(this).data("id");
  var title = $('#t-title').text();
  var excerpt = $('#t-excerpt').text();
  var img = $('#t-img').attr("src");
  var tags = $('#t-tags').text();
  var footnote = $('#t-footnote').text();
  var date = $('#t-date').text();
  var user = $('#t-user').text();
  var source = $(this).data("source");
  var custom_type = $(this).data("custom_type");
  alert("click: "+title);
  btn_save_app_post(app_id, title, excerpt, img, tags, footnote, date, user, source, custom_type); 
});

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

// FUNCTIONS

function btn_save_app_post(app_id, title, excerpt, img, tags, footnote, date, user, source, custom_type)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Está seguro que desea guardar este post?',
    accept: 'Si',
    refuse: 'No',
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      save_app_post(app_id, title, excerpt, img, tags, footnote, date, user, source, custom_type);
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

function save_app_post(app_id, title, excerpt, img, tags, footnote, date, user, source, custom_type)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {
    app_id: app_id, 
    title: title, 
    excerpt: excerpt, 
    img: img, 
    tags: tags, 
    footnote: footnote, 
    date: date, 
    user: user, 
    source: source, 
    custom_type: custom_type
  };
  console.log(data);
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

