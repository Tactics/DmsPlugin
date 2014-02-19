<?php
/**
 * nodeList component (dit is geen partial !) 
 */
?>

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
              loadNode(<?php echo $node->getId(); ?>);
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
          loadNode(<?php echo $node->getId(); ?>);
        }
      },
      error: function()
      {
        jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het verwijderen van het bestand. <p><pre>404 Not Found</pre></p>', {className: 'error'});
      }
    });
  });
}

function showNodeDetails(node_id)
{
  var showNodeDetail = $('#showNodeDetail');
  if (! showNodeDetail.size())
  {
    $('body').append($('<div id="showNodeDetail"><' + '/div>')); // fix voor validator dom parser (closing div tag)
    showNodeDetail = $('#showNodeDetail');
  }

  showNodeDetail.load('<?php echo url_for('ttDmsBrowser/show'); ?>?node_id='+node_id);
  showNodeDetail.tt_window({width: '750px', top: 100});
}

function closeNodeDetails()
{
  $('#showNodeDetail').tt_window().close();
}
</script>

<?php
$table = new myTable(
  array(
    array('text' => checkbox_tag('multiCheck', '', 0, array('onclick' => 'multiCheck(this);', 'class' => 'multiCheck')), 'width' => 16),
    array('name' => DmsNodePeer::NAME, 'text' => 'Naam', 'sortable' => true),
    array('name' => DmsNodePeer::CREATED_AT, 'text' => 'Datum', 'width' => 110, 'sortable' => true),
    array('text' => 'Type', 'width' => 120),
    array('text' => 'Grootte', 'width' => 80, 'align' => 'right'),
    array('text' => 'Acties', 'width' => 60, 'align' => 'center')
  ),
  array(
    'class' => 'ttDmsFileList',
    "sortfield"  => $orderBy,
    "sortorder"  => $orderAsc ? "ASC" : "DESC",
    "sorturi"    => 'ttDmsBrowser/ajaxNodeList?node_id=' . $node->getId(),
    "sorttarget" => 'nodeList',
  )
);

foreach($nodes as $subnode)
{
  if ($options['showFolders'] && $subnode->getIsFolder())
  {
    $table->addRow(array(
      '',
      link_to(image_tag('/ttDms/images/icons/folder_16.gif', array('valign' => 'middle')) . ' ' . $subnode->getName(), 'ttDmsBrowser/browse?node_id=' . $subnode->getId()),
      format_date($subnode->getCreatedAt(), 'g'),
      'Folder',
      '',
      ''
    ));
  }
}

foreach($nodes as $subnode)
{
  // controle of bestand gevonden kan worden in de storage
  $storage = $subnode->getDmsStore()->getStorage();
  if (!$storage->exists($subnode->getStoragePath()))
  {    
    $errorTdAttributes= array('style' => 'color: red; background-color:pink');
    
    $table->addRow(array(
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
      array('content' => $subnode->getName(), 'tdAttributes' => $errorTdAttributes),
      array('content' => format_date($subnode->getCreatedAt(), 'g'), 'tdAttributes' => $errorTdAttributes),      
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
    ), array('style' => 'white-space: nowrap;')
    );
    
    continue;
  }
  
  if (! $subnode->getIsFolder())
  {  
    $table->addRow(array(
      checkbox_tag('nodes[]', $subnode->getId(), false),
      image_tag(filetype_image_path($subnode->getExtension()), array('style' => 'width:16px; vertical-align: -20%;', 'title' => $subnode->getMimeType())) . ' ' . $subnode->getName(),
      format_date($subnode->getCreatedAt(), 'g'),
      $subnode->getMimeType(),
      format_filesize($subnode->getSize()),
      link_to(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'ttDmsBrowser/download?node_id=' . $subnode->getId())
        . link_to_function(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'deleteNode(' . $subnode->getId() . ');')
        . link_to_function(image_tag('/ttDms/images/icons/document_zoom_16.gif', array('title' => 'Details')), 'showNodeDetails(' . $subnode->getId() . ');')
    ), array('style' => 'white-space: nowrap'));
  }
}

echo $table;
?>
Met geselecteerde:
<?php echo link_to_function(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'multiActie("delete")'); ?>
<?php echo link_to_function(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'multiActie("download")'); ?>


