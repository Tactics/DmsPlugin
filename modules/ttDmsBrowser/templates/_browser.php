<?php
  use_javascript('http://cdn.jquerytools.org/1.1.2/jquery.tools.min.js');
  use_javascript('/ttBase/ui/js/dialog.js');
  use_stylesheet('/ttBase/ui/js/dialog.css');
?>
<table>
<tr>
  <td style="vertical-align:top; width: 250px;">
    <h2 class="pageblock">Folders</h2>
    <div class="pageblock" style="overflow: auto;">
      <?php include_component('ttDmsBrowser', 'nodeTree', array('root' => isset($node) ? $node : $store)); ?>
    </div>

    <h2 class="pageblock">Upload</h2>
    <div class="pageblock">
    <?php echo form_tag('ttDmsBrowser/upload', array('multipart' => true)); ?>
      <?php echo input_hidden_tag('store_id', $store->getId()); ?>
      <?php echo input_hidden_tag('node_id', isset($node) ? $node->getId() : ''); ?>
      Bestand: <?php echo input_file_tag('file'); ?>
      <input type="button" id="doUpload" value="Upload"/>
    </form>
    </div>
  </td>
  <td style="vertical-align:top;">
    <h2 class="pageblock">
      <?php include_partial('ttDmsBrowser/nodeTrail', array('store' => $store, 'node' => isset($node) ? $node : null))?>
    </h2>
    <div class="pageblock" id="nodeList">
      <?php include_component('ttDmsBrowser', 'nodeList', array('folder' => $store ? $store : $node, 'nodes' => $nodes)); ?>
    </div>
  </td>  
</tr>
</table>

<script>
jQuery('#doUpload').click(function()
{
  jQuery(this)
    .parents("form:first")
    .find("[name=node_id]")
    .val(jQuery.tree.reference("#nodeTree").selected.attr("node_id"))
    .parents("form:first")
    .submit();
    ;
});
</script>
