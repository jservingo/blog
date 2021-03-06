	<table id="dg" title="Audios" class="easyui-datagrid" 
			url="/audios/get/{{ $post->id }}"     
			toolbar="#toolbar" pagination="true" nowrap="false"
			rownumbers="true" fitColumns="true" singleSelect="true"
			pageSize="10" method="get">
		<thead>
			<tr>
				<th field="position" width="8" sortable="true">{{ __('messages.position') }}</th>
				<th field="description" width="46" sortable="true">{{ __('messages.description') }}</th>
				<th field="url" width="46" sortable="true">{{ __('messages.url') }}</th>				
			</tr>
		</thead>
	</table>

	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="createRegister()">{{ __('messages.add') }}</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="updateRegister()">{{ __('messages.edit') }}</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteRegister()">{{ __('messages.delete') }}</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-upload" plain="true" onclick="uploadFile()">{{ __('messages.upload') }}</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:94%;height:200px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<form id="fm" method="post">
			<div class="fitem">
				<label>{{ __('messages.position') }}:</label>
				<input type="number" id="position" name="position" style="width:60px">
			</div>
			<div class="fitem">
				<label>{{ __('messages.description') }}:</label>
				<input id="description" name="description" class="easyui-validatebox" required="true" style="width:320px">
			</div>	
		</form>	
	</div>

	<div id="dlg_upload" class="easyui-dialog" style="width:94%;height:230px;padding:10px 20px"
			closed="true" buttons="#dlg-upload-buttons">
		<form id="faudio" method="post" action="{{ route('audio.upload') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input id="audio_id" name="audio_id" type="hidden">			
			<h3>{{ __('messages.audio') }}: <span id="description_upload">Description</span></h3>
			<input id="audio" name="audio" type="file">
			<input type='submit' name='submit' id="btn_upload_audio" value="{{ __('messages.upload') }}">
		</form>
		<br>
		<div id="loading_audio" class="blink" style="margin:0 auto; display:none;">
			<span style="font-weight:800;">{{ __('messages.please-wait-loading') }}.</span>
		</div>
	</div>

	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveRegister({{ $post->id }})">{{ __('messages.save') }}</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">{{ __('messages.cancel') }}</a>
	</div>

	<div id="dlg-upload-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_upload').dialog('close')">{{ __('messages.cancel') }}</a>
	</div>