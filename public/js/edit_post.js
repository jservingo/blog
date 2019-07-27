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
  var published_at = $('#published_at').val();
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
        set_message("notice","{{ $msg_update }}");
        window.opener.location.reload();
        window.close();
      }
      else {
        set_message("error","Sorry but the update was not possible. Try again, please");
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

if($('.dropzone').length)
{     
  var myDropzone = new Dropzone('.dropzone',{
    url: '/admin/posts/{{ $post->id }}/photos',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    acceptedFiles: 'image/*',
    paramName: 'photo',
    maxFileSize: 2,
    maxFiles:8,
    dictDefaultMessage: 'Drag the photos here to upload'
  });

  Dropzone.autoDiscover = false;

  myDropzone.on("addedfile", function(file) {
    console.log(file);
    //alert("Ver consola");
  });

  myDropzone.on('error', function(file, res) {
    var msg = res.errors.photo[0];
    $('.dz-error-message:last > span').text(msg);
  });
}

$('.btn_cancel_edit').bind('click', function(e){
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