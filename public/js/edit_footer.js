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
  var excerpt = $('#excerpt').val();
  excerpt = excerpt.replace(/['"]+/g, '').replace(/<[^>]+>/g, '');
  var observation = $('#observation').val();;
  var footnote = $('#footnote').val();
  var featured = get_value('#featured');
  var data = {
    post_id: post_id,
    type_id: type_id,
    excerpt: excerpt,
    observation: observation,
    footnote: footnote,
    featured: featured,
  };
  $.ajax({
    type: 'put',
    url: '/post/footer/'+post_id,
    data: data,
    dataType: 'json',
    success: function(data) {
      if (data.success){
        set_message("notice","The changes where saved.");
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

$('.btn_update_post').bind('click', function(e){
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
