<?php
/**
 * nodeList component (dit is geen partial !) 
 */
?>

<?php use_stylesheet('/ttDms/css/filelist.css'); ?>
<?php use_helper('Dms'); ?>

<script>
function loadNode(node_id)
{
  jQuery('#nodeList').load(
    '<?php echo url_for('ttDmsBrowser/ajaxNodeList'); ?>',
    {node_id: node_id}
  );
}

function multiCheck(multiCheck)
{
  allesGeselecteerd = true;
  nietsGeselecteerd = true;
  
  checkboxes = jQuery(multiCheck).parents('.ttDmsFileList').find(':checkbox:not(.multiCheck)');
  
  checkboxes.each(function()
  {
    if (jQuery(this).attr('checked'))
    {
      nietsGeselecteerd = false;
    }
    else
    {
      allesGeselecteerd = false;
    }
  });
  
  if (allesGeselecteerd)
  {
    checkboxes.attr('checked', false);
    jQuery(multiCheck).attr('checked', false);
  }
  else
  {  
    checkboxes.attr('checked', true);
    jQuery(multiCheck).attr('checked', true);
  }
}

function multiActie(actie)
{
  checkboxes = "";
  cnt = 0;
  
  jQuery('.ttDmsFileList').find(':checkbox:not(.multiCheck):checked').each(function()
  {
    checkboxes += jQuery(this).val() + ',';
    cnt++;
  });
  
  if (! checkboxes)
  {
    jQuery.tt.alert('Geen bestanden geselecteerd.', 'Selecteer één of meerdere bestanden via het aanvinkvakje voor de bestandsnaam.');
    return;
  }
  
  switch(actie)
  {
    case 'delete':
      jQuery.tt.confirm('Bestanden verwijderen', 'Bent u zeker dat deze ' + cnt + ' bestanden wilt verwijderen?', function(value)
      {
        if (! value) return;
        
        jQuery.ajax({
          url: '<?php echo url_for('ttDmsBrowser/jsonNodeDelete'); ?>',
          dataType: 'json',
          data: {node_ids: checkboxes},
          success: function (data)
          {
            if (! data.success)
            {
              jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het verwijderen van bestanden. <p><pre>' + data.message + '</pre></p>');
            }
            else
            {
              loadNode(<?php echo $folder->getId(); ?>);
            }
          },
          error: function()
          {
            jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het verwijderen van de bestanden. <p><pre>404 Not Found</pre></p>', {className: 'error'});
          }
        });  
      });

      break;
    case 'download':
      input = "<input name='node_ids' value='" + checkboxes + "'/>";
      jQuery('<form action="<?php echo url_for('ttDmsBrowser/download'); ?>" method="post">'+input+'</form>')
		  .appendTo('body').submit().remove();

      break;
  }
}

function deleteNode(node_id)
{
  jQuery.tt.confirm('Bestand verwijderen', 'Bent u zeker dat dit bestand wilt verwijderen?', function(value)
  {
    if (! value) return;
    jQuery.ajax({
      url: '<?php echo url_for('ttDmsBrowser/jsonNodeDelete'); ?>',
      dataType: 'json',
      data: {node_ids: node_id},
      success: function (data)
      {
        if (! data.success)
        {
          jQuery.tt.alert('Probleem bij het verwijderen van bestand. <br/><br/><i>' + data.message + '</i>');
        }
        else
        {
          loadNode(<?php echo $folder->getId(); ?>);
        }
      },
      error: function()
      {
        jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het verwijderen van het bestand. <p><pre>404 Not Found</pre></p>', {className: 'error'});
      }
    });
  });
}

</script>

<table class="ttDmsFileList">
  <thead>
  <tr>
    <td width="16px;"><?php echo checkbox_tag('multiCheck', '', 0, array('onclick' => 'multiCheck(this);', 'class' => 'multiCheck')); ?></td>
    <td width="250px;">Naam</td>
    <td>Datum</td>
    <td>Type</td>
    <td>Grootte</td>
    <td>Acties</td>
  </tr>
</thead>
<tbody>
<?php foreach($nodes as $subnode): ?>
  <?php if ($options['showFolders'] && $subnode->getIsFolder()): ?>
  <tr>
    <td>&nbsp;</td>
    <td>
      <?php
      echo link_to(image_tag('/ttDms/images/icons/folder_16.gif', array('valign' => 'middle')) . ' ' . $subnode->getName(), 'ttDmsBrowser/browse?node_id=' . $subnode->getId());
      ?>
    </td>
    <td>
      <?php echo format_date($subnode->getCreatedAt(), 'g'); ?>
    </td>
    <td>Folder</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php endif; ?>
<?php endforeach; ?>

<?php foreach($nodes as $subnode): ?>
  <?php if (! $subnode->getIsFolder()): ?>
    <tr>
      <td><?php echo checkbox_tag('nodes[]', $subnode->getId(), false); ?></td>
      <td>
        <?php
          echo image_tag(filetype_image_path($subnode->getExtension()), array('style' => 'vertical-align: -20%;', 'title' => $subnode->getMimeType()));
          echo ' ';
        
          echo $subnode->getName();
        ?>
      </td>
      <td>
        <?php echo format_date($subnode->getCreatedAt(), 'g'); ?>
      </td>
      <td><?php echo $subnode->getMimeType(); ?></td>
      <td><?php echo format_filesize($subnode->getSize()); ?></td>
      <td>
        <?php echo link_to(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'ttDmsBrowser/download?node_ids=' . $subnode->getId()); ?>
        <?php echo link_to_function(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'deleteNode(' . $subnode->getId() . ');'); ?>
        <?php echo link_to(image_tag('/ttDms/images/icons/document_zoom_16.gif', array('title' => 'Details')), 'ttDmsBrowser/show?node_id=' . $subnode->getId()); ?>
      </td>
    </tr>
  <?php endif; ?>
<?php endforeach; ?>
</tbody>
</table>
Met geselecteerde:
<?php echo link_to_function(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'multiActie("delete")'); ?>
<?php echo link_to_function(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'multiActie("download")'); ?>


