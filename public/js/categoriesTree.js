$(function() {
  $('#categories_tree').jstree({
    'core' : {
      'data' : {
        "url" : "/categories/tree/"+page_id,
        "dataType" : "json"                         
      },
      'check_callback' : true,
      'themes': { "dots": false, "icons": false }
    },
    'state' : { "key" : "categories_tree" },
    'plugins' : [ "themes", "json_data", "ui", "state", "contextmenu" ],
    'contextmenu' : {items: context_menu}        
  });

  $("#categories_tree").on('restore_state.jstree', function () {
    $("#categories_tree").bind("select_node.jstree", function (event, data) {
      console.log(data);
      var node_id = data.node.id;
      location.href = '/pages/'+page_id+'/'+node_id;
    });
    if (reset_categories_tree)
      $("#categories_tree").jstree("deselect_all");
  });  

	$('#categories_tree').bind('create_node.jstree',function (event, data) {
	  $.ajaxSetup({
			headers: {
  		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var dtx = { 
			'id' : data.node.parent, 
			'position' : data.position, 
			'text' : data.node.text, 
			'page_id' : page_id
		};
		$.ajax({ type: 'post', url: '/categories/create',
	    data: dtx, dataType: 'json',
	    success: function(d) {
	    	data.instance.set_id(data.node, d.id);	
	    },
	    error: function (d) {
	      data.instance.refresh();
	    }
		});	
	});

	$('#categories_tree').bind('rename_node.jstree',function (event, data) {
	  $.ajaxSetup({
			headers: {
  		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var dtx = { 'id' : data.node.id, 'text' : data.node.text };
		$.ajax({ type: 'post', url: '/categories/rename',
	    data: dtx, dataType: 'json',
	    error: function (d) {
	      data.instance.refresh();
	    }
		});	
	});

	$('#categories_tree').bind('delete_node.jstree',function (event, data) {
	  $.ajaxSetup({
			headers: {
  		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var dtx = { 'id' : data.node.id };
		$.ajax({ type: 'post', url: '/categories/delete',
	    data: dtx, dataType: 'json',
	    success: function(d) {
	      if(d.success)
        {
          $.growl.notice({ message: "The category was deleted." });
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

  // handle doule click on node
  /*
	$("#categories_tree").bind("dblclick.jstree", function (event, data) {
    var node = $(event.target).closest("li");
    var node_id = node[0].id; 
    location.href = '/pages/'+page_id+'/'+node_id;
	});
  */
});

function context_menu(node){
	var tree = $('#categories_tree').jstree(true);
	// The default set of all items
    var items = {
        "Create": {
            "separator_before": false,
            "separator_after": false,
            "label": "Create category",
            "action": function (data) { 
            	  var ref = $.jstree.reference(data.reference);
                sel = ref.get_selected();
                sel = ref.create_node(sel, 'category', 'after');
                if(sel) {
                  ref.edit(sel);
                }
            }
        },
        "Create child": {
            "separator_before": false,
            "separator_after": false,
            "label": "Create subcategory",
            "action": function (data) { 
            	  var ref = $.jstree.reference(data.reference);
                sel = ref.get_selected();
                if(!sel.length) { return false; }
                sel = sel[0];
                sel = ref.create_node(sel, 'category');
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
            	if(confirm('Are you sure to remove this category?')){
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
