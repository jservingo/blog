var audio_url; 
var audio_id;

function createRegister(){
	$('#dlg').dialog('open').dialog('setTitle','Agregar');
	$('#fm').form('clear');
	audio_url = 'create';
}

function updateRegister(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg').dialog('open').dialog('setTitle','Editar');
		$('#fm').form('load',row);
		audio_url = 'update';
		audio_id = row.id;
	}
}

function saveRegister(post_id){					
	if (audio_url=='create')
	{
		url = $('#url').val();
		position = $('#position').val();		
		description = $('#description').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var form = $('#fm')[0];
    var data = new FormData(form);
    $.ajax({
      type: 'post',
      enctype: 'multipart/form-data',
      url: '/audio/'+post_id,
      data: data,
      processData: false,  // Important!
      contentType: false,
      cache: false,      
      success: function(data) {
        if (data.success){
          $('#dlg').dialog('close');		// close the dialog
					$('#dg').datagrid('reload');	// reload the data
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
	else if (audio_url=='update')
	{
		url = $('#url').val();
		position = $('#position').val();		
		description = $('#description').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var data = {url:url,position:position,description:description};
    $.ajax({
	    type: 'put',
	    url: '/audio/'+audio_id,
	    data: data,
	    dataType: 'json',
	    success: function(data) {
	      if (data.success){
	        $('#dlg').dialog('close');		// close the dialog
					$('#dg').datagrid('reload');	// reload the data
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
}

function deleteRegister(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	  });
	  $.ajax({
	    type: 'delete',
	    url: '/audios/'+row.id,
	    dataType: 'json',
	    success: function(data) {
	      if (data.success){
	        $('#dg').datagrid('reload');	// reload the data
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
}

function doSearch(){  
    $('#dg').datagrid('load',{  
        ejecutivo: $('#ejecutivo').val()  
    });  
}

$(function(){
	$('#dg').datagrid({  
    	onDblClickRow:function(){  
        	updateRegister();
    	}  
	});
});