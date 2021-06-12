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

$('.app-posts').on("click",".btn_copy_app_post", function(e){
  e.preventDefault();
  var app_id = $(this).data("id");
  var title = $(this).data("title");
  var source = $(this).data("source");
  btn_copy_app_post(app_id,title,source);
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

$('.btn_send_post').bind('click', function(e){
  e.preventDefault();
  var post_id = $(this).data("id");
  btn_send_post(post_id);
});

$('.btn_send_message').bind('click', function(e){
  e.preventDefault();
  var user_id = $(this).data("id");
  btn_send_message(user_id);
});

// FUNCTIONS

function btn_copy_app_post(app_id,title,source)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {app_id:app_id, title:title, source:source};
  $.ajax({
    type: 'post',
    url: '/clipboards/copy/app/post',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        $.growl.notice({ message: msg_the_post_was_added_to_the_clipboard });
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
        $.growl.notice({ message: msg_the_catalog_was_added_to_the_clipboard });
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
        $.growl.notice({ message: msg_the_post_was_added_to_the_clipboard });
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
      var zcolor="#d5fcfd";
      data.rows.forEach(function (post) {
        var type = "Post";
        type = get_type(post.type_id);
        html = html + "<div style='padding:8px; background-color:";
        html = html + zcolor + "'><label style='margin:0'>";
        html = html + "<input type='checkbox' name='option[]' value=" + post.id;
        html = html + " />&nbsp;&nbsp;&nbsp;&nbsp;";
        html = html + type + " - " + post.title;
        html = html + "</label></div>";
        if (zcolor=="#d5fcfd")
          zcolor="#cee3ea";
        else
          zcolor="#d5fcfd";
      });
      html = html + "</div>";
      $.createDialog({
        attachAfter: '#main_panel',
        title: html,
        accept: msg_paste,
        refuse: msg_cancel,
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
      var zcolor="#f0f69a";
      data.rows.forEach(function (post) {
        //html = html + "<div><label><input type='checkbox' name='option[]' value="+post.id+" />"+post.title+"</label></div>";
        html = html + "<div style='padding:8px; background-color:";
        html = html + zcolor + "'><label style='margin:0'>";
        html = html + "<input type='checkbox' name='option[]' value=" + post.id;
        html = html + " />&nbsp;&nbsp;&nbsp;&nbsp;";
        html = html + post.title;
        html = html + "</label></div>";
        if (zcolor=="#f0f69a")
          zcolor="#cee3ea";
        else
          zcolor="#f0f69a";
      });
      html = html + "</div>";
      $.createDialog({
        attachAfter: '#main_panel',
        title: html,
        accept: msg_paste,
        refuse: msg_cancel,
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
      var zcolor="#f0f69a";
      data.rows.forEach(function (catalog) {
        //html = html + "<div><label><input type='checkbox' name='option[]' value="+catalog.id+" />"+catalog.name+"</label></div>";
        html = html + "<div style='padding:8px; background-color:";
        html = html + zcolor + "'><label style='margin:0'>";
        html = html + "<input type='checkbox' name='option[]' value=" + catalog.id;
        html = html + " />&nbsp;&nbsp;&nbsp;&nbsp;";
        html = html + catalog.name;
        html = html + "</label></div>";
        if (zcolor=="#f0f69a")
          zcolor="#cee3ea";
        else
          zcolor="#f0f69a";
      });
      html = html + "</div>";
      $.createDialog({
        attachAfter: '#main_panel',
        title: html,
        accept: msg_paste,
        refuse: msg_cancel,
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
        set_message("notice", msg_the_catalog_was_updated);
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
        set_message("notice", msg_the_page_was_updated);
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
        set_message("notice", msg_your_contacts_were_updated);
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

function btn_send_post(post_id)
{
  //Obtener contactos
  $.ajax({
    url: '/contacts/get',
    type: 'get',
    dataType: 'json',
    success: function(data) {
      //Crear ventana modal
      var html = "<div id='clipboard' class='multiselect'>";
      var zcolor="#d5fcfd";
      data.forEach(function (contact) {
        var type = "Post";
        html = html + "<div style='padding:8px; background-color:";
        html = html + zcolor + "'><label style='margin:0'>";
        html = html + "<input type='checkbox' name='option[]' value=" + contact.id;
        html = html + " />&nbsp;&nbsp;&nbsp;&nbsp;";
        html = html + contact.name;
        html = html + "</label></div>";
        if (zcolor=="#d5fcfd")
          zcolor="#cee3ea";
        else
          zcolor="#d5fcfd";
      });
      html = html + "</div>";
      $.createDialog({
        attachAfter: '#main_panel',
        title: html,
        accept: send,
        refuse: msg_cancel,
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
          send_post_to_contacts(selected, post_id); 
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

function send_post_to_contacts(selected, post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {selected:selected, post_id:post_id};
  $.ajax({
    type: 'post',
    url: '/contacts/send/post',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        $.growl.notice({ message: msg_the_post_was_sent});
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

function btn_send_message(user_id)
{
  //Crear ventana modal
  var html = "<div id='edit'>";
  html = html + "<h3>"+msg_send_message+"</h3>";
  html = html + "<p>"+msg_title+"</p>";
  html = html + "<input id='title' type='text' style='width:500px;' class='form-control' placeholder='"+msg_enter_message+"' required>";
  html = html + "</div>";
  $.createDialog({
    attachAfter: '#main_panel',
    title: html,
    accept: msg_create,
    refuse: msg_cancel,
    acceptStyle: 'blue',
    refuseStyle: 'red',
    acceptAction: function(){
      title = $('#title').val();
      type_id = 3;
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      //var ref_id = $(this).data("id");  OJO QUITAR ESTO
      var data = {type_id:type_id, title:title, user_id:user_id };
      $.ajax({
        type: 'post',
        url: 'contacts/send/message',
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