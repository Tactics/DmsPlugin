<?php if (!$sf_request->isXmlHttpRequest()) : ?>

<?php
if(! function_exists('__'))
    \Misc::use_helper('i18n');
?>

<?php echo include_partial('breadcrumb', array('actie' => 'Types')); ?>

<h2 class="pageblock"><?php echo __('Dms propertytypes');?></h2>
<div class="pageblock">
  <?php endif; ?>
  <div id="zoekresultaten">
    <div class="filter">
      &nbsp;<?php echo $pager->getNbResults() . ' ' . __('resultaten gevonden');?>,
      <strong><?php echo $pager->getLastIndice() ? $pager->getFirstIndice() : 0 ?>
        -<?php echo $pager->getLastIndice() ?></strong> <?php echo __('worden weergegeven');?>.
    </div>
<?php

$table = new myTable(array(
  array('name' => DmsPropertyTypePeer::NAME, 'text' => __('Naam')),
  array('text' => __('Acties'), 'width' => 40, 'align' => 'center')
));

foreach ($pager->getResults() as $dms_type)
{
  $table->addRow(array(
    link_to_unless($dms_type->getSystemName(), $dms_type->getName(), 'ttDmsAspect/editType?id='.$dms_type->getId()),
    !$dms_type->getSystemName() ? link_to(image_tag('icons/bewerk.16.png'), 'ttDmsAspect/editType?id='.$dms_type->getId()) : ''
  ));
}

echo $table;

?>
<?php echo pager_navigation($pager, "ttDmsAspect/listTypes", 'zoekresultaten') ?>
    <?php if (!$sf_request->isXmlHttpRequest()) : ?>
</tbody>
</table>
<hr />
<?php echo button_to (__('Nieuw type'), 'ttDmsAspect/createType') ?>
</div>
  <?php endif; ?>