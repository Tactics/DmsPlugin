<?php
  //use_javascript('http://cdn.jquerytools.org/1.1.2/jquery.tools.min.js');
  use_javascript('/ttBase/ui/js/dialog.js');
  use_stylesheet('/ttBase/ui/js/dialog.css');
  use_javascript('/ttDms/js/ajaxupload.js');
?>
<table style="width: <?php echo $options['width']; ?>">
<tr>
  <td style="vertical-align:top; width: <?php echo $options['list_width']; ?>;">
    <h2 class="pageblock">Folders</h2>
    <div class="pageblock" style="overflow: auto;">
      <?php include_component('ttDmsBrowser', 'nodeTree', array('node' => $node)); ?>
    </div>

    <?php if ($options['upload_enabled']): ?>
      <input type="button" id="upload_button" value="Upload" />
      <div id="upload_status"></div>
      
      <script>
      jQuery(function($){
        var upload = new AjaxUpload('upload_button', {
          // Location of the server-side upload script
          // NOTE: You are not allowed to upload files to another domain
          action: '<?php echo url_for('ttDmsBrowser/upload'); ?>',
          // File upload name
          name: 'file',
          // Submit file after selection
          autoSubmit: true,
          // The type of data that you're expecting back from the server.
          // HTML (text) and XML are detected automatically.
          // Useful when you are using JSON data as a response, set to "json" in that case.
          // Also set server response type to text/html, otherwise it will not work in IE6
          responseType: false,
          // Fired after the file is selected
          // Useful when autoSubmit is disabled
          // You can return false to cancel upload
          // @param file basename of uploaded file
          // @param extension of that file
          onChange: function(file, extension){},
          // Fired before the file is uploaded
          // You can return false to cancel upload
          // @param file basename of uploaded file
          // @param extension of that file
          onSubmit: function(file, extension)
          {
            this.setData({node_id : jQuery.tree.reference("#nodeTree").selected.attr("node_id")});
            $('#upload_status').text('Bezig met verzenden...');
            
          },
          // Fired when file upload is completed
          // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
          // @param file basename of uploaded file
          // @param response server response
          onComplete: function(file, response) {
            loadNode(jQuery.tree.reference("#nodeTree").selected.attr("node_id"))
            $('#upload_status').text('Verzenden voltooid.');
          }
        });
      });
      </script>
    <?php endif; ?>
  </td>
  <td style="vertical-align:top;">
    <h2 class="pageblock">
      <?php //include_partial('ttDmsBrowser/nodeTrail', array('store' => $store, 'node' => isset($node) ? $node : null))?>
      Bestanden
    </h2>
    <div class="pageblock" id="nodeList">
      <?php include_component('ttDmsBrowser', 'nodeList', array('node' => $node)); ?>
    </div>
  </td>  
</tr>
</table>

