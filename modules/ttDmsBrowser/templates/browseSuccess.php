<?php
  use_javascript('/ttBase/ui/js/dialog.js');
  use_stylesheet('/ttBase/ui/css/dialog.css');
  use_javascript('/ttDms/js/ajaxupload.js');
?>

<ul class="breadcrumb">
  <li><?php echo link_to("Home", "@homepage") ?></li>
  <li>&gt; <?php echo link_to("Dms Stores", "ttDmsBrowser/index") ?></li>
  <li>&gt; Browse <?php echo $store->getName(); ?></li>
</ul>

<?php include_component('ttDmsBrowser', 'browser', array(
  'node' => $store,
  'options' => array('width' => '100%')
)); ?>