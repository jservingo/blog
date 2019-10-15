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

function set_view(view,root)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = {view:view,root:root};
  $.ajax({
    type: 'post',
    url: '/view',
    data: data,
    dataType: 'json',
    success: function(data) {
      //alert("set_message OK");
      location.reload();
    },
    error: function (data) {
      console.log('Error:', data);
      //alert("set_message ERROR. Ver consola");
      location.reload();
    }
  }); 
}

function replaceAll(str,x,y)
{
  var regex = new RegExp(x, "g");
  return(str.replace(regex, y)); 
}

function get_month(f)
{
  var meses = new Array ("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
  return (meses[f.getMonth()]);  
}

function get_type(type)
{
  switch(type)
  {
    case 1:
      return "PhotoGallery";
    case 2:
      return "Frame";
    case 3:
      return "Text";
    case 4:
      return "Notification";
    case 5:
      return "Web page";
    case 6:
      return "Alert";
    case 7:
      return "Offer";
    case 8:
      return "App post";
    case 21:
      return "Catalog";
    case 22:
      return "Page";
    case 23:
      return "App";
    case 24:
      return "User";
    case 25:
      return "Company";     
  }
}
