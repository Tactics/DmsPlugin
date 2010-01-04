<?php include_partial('breadcrumb'); ?>
<h2 class="pageblock">Aspect "<?php echo $dms_aspect->getName(); ?>"</h2>
<div class="pageblock">
<table class="objectdetails">
<tbody>
<tr>
  <th>Name: </th>
  <td><?php echo $dms_aspect->getName() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo button_to('Bewerken', 'ttDmsAspect/edit?id='.$dms_aspect->getId()) ?>
</div>

<h2 class="pageblock">Eigenschappen</h2>
<div class="pageblock">
  <?php echo form_tag('ttDmsAspect/addType'); ?>
    <?php echo input_hidden_tag('id', $dms_aspect->getId()); ?>
    Type <?php echo select_tag('type_id', objects_for_select(DmsPropertyTypePeer::doSelect(new Criteria()), 'getId', 'getName')); ?>
    <?php echo submit_tag('Toevoegen'); ?>
  </form>
  <br />
  
  <table class="grid">
  <thead>
    <tr>
      <td>Naam</td>
      <td width="40">Acties</td>
    </tr>
  </thead>
  <?php
  $c = new Criteria();
  $c->addAscendingOrderByColumn(DmsAspectPropertyTypePeer::VOLGORDE);
  
  foreach($dms_aspect->getDmsAspectPropertyTypesJoinDmsPropertyType($c) as $type): ?>
  <tr>
    <td><?php echo $type->getDmsPropertyType()->getName(); ?></td>
    <td style="text-align:center;"><?php echo link_to(image_tag('/ttDms/images/icons/delete_16.gif', array('title' => 'Verwijderen')), 'ttDmsAspect/removeType?id=' . $type->getId()) ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</div>
