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

// FUNCTIONS

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
        set_message("notice","The catalog was updated.");
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
        set_message("notice","The page was updated.");
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
        set_message("notice","Your contacts were updated.");
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

