// ADD USER, ADD SUBSCRIPTION SAVE & DISCARD POST

//Event Delegation
$('.app-posts').on("click",".btn_save_app_post", function(e){
  var app_id = $(this).data("id");
  var title = $(this).data("title");
  var excerpt = $(this).data("excerpt");
  var img = $(this).data("img");
  var tags = $(this).data("tags");
  var links = $(this).data("links");
  var footnote = $(this).data("footnote");
  var date = $(this).data("date");
  var user = $(this).data("user");
  var source = $(this).data("source");
  var custom_type = $(this).data("custom_type");
  btn_save_app_post(app_id, title, excerpt, img, tags, links, footnote, date, user, source, custom_type); 
}); 

$('.btn_add_subscription').bind('click', function(e){
  var post_id = $(this).data("id");
  btn_add_subscription(post_id);
});

$('.btn_allocate_app').bind('click', function(e){
  var post_id = $(this).data("id");
  var app_id = $(this).data("app_id");
  btn_allocate_app(post_id,app_id);
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

function btn_save_app_post(app_id, title, excerpt, img, tags, links, footnote, date, user, source, custom_type)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: want_to_save_this_post,
    accept: yes,
    refuse: no,
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      save_app_post(app_id, title, excerpt, img, tags, links, footnote, date, user, source, custom_type);
    }
  });
  $.showDialog();  
}

function btn_add_subscription(post_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: want_to_subscribe,
    accept: yes,
    refuse: no,
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      add_subscription(post_id);
    }
  });
  $.showDialog();  
}

function btn_allocate_app(post_id,app_id)
{
  var app = prompt("Enter app id",app_id.toString());
  if (app != null) {
    var app_id = parseInt(app);
    allocate_app(post_id, app_id)
  }
}

function btn_add_user_to_contacts(user_id)
{
  $.createDialog({
    attachAfter: '#main_panel',
    title: want_to_add_this_user_to_your_contacts,
    accept: yes,
    refuse: no,
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
    title: want_to_save_this_post,
    accept: yes,
    refuse: no,
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
    title: want_to_discard_this_post,
    accept: yes,
    refuse: no,
    acceptStyle: 'red',
    refuseStyle: 'gray',
    acceptAction: function(){
      discard_post(post_id);
    }
  });
  $.showDialog();  
}

function save_app_post(app_id, title, excerpt, img, tags, links, footnote, date, user, source, custom_type, callback="")
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
    links: links, 
    footnote: footnote, 
    date: date, 
    user: user, 
    source: source, 
    custom_type: custom_type
  };
  $.ajax({
    type: 'post',
    url: '/apps/post',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        if (typeof callback === 'function')
        {
          set_message("notice",the_post_was_saved);
          return callback(data);                  
        }
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",the_post_was_not_saved);
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
        set_message("notice",the_subscription_was_successful);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",the_subscription_has_failed);
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  }); 
}

function allocate_app(post_id, app_id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {post_id: post_id, app_id: app_id};
  $.ajax({
    type: 'post',
    url: '/page/allocate',
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice",the_subscription_was_successful);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",the_subscription_has_failed);
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
        set_message("notice",the_user_was_added_to_your_contacts);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",the_user_was_not_added_to_your_contacts);
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
        set_message("notice",the_post_was_saved);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",the_post_was_not_saved);
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
        set_message("notice",the_post_was_discarded);
        location.reload();
      }
      else if(data.msg)
      {
        $.growl.warning({ message:data.msg });
      }
      else {
        set_message("error",the_post_was_not_discarded);
        location.reload();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });   
}

