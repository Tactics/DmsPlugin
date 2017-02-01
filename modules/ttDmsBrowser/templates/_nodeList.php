<header>
  <h2 class="pageblock">Bestanden</h2>
</header>
<div>
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
    {node_id: node_id,
     options: <?php echo json_encode($options); ?>}
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
      jQuery('<form action="<?php echo url_for('ttDmsBrowser/download'); ?>" method="post" class="smart-form">'+input+'</form>')
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

$headers = array(
  array('text' => checkbox_tag('multiCheck', '', 0, array('onclick' => 'multiCheck(this);', 'class' => 'multiCheck')), 'width' => 16),
  array('name' => DmsNodePeer::NAME, 'text' => 'Naam', 'sortable' => true),
  array('name' => DmsNodePeer::CREATED_AT, 'text' => 'Datum', 'width' => 110, 'sortable' => true));

if ($options['showType'] && ($options['showType'] !== 'false'))
{
  $headers[] = array('text' => 'Type', 'width' => 120);
}
if ($options['showAnnotations'] && ($options['showAnnotations'] !== 'false'))
{
  $headers[] = array('text' => 'Annotaties');
}

$headers = array_merge($headers, array(array('text' => 'Grootte', 'width' => 80, 'align' => 'right', 'sortable' => true), array('text' => 'Acties', 'width' => 60, 'align' => 'center')));

$table = new myTable(
  $headers,
  array(
    'class' => 'ttDmsFileList',
    "sortfield"  => $orderBy,
    "sortorder"  => $orderAsc ? "ASC" : "DESC",
    "sorturi"    => 'ttDmsBrowser/ajaxNodeList?node_id=' . $node->getId() . '&showType='.$options['showType'].'&showAnnotations='.$options['showAnnotations'],
    "sorttarget" => 'nodeList',
    "smartadmin" => sfConfig::get('sf_style_smartadmin')
  )
);

foreach($nodes as $subnode)
{
  if ($options['showFolders'] && $subnode->getIsFolder())
  {
    $row = array(
      '',
      image_tag('/ttDms/images/icons/folder_16.gif', array('valign' => 'middle')) . ' ' . $subnode->getName(),
      format_date($subnode->getCreatedAt(), 'g')
    );

    if ($options['showType'] && ($options['showType'] !== 'false'))
    {
      $row[] = 'Folder';
    }
    if ($options['showAnnotations'] && ($options['showAnnotations'] !== 'false'))
    {
      $row[] = '';
    }

    $row = array_merge($row, array('', ''));

    $table->addRow($row);
  }
}

foreach($nodes as $subnode)
{
  // controle of bestand gevonden kan worden in de storage
  $storage = $subnode->getDmsStore()->getStorage();
  if (!$storage->exists($subnode->getMetadata()))
  {    
    $errorTdAttributes= array('style' => 'color: red; background-color:pink');

    $row = array(
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
      array('content' => $subnode->getName(), 'tdAttributes' => $errorTdAttributes),
      array('content' => format_date($subnode->getCreatedAt(), 'g'), 'tdAttributes' => $errorTdAttributes));

    if ($options['showType'] && ($options['showType'] !== 'false'))
    {
      $row[] = array('content' => '', 'tdAttributes' => $errorTdAttributes);
    }
    if ($options['showAnnotations'] && ($options['showAnnotations'] !== 'false'))
    {
      $row[] = array('content' => '', 'tdAttributes' => $errorTdAttributes);
    }

    $row = array_merge($row, array(
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
    ));

    $table->addRow($row, array('style' => 'white-space: nowrap;'));
    
    continue;
  }

  if (! $subnode->getIsFolder())
  {
    $row = array(
      checkbox_tag('nodes[]', $subnode->getId(), false),
      image_tag(filetype_image_path($subnode->getExtension()), array('style' => 'width:16px; vertical-align: -20%;', 'title' => $subnode->getMimeType())) . ' ' . $subnode->getName(),
      format_date($subnode->getCreatedAt(), 'g'));

    if ($options['showType'] && ($options['showType'] !== 'false'))
    {
      $row[] = $subnode->getMimeType();
    }
    if ($options['showAnnotations'] && ($options['showAnnotations'] !== 'false'))
    {
      $aspects = array();
      foreach($subnode->getDmsNodeAspectsJoinDmsAspect() as $nodeAspect)
      {
        $aspects[] = $nodeAspect->getDmsAspect()->getName();
      }
      $row[] = implode(', ', $aspects);
    }

    $row = array_merge($row, array(
      format_filesize($subnode->getSize()),
      link_to(sfConfig::get('sf_style_smartadmin') ? '<i class="fa fa-save" title="Downloaden"></i>' : image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'ttDmsBrowser/download?node_id=' . $subnode->getId())
      . link_to_function(sfConfig::get('sf_style_smartadmin') ? '<i class="fa fa-minus-circle" title="Verwijderen"></i>' : image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'deleteNode(' . $subnode->getId() . ');')
      . link_to_function(sfConfig::get('sf_style_smartadmin') ? '<i class="fa fa-search" title="Details"></i>' : image_tag('/ttDms/images/icons/document_zoom_16.gif', array('title' => 'Details')), 'showNodeDetails(' . $subnode->getId() . ');')
    ));

    $table->addRow($row, array('style' => 'white-space: nowrap'));
  }
}

echo $table;
?>
Met geselecteerde:
<?php if (sfConfig::get('sf_style_smartadmin')): ?>
  <?php echo link_to_function('<i class="fa fa-minus-circle" title="Verwijderen"></i>', 'multiActie("delete")'); ?>
  <?php echo link_to_function('<i class="fa fa-save" title="downloaden"></i>', 'multiActie("download")'); ?>
<?php else: ?>
  <?php echo link_to_function(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'multiActie("delete")'); ?>
  <?php echo link_to_function(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'multiActie("download")'); ?>
<?php endif; ?>
</div>