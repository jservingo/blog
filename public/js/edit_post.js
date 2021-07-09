//Date picker
/*
$('#datepicker').datepicker({
  autoclose: true
});

//Initialize Select2 Elements
$(".select2").select2();
*/

$('.btn_update_post').bind('click', function(e){
  e.preventDefault();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var post_id = $(this).data("id");
  var type_id = $(this).data("type");
  var kpost = $(this).data("kpost");    
  var type = get_type(type_id);
  var title = $('#title').val();
  var excerpt = $('#excerpt').val();
  if (! excerpt)
    excerpt = "Empty excerpt"; 
  else
    excerpt = excerpt.replace(/['"]+/g, '').replace(/<[^>]+>/g, ''); 
  var body = CKEDITOR.instances.body.getData();
  if (! body)
    body = "Empty content";
  var url = "";
  if (type=="Web page")
    url = $('#url').val();
  var iframe = "";
  if (type=="Frame")
    iframe = $('#iframe').val();
  var observation = $('#observation').val();
  var footnote = $('#footnote').val();
  var featured = get_value('#featured');
  var hide = get_value('#hide');
  var order_num = $('#order_num').val();
  var d = $('#published_at').val();
  var date = new Date(d);
  published_at = fdateTimeSaveUTC(date);
  var tags = $('#tags').val();
  var rating_mode = $('#rating_mode').val();
  var cstr_privacy = get_value('#cstr_privacy');
  var cstr_restricted = get_value('#cstr_restricted');
  var cstr_allow_comments = get_value('#cstr_allow_comments');
  var cstr_colaborative = 0;
  if (type=="Catalog" || type=="Page")
    cstr_colaborative = get_value('#cstr_colaborative');
  var cstr_allow_subscribers = 0;
  var cstr_show_subscribers = 0;
  var cstr_main_page = 0;
  if (type=="Page")
  {
    cstr_allow_subscribers = get_value('#cstr_allow_subscribers');
    cstr_show_subscribers = get_value('#cstr_show_subscribers');
    cstr_main_page = get_value('#cstr_main_page');
  }
  var data = {
    post_id: post_id,
    type_id: type_id,
    kpost: kpost,
    title: title,
    excerpt: excerpt,
    body: body,
    url: url,
    iframe: iframe,
    observation: observation,
    footnote: footnote,
    published_at: published_at,
    tags: tags,
    rating_mode: rating_mode,
    featured: featured,
    hide: hide,
    order_num: order_num,
    cstr_privacy: cstr_privacy,
    cstr_restricted: cstr_restricted,
    cstr_allow_comments: cstr_allow_comments,
    cstr_colaborative: cstr_colaborative,
    cstr_allow_subscribers: cstr_allow_subscribers,
    cstr_show_subscribers: cstr_show_subscribers,
    cstr_main_page: cstr_main_page
  };
  $.ajax({
    type: 'put',
    url: '/post/'+post_id,
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice",msg_the_changes_were_saved);
        window.opener.location.reload();
        window.close();
      }
      else {
        set_message("error", msg_the_post_was_not_updated);
        window.opener.location.reload();
        window.close();
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
});

CKEDITOR.replace('body');

CKEDITOR.config.height = 220;

$('.btn_cancel_edit').bind('click', function(e){
  window.close();
});

function get_value(s)
{
  if ($(s).is(':checked'))
    return(1);
  return(0);
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