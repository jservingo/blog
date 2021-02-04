 <table id="dg" title="Audios" class="easyui-datagrid" 
			url="/audios/get/{{ $post->id }}"     
			toolbar="#toolbar" pagination="true" nowrap="false"
			rownumbers="true" fitColumns="true" singleSelect="true"
			pageSize="10" method="get">
		<thead>
			<tr>
				<th field="position" width="8" sortable="true">Position</th>
				<th field="description" width="46" sortable="true">Description</th>
				<th field="url" width="46" sortable="true">URL</th>				
			</tr>
		</thead>
	</table>

	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="createRegister()">Add</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="updateRegister()">Edit</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteRegister()">Delete</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:94%;height:200px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Audios</div>
		<form id="fm" method="post" novalidate enctype='multipart/form-data'>
			<div class="fitem">
				<label>Position</label>
				<input type="number" id="position" name="position" style="width:60px">
			</div>
			<div class="fitem">
				<label>Description:</label>
				<input id="description" name="description" class="easyui-validatebox" required="true" style="width:320px">
			</div>			
			<div class="fitem">
				<label>Upload audio:</label>
				<input id="audio" name="audio" type="file">
			</div>
		</form>
	</div>

	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveRegister({{ $post->id }})">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>