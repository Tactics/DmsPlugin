<?php use_helper('Dms'); ?>

<?php
if(! function_exists('__'))
  \Misc::use_helper('i18n');
?>

<?php if (!$sf_request->isXmlHttpRequest()) : ?>
  <ul class="breadcrumb">
    <li><?php echo link_to("Home", "@homepage") ?></li>
    <li>&gt;Dms files</li>
  </ul>

  <h2 class="pageblock"><?php echo __('Zoeken in nodelijst');?></h2>
  <div class="pageblock">
    <?php
    echo tt_form_remote_tag(array(
        'method' => 'POST',
        'update' => 'zoekresultaten',
        'url' => 'ttDmsBrowser/list'
      ),
      array(
        'id' => 'zoekform'
      ));
    ?>
    <table class="formtable" width='100%'>
      <tbody>
      <tr>
        <td width='50%'>
          <table>
            <tr>
              <th><?php echo __('Naam');?>:</th>
              <td><?php echo input_tag(DmsNodePeer::NAME, $pager->get(DmsNodePeer::NAME)); ?></td>
            </tr>
            <tr>
              <th><?php echo __('Aspect');?>:</th>
              <td><?php echo select_tag(DmsNodeAspectPeer::ASPECT_ID, options_for_select(DmsAspectPeer::getOptionsForSelect(), $pager->get(DmsNodeAspectPeer::ASPECT_ID), array('include_blank' => true)), array('class' => 'aspects')) ?></td>
            </tr>
            <tr>
              <th style='width: 80px;'><label for='datum_van'><?php echo __('Geupload van');?>:</label></th>
              <td>
                <?php
                echo input_date_tag('datum_van', myDateTools::cultureDateToPropelDate($pager->get('datum_van', null)),
                  array("rich" => true, "calendar_button_img" => "calendar.gif", "class" => "mask_date", "format" => "dd/MM/yyyy"))
                ?>
              </td>
            </tr>
            <tr>
              <th style='width: 80px;'><label for='datum_tot'><?php echo __('Geupload tot');?>:</label></th>
              <td>
                <?php
                echo input_date_tag('datum_tot', myDateTools::cultureDateToPropelDate($pager->get('datum_tot', null)),
                  array("rich" => true, "calendar_button_img" => "calendar.gif", "class" => "mask_date", "format" => "dd/MM/yyyy"))
                ?>
              </td>
            </tr>
          </table>
        </td>
        <td width='50%'>
          <table id="propertyTypes">
            <?php
            $values = $pager->get('aspect_type');

            foreach(DmsPropertyTypePeer::doSelect(new Criteria()) as $propertyType)
            {
              echo '<tr data-aspects="' ;
              $dataAspects = array();
              foreach($propertyType->getRelatedAspects() as $aspect)
              {
                $dataAspects[]= 'aspect-' . $aspect->getId();
              }
              echo implode(' ', $dataAspects) . '">';

              echo '<th>'.$propertyType->getName().'</th><td>';


              $id = $propertyType->getId();
              $domId = 'aspect_type['.$id.']';

              switch ($propertyType->getDataType())
              {
                case DmsPropertyTypePeer::TYPE_TEXT:
                case DmsPropertyTypePeer::TYPE_TEXTAREA:
                  echo input_tag($domId, isset($values[$id]) ? $values[$id] : '');
                  break;
                case DmsPropertyTypePeer::TYPE_CHECKBOX:
                  echo ja_nee_tag($domId, isset($values[$id]) ? $values[$id] : '' ,array('include_blank' => true));
                  break;
                case DmsPropertyTypePeer::TYPE_DATE:
                  echo input_date_tag($domId, isset($values[$id]) ? $values[$id] : '',
                    array("rich" => "on",
                      "calendar_button_img" => "icons/calendar.gif",
                      'class' => 'mask_date',
                      'format' => 'dd/MM/yyyy',
                      'size' => '11',
                    ));
                  break;
                default:
                  break;
              }

              echo '</td></tr>';
            }
            ?>
          </table>

        </td>
      </tr>
      </tbody>
    </table>
    <?php echo input_hidden_tag("reset", 1); ?>
    <br/>
    <?php echo submit_tag(__('Zoeken')) ?>
    <?php echo button_to_function(__('Filter wissen'), 'filterWissen()'); ?>
    </form>
  </div>

  <h2 class="pageblock"><?php echo __('Documentenlijst');?></h2>
  <div class="pageblock">
<?php endif ?>

  <div id="zoekresultaten">
  <div class="filter">
    &nbsp;<?php echo $pager->getNbResults() . ' ' . __('resultaten gevonden');?>,
    <strong><?php echo $pager->getLastIndice() ? $pager->getFirstIndice() : 0 ?>
      -<?php echo $pager->getLastIndice() ?></strong> <?php echo __('worden weergegeven');?>.
  </div>

<?php
$table = new myTable(
  array(
    array('name' => DmsNodePeer::NAME, 'text' => __('Naam'), 'align' => 'left', 'sortable' => true),
    array('name' => DmsObjectNodeRefPeer::ID, 'text' => __('Object'), 'align' => 'left', 'sortable' => true),
    array('name' => 'storagepath', 'text' => __('Mapstructuur'), 'align' => 'left'),
    array('name' => DmsNodePeer::CREATED_AT, 'text' => __('Datum upload'), 'align' => 'left', 'sortable' => true),
    array("text" => __("Acties"), "width" => 55, "align" => "center")
  ),
  array(
    "sortfield" => $pager->getOrderBy(),
    "sortorder" => ($pager->getOrderAsc() ? "ASC" : "DESC"),
    "sorturi" => 'ttDmsBrowser/list',
    "sorttarget" => 'zoekresultaten',
  )
);

foreach ($pager->getResults() as $file) {
  $parentnode = $file->getParentNode();
  $objectNodeRefs = $parentnode->getDmsObjectNodeRefs();
  $object = !empty($objectNodeRefs) ? Misc::getObject($objectNodeRefs[0]->getObjectClass(), $objectNodeRefs[0]->getObjectId()) : null;

  $storage = $file->getDmsStore()->getStorage();
  if (!$storage->exists($file->getStoragePath()))
  {
    $errorTdAttributes= array('style' => 'color: red; background-color:pink');

    $table->addRow(array(
        array('content' => $file->getName(), 'tdAttributes' => $errorTdAttributes),
        array('content' => $objectNodeRefs ? $objectNodeRefs[0]->getObjectClass() : '', 'tdAttributes' => $errorTdAttributes),
        array('content' => $file->getStoragePath(), 'tdAttributes' => $errorTdAttributes),
        array('content' => myDateTools::propelDateToCultureDate($file->getCreatedAt()), 'tdAttributes' => $errorTdAttributes),
        array('content' => '', 'tdAttributes' => $errorTdAttributes)
      ));

    continue;
  }

  $table->addRow(array(
    $file->getName(),
    $objectNodeRefs ? $objectNodeRefs[0]->getObjectClass() : '',
    $file->getStoragePath(),
    array('content' => myDateTools::propelDateToCultureDate($file->getCreatedAt()), 'tdAttributes' => $errorTdAttributes),
    link_to(image_tag('/ttDms/images/icons/diskette_16.gif', array('title' => 'Downloaden')), 'ttDmsBrowser/download?node_id=' . $file->getId()) . '&nbsp;' .
    link_to_function(image_tag('/ttDms/images/icons/document_zoom_16.gif', array('title' => 'Details')), 'showNodeDetails(' . $file->getId().');')
  ));
}

echo $table;

?>

<?php echo pager_navigation($pager, "ttDmsBrowser/list", 'zoekresultaten') ?>

<?php if (!$sf_request->isXmlHttpRequest()) : ?>
  </div>
  </div>
<?php endif ?>

<script type='text/javascript'>
// Code om window te openen om properties aan te passen van een geupload document
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

// Juiste properties laten zien om op te filteren
  jQuery(function($)
  {
    // mask op datum veld
    $('.mask_date').mask("99/99/9999", {placeholder:" "});

    $('.aspects').on('change', function(){
      if($(this).val() != '')
      {
        $('#propertyTypes tr').hide().filter("[data-aspects*='aspect-" + $(this).val()+ "']").show();
      }
      else
      {
        $('#propertyTypes tr').hide();
      }
    }).trigger('change');
  });

// filter wissen
  function filterWissen()
  {
    wisFormulier($("#zoekform"));
    $('#aspectTypes').html('');
  }

</script>