<ul class="breadcrumb">
  <li><?php echo link_to("Home", "@homepage") ?></li>
  <li>Dms Stores</li>
</ul>

<h2 class="pageblock">Stores</h2>
<div class="pageblock">
  <?php foreach($stores as $store): ?>
    <?php echo image_tag('/ttDms/images/icons/database_16.gif') . ' ' . link_to('Store "' . $store->getName() . '"', 'ttDmsBrowser/browse?store_id=' . $store->getId()); ?><br />
  <?php endforeach; ?>
</div>