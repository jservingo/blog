// DELETE OPERATIONS

$('#posts_container').on('click', '.btn_delete_app_post', function(e) {
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("post");
  var app_id = $(this).data("id");
  var title = $(this).data("title");
  var source = $(this).data("source");
  if (app_id == 4)
  {
    //Todos los posts de LastFm estan creados
    btn_delete_post_artist(post_id);
  }
  else
  {
    if (post_id != 0) 
      btn_delete_post_from_created_posts(post_id);
    else
      btn_delete_app_post(app_id,title,source);
  }
});

$('.btn_delete_catalog_from_category').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var catalog_id = $(this).data("id");
  var category_id = $(this).data("category");
  btn_delete_catalog_from_category(catalog_id, category_id);
});

$('.btn_delete_catalog_from_created_catalogs').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var catalog_id = $(this).data("id");
  btn_delete_catalog_from_created_catalogs(catalog_id);
});

$('.btn_delete_post_from_catalog').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("id");
  var catalog_id = $(this).data("catalog");
  btn_delete_post_from_catalog(post_id, catalog_id);
});

$('.btn_delete_app_subs').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("id");
  btn_delete_app_subs(post_id);
});

$('.btn_delete_post_from_created_posts').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("id");
  btn_delete_post_from_created_posts(post_id);
});

$('.btn_delete_post_from_created_pages').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("id");
  btn_delete_post_from_created_pages(post_id);
});

$('.btn_delete_post_from_subscription').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("id");
  btn_delete_post_from_subscription(post_id);
});

$('.btn_delete_post_from_contacts').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("id");
  btn_delete_post_from_contacts(post_id);
});

$('.btn_delete_post_from_contacts_group').bind('click', function(e){
  e.preventDefault();
  if (!assert("user logged in")) return;
  var post_id = $(this).data("id");
  var group_id = $(this).data("group");
  btn_delete_post_from_contacts_group(post_id, group_id);
});

// FUNCTIONS

function btn_delete_catalog_from_category(catalog_id, category_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: msg_want_to_delete_this_catalog,
    accept: msg_yes,
    refuse: msg_no,
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
    title: msg_want_to_delete_this_catalog,
    accept: msg_yes,
    refuse: msg_no,
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
    title: msg_want_to_delete_this_post_from_the_catalog,
    accept: msg_yes,
    refuse: msg_no,
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_catalog(post_id,catalog_id);
    }
  });
  $.showDialog();  
}

function btn_delete_app_subs(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: msg_want_to_delete_this_app,
    accept: msg_yes,
    refuse: msg_no,
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_app_subs(post_id);
    }
  });
  $.showDialog();  
}

function btn_delete_app_post(app_id,title,source)
{
  $.ajax({
    url: '/app/get/post',
    data: {app_id:app_id, title:title, source:source},
    dataType: 'json',
    success: function(data) {
      if (data.success)
        btn_delete_post_from_created_posts(data.post_id);
      else
        $.growl.warning({ message: msg_you_are_not_authorized_to_delete_the_post });
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}

function btn_delete_post_from_created_posts(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: msg_want_to_delete_this_post,
    accept: msg_yes,
    refuse: msg_no,
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
    title: msg_want_to_delete_this_page,
    accept: msg_yes,
    refuse: msg_no,
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
    title: msg_want_to_unsubscribe,
    accept: msg_yes,
    refuse: msg_no,
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
    title: msg_want_delete_this_contact,
    accept: msg_yes,
    refuse: msg_no,
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
    title: msg_want_delete_this_contact,
    accept: msg_yes,
    refuse: msg_no,
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_from_contacts_group(post_id,group_id);
    }
  });
  $.showDialog();
}

function btn_delete_post_artist(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: msg_want_to_delete_this_post,
    accept: msg_yes,
    refuse: msg_no,
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      delete_post_artist(post_id);
    }
  });
  $.showDialog();
}

//************************************************************************

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
        set_message("notice",msg_the_catalog_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_catalog_was_not_deleted);
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
        set_message("notice",msg_the_catalog_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else
      {
        set_message("error",msg_the_catalog_was_not_deleted);
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
        set_message("notice",msg_the_post_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_post_was_not_deleted);
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
        set_message("notice",msg_the_post_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_post_was_not_deleted);
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function delete_app_subs(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/apps/'+post_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice",msg_the_app_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_app_was_not_deleted);
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
        set_message("notice",msg_the_page_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_page_was_not_deleted);
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
        set_message("notice",msg_the_subscription_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_subscription_was_not_deleted);
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
        set_message("notice",msg_the_contact_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_contact_was_not_deleted);
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
        set_message("notice",msg_the_contact_was_deleted_from_the_list);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_contact_was_not_deleted_from_the_list);
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function delete_post_artist(post_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/artists/'+post_id,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice",msg_the_post_was_deleted);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",msg_the_post_was_not_deleted);
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}


