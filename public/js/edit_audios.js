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
		var audio = $('#audio')[0].files[0];
		var position = $('#position').val();		
		var description = $('#description').val();
		var url = $('#url').val();
		var data = new FormData();
		data.append('audio', audio);
		data.append('position', position);
		data.append('description', description);
		data.append('url', url);
		console.log(post_id);
		console.log(audio);
		console.log(position);
		console.log(description);
		console.log(url);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
    	url: '/audio/'+post_id,
    	type: 'POST',
    	contentType: false,
      data: data,
      processData: false,
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
		var audio = $('#audio')[0].files[0];
		var position = $('#position').val();		
		var description = $('#description').val();
		var url = $('#url').val();
		var data = new FormData();
		data.append('audio', audio);
		data.append('position', position);
		data.append('description', description);
		data.append('url', url);	
		console.log(post_id);
		console.log(audio_id);
		console.log(audio);
		console.log(position);
		console.log(description);
		console.log(url);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
	    type: 'put',
	    url: '/audio/'+audio_id,
	    contentType: false,
      data: data,
      processData: false,
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
}

function deleteRegister(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
	  $.createDialog({
	    attachAfter: '#main-container',
	    title: '¿Está seguro que desea eliminar este audio?',
	    accept: yes,
	    refuse: no,
	    acceptStyle: 'red',
	    refuseStyle: 'gray',
	    acceptAction: function(){
	      deleteAudio(row.id);
	    }
	  });
	  $.showDialog();  
	} 
}

function deleteAudio(audio_id){
	$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    url: '/audios/'+audio_id,
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

function uploadFile(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg_upload').dialog('open').dialog('setTitle','Upload File');
		//console.log(row);
		$("#description_upload").html(row.description);
		$('#audio_id').val(row.id);
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