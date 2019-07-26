$(function() {  
  $('#contacts_tree').jstree({
    'core' : {
      'data' : {
        "url" : "/contacts/tree/",
        "dataType" : "json"                         
      },
      'check_callback' : true,
      'themes': { "dots": false, "icons": false }
    },
    'state' : { "key" : "contacts_tree" },
    'plugins' : [ "themes", "json_data", "ui", "state", "contextmenu" ],
    'contextmenu' : {items: context_menu}        
  });

  $("#contacts_tree").on('restore_state.jstree', function () {
    $("#contacts_tree").bind("select_node.jstree", function (event, data) {
      console.log(data);
      var node_id = data.node.id;
      if (node_id==0)
        location.href = '/contacts';
      else
        location.href = '/contacts/'+node_id;
    });
    if (reset_contacts_tree)
      $("#contacts_tree").jstree("deselect_all");
  });

  /*
  $('#contacts_tree').bind("loaded.jstree", function (e, data) {
    if (reset_contacts_tree)
    {
      //$('#contacts_tree').jstree(true).refresh(true, true);
      //$("#contacts_tree").jstree("refresh");
      //$("#contacts_tree").jstree("deselect_all");
      //$('#contacts_tree').jstree("clear_state");
      $('#contacts_tree').jstree(true).select_node('0',true,true);
      //alert("reset_contacts_tree");
      //console.log(data);
    }
  });
  */

  $('#contacts_tree').bind('create_node.jstree',function (event, data) {
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var dtx = { 
      'id' : data.node.parent, 
      'position' : data.position, 
      'text' : data.node.text
    };
    $.ajax({ type: 'post', url: '/contacts/create',
      data: dtx, dataType: 'json',
      success: function(d) {
        data.instance.set_id(data.node, d.id);  
      },
      error: function (d) {
        data.instance.refresh();
      }
    }); 
  });

  $('#contacts_tree').bind('rename_node.jstree',function (event, data) {
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var dtx = { 'id' : data.node.id, 'text' : data.node.text };
    $.ajax({ type: 'post', url: '/contacts/rename',
      data: dtx, dataType: 'json',
      error: function (d) {
        data.instance.refresh();
      }
    }); 
  });

  $('#contacts_tree').bind('delete_node.jstree',function (event, data) {
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var dtx = { 'id' : data.node.id };
    $.ajax({ type: 'post', url: '/contacts/delete',
      data: dtx, dataType: 'json',
      success: function(d) {
        if(d.success)
        {
          $.growl.notice({ message: "The list was deleted." });
        }
        else
        {
          $.growl.warning({ message: d.msg });
          data.instance.refresh();
        }
      },
      error: function (d) {
        data.instance.refresh();
      }
    });       
  });

  // handle double click on node
  /*
  $("#contacts_tree").bind("dblclick.jstree", function (event, data) {
    var node = $(event.target).closest("li");
    var node_id = node[0].id; 
    if (node_id==0)
      location.href = '/contacts';
    else
      location.href = '/contacts/'+node_id;
  });
  */ 
});

function context_menu(node){
  var tree = $('#contacts_tree').jstree(true);
  // The default set of all items
    var items = {
        "Create": {
            "separator_before": false,
            "separator_after": false,
            "label": "Create list",
            "action": function (data) { 
                var ref = $.jstree.reference(data.reference);
                sel = ref.get_selected();
                sel = ref.create_node(sel, 'list', 'after');
                if(sel) {
                  ref.edit(sel);
                }
            }
        },
        "Create child": {
            "separator_before": false,
            "separator_after": false,
            "label": "Create sublist",
            "action": function (data) { 
                var ref = $.jstree.reference(data.reference);
                sel = ref.get_selected();
                if(!sel.length) { return false; }
                sel = sel[0];
                sel = ref.create_node(sel, 'list');
                if(sel) {
                  ref.edit(sel);
                }
            }
        },
        "Rename": {
            "separator_before": false,
            "separator_after": false,
            "label": "Rename",
            "action": function (data) { 
                var inst = $.jstree.reference(data.reference);
                obj = inst.get_node(data.reference);
                inst.edit(obj);
            }
        },                        
        "Remove": {
            "separator_before": true,
            "separator_after": false,
            "label": "Delete",
            "action": function (data) { 
              if(confirm('Are you sure to remove this contact?')){
                var ref = $.jstree.reference(data.reference),
                  sel = ref.get_selected();
                  if(!sel.length) { return false; }
                  ref.delete_node(sel);
              }
            }
        },
        "Expand" : {
            "separator_before": true,
            "separator_after": false,
            "label": "Expand",
            "action": function (data) { 
              $("#contacts_tree").jstree("open_all");
            }
        },
        "Collapse" : {
            "separator_before": true,
            "separator_after": false,
            "label": "Collapse",
            "action": function (data) { 
              $("#contacts_tree").jstree("close_all");
              $("#contacts_tree").jstree("select_node", "#node_0", true);
            }
        }
    };
    return items;
}  
