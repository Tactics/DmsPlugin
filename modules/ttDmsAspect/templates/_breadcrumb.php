<ul class="breadcrumb">

	<li><?php echo link_to("Home", "@homepage") ?></li>
	<li>DMS Config</li>
  
  <?php if (isset($actie)) : ?>
    <li><?php echo $actie ?></li>
  <?php endif ?>

</ul>
