<?php
  use_javascript(SF_DEBUG ? '/ttDms/jsTree/jquery.tree.js' : '/ttDms/jsTree/jquery.tree.min.js');
  use_javascript('/ttDms/jsTree/plugins/jquery.tree.contextmenu.js');
  //use_javascript('/ttDms/jsTree/lib/jquery.cookie.js');²
  //use_javascript('/ttDms/jsTree/plugins/jquery.tree.cookie.js');
?>

<?php
if(! function_exists('__'))
  \Misc::use_helper('I18N');
?>

<script>
  jQuery(document).ready(function($)
  {
    $("#<?php echo $id; ?>").tree({
      rules: {
        'valid-children': 'root'
      },
      types: {
        // all node types inherit the "default" node type
        'default': {
          deletable: true,
          renameable: true
        },
        'root': {
          deletable: false,
          renameable: false,
          draggable: false
        },
        'folder':
        {
          'valid-children': 'folder'
        }
      },
      data  : {
        type  : "json",
        async : true,
        opts  : {
          method: 'POST',
          url: '<?php echo url_for('ttDmsBrowser/jsonTree'); ?>'
          //static: <?php echo $json_data; ?> 
        }
      },
      selected: 'node_<?php echo $node->getId(); ?>',
      cookies : {prefix: 'pageTree', open: true, selected: false, opts: {path: '/'}},
      //cookies: true,
      ui : {
        dots: false,
        animation: 300,
        theme_name: 'classic'
      },
      plugins: {
        /* cookie: {
          prefix: 'ttBrowserTree',
          types: {
            open: true,
          },
          keep_selected: true,
          keep_opened: true
        }, */
        "contextmenu": {
          items : {
            open: {
              label   : "<?php echo __('Download'); ?>", 
              icon    : "<?php echo image_path("/ttDms/images/icons/diskette_16.gif"); ?>",
              visible : function (NODE, TREE_OBJ) {return true;}, 
              action  : treeDownload,
              separator_after : true
            }
          }
        }
      },
      callback: 
      {
        onrename: treeRename, 
        // enkel folders droppen in folders (geen reorder)
        beforemove: function(NODE, REF_NODE, TYPE, TREE_OBJ) {return (TYPE == 'inside'); },
        onmove: treeMove,
        onselect: treeClick,
        ondrop: treeDrop,
        ondelete: treeDelete,
        oncreate: treeCreate,
  			// Take care of refresh calls - n will be false only when the whole tree is refreshed or loaded of the first time
  			// Make sure static is not used once the tree has loaded for the first time
  			beforedata : function (node, tree)
        { 
          // initial load
  				if (node == false)
          {
            tree.settings.data.opts.static = <?php echo $json_data; ?>;
          } 
          // async load
  				else
          {
            tree.settings.data.opts.static = false;
            return {node_id: $(node).attr('node_id')};
          } 
  			}
      }
    });
  });

  /**
   * Rename a page node
   */  
	function treeRename(node, tree, rollbackObject)
	{
    jQuery.ajax({
      type: 'POST',
      dataType: "json",
      url: '<?php echo url_for('ttDmsBrowser/jsonNodeRename'); ?>',
      data: {
        node_id: jQuery(node).attr('node_id'),
        new_name: tree.get_text(node)
      },
      success: function(data)
      {
        if (! data.success)
        {
          jQuery.tree.rollback(rollbackObject);
          jQuery.tt.alert('<?php echo __("Error");?>', "<?php echo __('De folder kon niet hernoemd worden') . '.\n ' . __('Error');?>: " + data.message);
        }
      },
      error : function(XMLHttpRequest, textStatus, errorThrown)
      {
        jQuery.tree.rollback(rollbackObject);
        jQuery.tt.alert('<?php echo __("Error");?>', "<?php echo __('De folder kon niet hernoemd worden') . '.\n ' . __('Error');?>: " + (textStatus ? textStatus : errorThrown));
      }
    });
	}
	
	/**
	 * Delete a page node from the tree
	 */
	function treeDelete(node, tree_obj, rollbackObject)
  {
    jQuery.tt.confirm('<?php echo __("Bent u zeker dat u wenst te verwijderen?");?>', '', function(value, dialog)
    {
      if (value)
      {
        jQuery.post(
          '<?php echo url_for('ttDmsBrowser/jsonNodeDelete'); ?>',
          {
            node_id: jQuery(node).attr('node_id')
          },
          function(data)
          {
            if (! data.success)
            {
              if (rollbackObject) jQuery.tree.rollback(rollbackObject);
              jQuery.tt.alert('<?php echo __("Error");?>', '<?php echo __("Het object kon niet verwijderd worden") . ". " . __("Error");?>: ' + data.message);
            }
          },
          "json"
        );
      }
    });
    
    return false;
  }
	
  /**
   * Move a page node (to another node or to the trashbin)
   */  
	function treeMove(node, ref_node, type, tree_obj, rollbackObject)
	{
    // if move to trashcan : perform delete, else move
    if (jQuery(ref_node).attr('nodeid') == 'trashcan')
    {
      performDelete(node, tree_obj, rollbackObject);
    }
    else
    {
	    jQuery.post(
        '<?php echo url_for('ttDmsBrowser/jsonNodeMove'); ?>',
        {
          node_id: jQuery(node).attr('node_id'),
          target_id: jQuery(ref_node).attr('node_id'),
          type: type
        },
        function(data)
        {
          if (! data.success)
          {
            if (rollbackObject) jQuery.tree.rollback(rollbackObject);
            jQuery.tt.alert('<?php echo __("Error");?>', '<?php echo __("De file of folder kon niet verwijderd worden") . ". " . __("Error");?>: ' + data.message);
          }
        },
        "json"
      );
      
    }
	}

  /**
   * Create a page node (at another node)
   */  
	function treeCreate(node, ref_node, type, tree_obj, rollbackObject)
	{
    jQuery.post(
      '<?php echo url_for('ttDmsBrowser/jsonNodeCreate'); ?>',
      {
        target_id: jQuery(ref_node).attr('node_id'),
        type: type,
        name: tree_obj.get_text(node)
      },
      function(data)
      {
        if (! data.success)
        {
          if (rollbackObject) jQuery.tree.rollback(rollbackObject);
          jQuery.tt.alert('<?php echo __("Error");?>', '<?php echo __("De file of folder kon niet verwijderd worden") . ". " . __("Error");?>: ' + data.message);
        }
        else
        {
          jQuery(node).attr('node_id', data.node_id);
        }
      },
      "json"
    );
	}


  /**
   * Move a file (to another node or to the trashbin)
   */  
	function treeDrop(file, ref_node, type, tree_obj)
	{
    //console.log('treeDrop', file, ref_node, type, tree_obj);

    // if move to trashcan : perform delete, else move
    if (jQuery(ref_node).attr('nodeid') == 'trashcan')
    {
      performDelete(file, tree_obj, rollbackObject);
    }
    else
    {
	    jQuery.post(
        '<?php echo url_for('ttDmsBrowser/onFileMove'); ?>',
        {
          source: jQuery(file).attr('file'),
          target: jQuery(ref_node).attr('folder'),
          type: type
        },
        function(data)
        {
          //console.log(data);
          
          if (! data.success)
          {
            jQuery.tt.alert('<?php echo __("Error");?>', '<?php echo __("De file of folder kon niet verwijderd worden") . ". " . __("Error");?>: ' + data.message);
          }
          else
          {
            // interface update depends on type of filelist (images or plain list)
            if (jQuery(file).parents('div.imagelist').size())
            {
              jQuery(file).remove();
            }
            else
            {
              jQuery(file).parents('tr:first').remove();
            }
          }
        },
        "json"
      );
      
    }
	}

  /**
   * Folder click: open node
   */
  function treeClick(node, tree_obj)
  {
    node_id = jQuery(node).attr('node_id');
    
    if (node_id)
    {
      loadNode(jQuery(node).attr('node_id'));
    }  
  }

  /**
   * Download folder
   */
  function treeDownload(node, tree_obj)
  {
    node_id = jQuery(node).attr('node_id');
    
    if (node_id)
    {
      url = "<?php echo url_for('ttDmsBrowser/download?folder_id=999&recursive=1');?>";
      url = url.replace('999', jQuery(node).attr('node_id'));
      document.location = url;
    }
  }


</script>

<div class="ttDmsFileTree" id="<?php echo $id; ?>"></div>
