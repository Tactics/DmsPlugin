<?php /** @var DmsNode $node the root folder node */ ?>

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
    case 'archive':
        jQuery.tt.confirm('Bestanden archiveren', 'Bent u zeker dat deze ' + cnt + ' bestanden wilt archiveren?', function(value)
        {
            if (! value) return;

            jQuery.ajax({
                url: '<?php echo url_for('ttDmsBrowser/jsonNodeArchive'); ?>',
                dataType: 'json',
                data: {node_ids: checkboxes},
                success: function (data)
                {
                    if (! data.success)
                    {
                        jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het archiveren van bestanden. <p><pre>' + data.message + '</pre></p>');
                    }
                    else
                    {
                        loadNode(<?php echo $node->getId(); ?>);
                    }
                },
                error: function()
                {
                    jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het archiveren van de bestanden. <p><pre>404 Not Found</pre></p>', {className: 'error'});
                }
            });
        });

        break;
      case 'unarchive':
          jQuery.tt.confirm('Bestanden dearchiveren', 'Bent u zeker dat deze ' + cnt + ' bestanden wilt dearchiveren?', function(value)
          {
              if (! value) return;

              jQuery.ajax({
                  url: '<?php echo url_for('ttDmsBrowser/jsonNodeUnArchive'); ?>',
                  dataType: 'json',
                  data: {node_ids: checkboxes},
                  success: function (data)
                  {
                      if (! data.success)
                      {
                          jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het dearchiveren van bestanden. <p><pre>' + data.message + '</pre></p>');
                      }
                      else
                      {
                          loadNode(<?php echo $node->getId(); ?>);
                      }
                  },
                  error: function()
                  {
                      jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het dearchiveren van de bestanden. <p><pre>404 Not Found</pre></p>', {className: 'error'});
                  }
              });
          });

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

function archiveNode(node_id)
{
    jQuery.tt.confirm('Bestand archiveren', 'Bent u zeker dat dit bestand wilt archiveren?', function(value)
    {
        if (! value) return;
        jQuery.ajax({
            url: '<?php echo url_for('ttDmsBrowser/jsonNodeArchive'); ?>',
            dataType: 'json',
            data: {node_ids: node_id},
            success: function (data)
            {
                if (! data.success) {
                    jQuery.tt.alert('Probleem bij het archiveren van bestand. <br/><br/><i>' + data.message + '</i>');
                } else {
                    loadNode(<?php echo $node->getId(); ?>);
                }
            },
            error: function() {
                jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het archiveren van het bestand. <p><pre>404 Not Found</pre></p>', {className: 'error'});
            }
        });
    });
}

function unArchiveNode(node_id)
{
    jQuery.tt.confirm('Bestand dearchiveren', 'Bent u zeker dat dit bestand wilt dearchiveren?', function(value)
    {
        if (! value) return;
        jQuery.ajax({
            url: '<?php echo url_for('ttDmsBrowser/jsonNodeUnArchive'); ?>',
            dataType: 'json',
            data: {node_ids: node_id},
            success: function (data)
            {
                if (! data.success) {
                    jQuery.tt.alert('Probleem bij het dearchiveren van bestand. <br/><br/><i>' + data.message + '</i>');
                } else {
                    loadNode(<?php echo $node->getId(); ?>);
                }
            },
            error: function() {
                jQuery.tt.alert('Probleem', 'Er is een probleem opgetreden bij het dearchiveren van het bestand. <p><pre>404 Not Found</pre></p>', {className: 'error'});
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
  array('text' => $options['actions_enabled'] ? checkbox_tag('multiCheck', '', 0, array('onclick' => 'multiCheck(this);', 'class' => 'multiCheck')) : '', 'width' => 16),
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

$smartadmin = sfConfig::get('sf_style_smartadmin');

$queryParams = [
  'node_id' => $node->getId(),
  'showType' => $options['showType'],
  'showAnnotations' => $options['showAnnotations'],
  'archive_enabled' => $options['archive_enabled']
];

//Misc::pre_print_r(http_build_query($queryParams));

$table = new myTable(
  $headers,
  array(
    'class' => 'ttDmsFileList',
    "sortfield"  => $orderBy,
    "sortorder"  => $orderAsc ? "ASC" : "DESC",
    "sorturi"    => 'ttDmsBrowser/ajaxNodeList?'.http_build_query($queryParams, null, '&'),
    "sorttarget" => 'nodeList',
    "smartadmin" => $smartadmin
  )
);

// show folders first
/** @var DmsNode $subnode */
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

/**
 * @param DmsNode $node
 * @return closure
 */
function createNodeNotFoundRow($options) {
  $innerFunc = function (DmsNode $node) use ($options) {
    $errorTdAttributes= array('style' => 'color: red; background-color:pink');

    $row = array(
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
      array('content' => $node->getName(), 'tdAttributes' => $errorTdAttributes),
      array('content' => format_date($node->getCreatedAt(), 'g'), 'tdAttributes' => $errorTdAttributes));

    if ($options['showType'] && ($options['showType'] !== 'false'))
    {
      $row[] = array('content' => '', 'tdAttributes' => $errorTdAttributes);
    }
    if ($options['showAnnotations'] && ($options['showAnnotations'] !== 'false'))
    {
      $row[] = array('content' => '', 'tdAttributes' => $errorTdAttributes);
    }

    return array_merge($row, array(
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
      array('content' => '', 'tdAttributes' => $errorTdAttributes),
    ));
  };
  return $innerFunc;
}
$nodeNotFoundRow = createNodeNotFoundRow($options);

/** @var DmsNode $subnode */
foreach($nodes as $subnode)
{
  // folders are already listed
  if ($subnode->getIsFolder()) {
    continue;
  }

  // controle of bestand gevonden kan worden in de storage
  $storage = $subnode->getDmsStore()->getStorage();
  if (!$storage->exists($subnode->getMetadata())) {
    $row = $nodeNotFoundRow($subnode);
    $table->addRow($row, array('style' => 'white-space: nowrap;'));
    continue;
  }

  $row = array(
    $options['actions_enabled'] ? checkbox_tag('nodes[]', $subnode->getId(), false) : '',
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

  $actions = [];
  if ($options['actions_enabled']) {
    if ($smartadmin) {
      $actions[] = link_to('<i class="fa fa-save" title="Downloaden"></i>', 'ttDmsBrowser/download?node_id=' . $subnode->getId());
      $actions[] = link_to_function('<i class="fa fa-minus-circle" title="Verwijderen"></i>', 'deleteNode(' . $subnode->getId() . ');');
      $actions[] = link_to_function('<i class="fa fa-search" title="Details"></i>', 'showNodeDetails(' . $subnode->getId() . ');');
      if ($options['archive_enabled']) {
        if ($subnode->getGearchiveerd()) {
          $actions[] = link_to_function('<i class="fa fa-archive" title="Dearchiveren"></i>', 'unArchiveNode(' . $subnode->getId().');');
        } else {
          $actions[] = link_to_function('<i class="fa fa-archive-fill" title="Archiveren"></i>', 'archiveNode(' . $subnode->getId().');');
        }
      }
    } else {
      $actions[] = link_to(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'ttDmsBrowser/download?node_id=' . $subnode->getId());
      $actions[] = link_to_function(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'deleteNode(' . $subnode->getId() . ');');
      $actions[] = link_to_function(image_tag('/ttDms/images/icons/document_zoom_16.gif', array('title' => 'Details')), 'showNodeDetails(' . $subnode->getId() . ');');
      if ($options['archive_enabled']) {
        if ($subnode->getGearchiveerd()) {
          $actions[] = link_to_function(image_tag('/ttDms/images/icons/dearchiveer.16.png', array('title' => 'Dearchiveren')), 'unArchiveNode(' . $subnode->getId().');');
        } else {
          $actions[] = link_to_function(image_tag('/ttDms/images/icons/archiveer.16.png', array('title' => 'Archiveren')), 'archiveNode(' . $subnode->getId().');');
        }
      }
    }
  }

  $row = array_merge($row, array(
    format_filesize($subnode->getSize()),
    implode(' ', $actions)
  ));

  $rowOptions['style'] = 'white-space: nowrap';
  if ($subnode->getGearchiveerd()) {
    $rowOptions['rowClass'] = 'gearchiveerd';
  }

  $table->addRow($row, $rowOptions);

}

echo $table;
if ($options['actions_enabled']):
?>
Met geselecteerde:
<?php if ($smartadmin): ?>
  <?php echo link_to_function('<i class="fa fa-minus-circle" title="Verwijderen"></i>', 'multiActie("delete")'); ?>
  <?php echo link_to_function('<i class="fa fa-save" title="downloaden"></i>', 'multiActie("download")'); ?>
  <?php if ($options['archive_enabled']) : ?>
    <?php echo link_to_function('<i class="fa fa-archive-fil" title="archiveren"></i>', 'multiActie("archive")'); ?>
    <?php echo link_to_function('<i class="fa fa-archive" title="dearchiveren"></i>', 'multiActie("unarchive")'); ?>
  <?php endif; ?>

<?php else: ?>
  <?php echo link_to_function(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'multiActie("delete")'); ?>
  <?php echo link_to_function(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'multiActie("download")'); ?>
  <?php if ($options['archive_enabled']) : ?>
    <?php echo link_to_function(image_tag('/ttDms/images/icons/archiveer.16.png', array('title' => 'Archiveren')), 'multiActie("archive")'); ?>
    <?php echo link_to_function(image_tag('/ttDms/images/icons/dearchiveer.16.png', array('title' => 'Dearchiveren')), 'multiActie("unarchive")'); ?>
  <?php endif; ?>

<?php endif; ?>
<?php endif; ?>
</div>