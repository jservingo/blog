$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
var data = {
  type_id: rv_type_id, 
  post_id: rv_post_id,
  ref_id: rv_ref_id 
};
$.ajax({
  type: 'post',
  url: '/recent_views',
  data: data,
  dataType: 'json',
  success: function(data) {
    if (data.success){
      //$.growl.warning({ message:'save_recent_views.js' });
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
