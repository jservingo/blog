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

//Convertir fecha UTC en string local
function fdateLocal(date)
{
  //var date = new Date(d.getTime() + timezoneOffset * 1000);
  if (lang=='en')
  {
    return date.toLocaleString('en-US',
      {"year":"2-digit","month":"numeric","day":"numeric"});

  }
  else if (lang=='es')
  {
    return date.toLocaleString('es-ES',
      {"year":"2-digit","month":"numeric","day":"numeric"});
  }
}

//Convertir fecha y hora UTC en string local
function fdateTimeLocal(date)
{
  //var date = new Date(d.getTime() + timezoneOffset * 1000);
  if (lang=='en')
  {
    return date.toLocaleString('en-US', 
      {'year':'numeric', 'month':'2-digit', 'day':'2-digit', 'hour':'2-digit', 'minute':'2-digit' });

  }
  else if (lang=='es')
  {
    return date.toLocaleString('es-ES', 
      {'year':'numeric', 'month':'2-digit', 'day':'2-digit', 'hour':'2-digit', 'minute':'2-digit' });
  }   
}

//Convertir fecha y hora en string local para poder editar
function fdateTimeEditLocal(d)
{
  var date = new Date(d.getTime());
  var yyyy = date.getFullYear().toString();                                    
  var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based         
  var dd  = date.getDate().toString();  
  var hh = date.getHours().toString();
  var ii = date.getMinutes().toString();
  var ss = date.getSeconds().toString(); 
  var fdate = yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]) + ' ' + (hh[1]?hh:"0"+hh[0]) + ':' + (ii[1]?ii:"0"+ii[0]) + ':' + (ss[1]?ss:"0"+ss[0]);
  return fdate;
}

//Convertir fecha y hora local en UTC en string para guardar en BD
function fdateTimeSaveUTC(d)
{
  var date = new Date(d.getTime() - timezoneOffset * 1000);
  //console.log(d.getTime());
  //console.log(timezoneOffset);
  //console.log(date);
  //date =  new Date(Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), d.getUTCDate(), d.getUTCHours(), d.getUTCMinutes(), d.getUTCSeconds()));
  //console.log(date);
  var yyyy = date.getFullYear().toString();                                    
  var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based         
  var dd  = date.getDate().toString();  
  var hh = date.getHours().toString();
  var ii = date.getMinutes().toString();
  var ss = date.getSeconds().toString(); 
  var fdate = yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]) + ' ' + (hh[1]?hh:"0"+hh[0]) + ':' + (ii[1]?ii:"0"+ii[0]) + ':' + (ss[1]?ss:"0"+ss[0]);
  return fdate;
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
    case 9:
      return "Message";
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
