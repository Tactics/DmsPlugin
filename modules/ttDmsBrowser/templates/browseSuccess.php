<ul class="breadcrumb">
  <li><?php echo link_to("Home", "@homepage") ?></li>
  <li><?php echo link_to("Dms Stores", "ttDmsBrowser/index") ?></li>
  <li>Browse <?php echo $store->getName(); ?></li>
</ul>

<?php include_component('ttDmsBrowser', 'browser', array(
  'node' => $store,
  'options' => array('width' => '100%')
)); ?>