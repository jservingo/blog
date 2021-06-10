var audio_url; 
var audio_id;

function createRegister(){
	$('#dlg').dialog('open').dialog('setTitle',msg_add);
	$('#fm').form('clear');
	audio_url = 'create';
}

function updateRegister(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg').dialog('open').dialog('setTitle',msg_edit);
		$('#fm').form('load',row);
		audio_url = 'update';
		audio_id = row.id;
	}
}

function saveRegister(post_id){	
	if (audio_url=='create')
	{		
		var position = $('#position').val();		
		var description = $('#description').val();
		var data = {position: position, description: description};
		console.log(post_id);
		console.log(position);
		console.log(description);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
    	url: '/audio/'+post_id,
    	type: 'POST',
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
	else if (audio_url=='update')
	{
		var position = $('#position').val();		
		var description = $('#description').val();
		var data = {position: position, description: description};	
		console.log(post_id);
		console.log(audio_id);
		console.log(position);
		console.log(description);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
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
	  $.createDialog({
	    attachAfter: '#main-container',
	    title: msg_want_to_delete_this_audio,
	    accept: msg_yes,
	    refuse: msg_no,
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
		$('#dlg_upload').dialog('open').dialog('setTitle',msg_upload_audio);
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

function blink_text() {
    $('.blink').fadeOut(1000);
    $('.blink').fadeIn(1000);
}

$(function(){
	$('#dg').datagrid({  
    	onDblClickRow:function(){  
        	updateRegister();
    	}  
	});

  $('#btn_upload_audio').bind('click', function(e){
    $("#loading_audio").show();
    setInterval(blink_text, 2000);
  });
});