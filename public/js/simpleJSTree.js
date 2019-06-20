        $(function () {

            var jsondata = [
                           { "id": "ajson1", "parent": "#", "text": "Simple root node" },
                           { "id": "ajson2", "parent": "#", "text": "Root node 2" },
                           { "id": "ajson3", "parent": "ajson2", "text": "Child 1" },
                           { "id": "ajson4", "parent": "ajson2", "text": "Child 2" },
            ];

            createJSTree(jsondata);
        });

        function createJSTree(jsondata) {
            $('#SimpleJSTree').jstree({
                "core": {
                    "check_callback": true,
                    'data': jsondata
                    
                },
                "plugins": ["contextmenu"],
                "contextmenu": {
                    "items": function ($node) {
                        var tree = $("#SimpleJSTree").jstree(true);
                        return {
                            "Create": {
                                "separator_before": false,
                                "separator_after": true,
                                "label": "Create",
                                "action": false,
                                "submenu": {
                                    "File": {
                                        "seperator_before": false,
                                        "seperator_after": false,
                                        "label": "File",
                                        action: function (obj) {
                                            $node = tree.create_node($node, { text: 'New File', type: 'file', icon: 'glyphicon glyphicon-file' });
                                            tree.deselect_all();
                                            tree.select_node($node);
                                        }
                                    },
                                    "Folder": {
                                        "seperator_before": false,
                                        "seperator_after": false,
                                        "label": "Folder",
                                        action: function (obj) {
                                            $node = tree.create_node($node, { text: 'New Folder', type: 'default' });
                                            tree.deselect_all();
                                            tree.select_node($node);
                                        }
                                    }
                                }
                            },
                            "Rename": {
                                "separator_before": false,
                                "separator_after": false,
                                "label": "Rename",
                                "action": function (obj) {
                                    tree.edit($node);                                    
                                }
                            },
                            "Remove": {
                                "separator_before": false,
                                "separator_after": false,
                                "label": "Remove",
                                "action": function (obj) {
                                    tree.delete_node($node);
                                }
                            }
                        };
                    }
                }
            });
        }