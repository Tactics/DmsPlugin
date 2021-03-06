<?php if (! $sf_request->isXmlHttpRequest()) : ?>

<?php
if(! function_exists('__'))
  \Misc::use_helper('I18N');
?>

<?php echo include_partial('breadcrumb', array('actie' => 'Aspecten')); ?>
<h2 class="pageblock"><?php echo __('Dms Aspecten');?></h2>
<div class="pageblock">
  <div id="zoekresultaten">
  <?php
endif; // end XmlHttpRequest

  $table = new myTable(array(
    array('name' => DmsAspectPeer::NAME, 'text' => __('Naam')),
    array('text' => __('Acties'), 'width' => 40, 'align' => 'center')
  ));

  foreach($pager->getResults() as $dms_aspect)
  {
    $table->addRow(array(
      link_to_unless($dms_aspect->getSystemName(), $dms_aspect->getName(), 'ttDmsAspect/show?id='.$dms_aspect->getId()),
      !$dms_aspect->getSystemName() ? link_to(image_tag('icons/bewerk.16.png'), 'ttDmsAspect/edit?id='.$dms_aspect->getId()) : ''
    ));
  }

  echo $table;
?>
  <?php echo pager_navigation($pager, 'ttDmsAspect/list', "zoekresultaten") ?>
  <?php if (! $sf_request->isXmlHttpRequest()) : ?>
    <hr />
    <?php echo button_to (__('Nieuw aspect'), 'ttDmsAspect/create') ?>
  </div>
</div>
<?php endif; ?>
