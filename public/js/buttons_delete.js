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


// FUNCTIONS

function btn_delete_catalog_from_category(catalog_id, category_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: 'Are you sure you want to delete this catalog?',
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
    title: 'Are you sure you want to delete this catalog?',
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
    title: 'Are you sure you want to delete this post from the catalog?',
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
    title: 'Are you sure you want to delete this post?',
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
    title: 'Are you sure you want to delete this page?',
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
    title: 'Are you sure you want to unsubscribe?',
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
    title: 'Are you sure you want delete this contact?',
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
    title: 'Are you sure you want delete this contact?',
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
        set_message("notice","The catalog was deleted.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Sorry but the catalog was not deleted. Try again, please.");
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
        set_message("notice","The catalog was deleted.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else
      {
        set_message("error","Sorry but the catalog was not deleted. Try again, please.");
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
        set_message("notice","The post was deleted.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Sorry but the post was not deleted. Try again, please.");
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
        set_message("notice","The post was not deleted.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Sorry but the post was not deleted. Try again, please.");
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
        set_message("notice","The page was deleted.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Sorry but the page was not deleted. Try again, please.");
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
        set_message("notice","The subscription was deleted.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Sorry but the subscription was not deleted. Try again, please.");
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
        set_message("notice","The contact was deleted.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Sorry but the contact was not deleted. Try again, please.");
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
        set_message("notice","The contact was deleted from the list.");
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error","Sorry but the contact was not deleted from the list. Try again, please.");
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}


