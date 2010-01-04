<?php echo include_partial('breadcrumb', array('actie' => 'Types')); ?>

<?php use_helper('Object') ?>

<?php echo form_tag('ttDmsAspect/updateType') ?>

<?php echo object_input_hidden_tag($dms_type, 'getId') ?>

<h2 class="pageblock"><?php echo $dms_type->getId() ? 'Bewerk' : 'Nieuw'; ?> aspect</h2>
<div class="pageblock">
<table class="formtable">
<tbody>
<tr>
  <th>Naam:</th>
  <td><?php echo object_input_tag($dms_type, 'getName', array (
  'size' => 45,
)) ?></td>
</tr>

<tr>
  <th>Datatype:</th>
  <td><?php echo select_tag('data_type', options_for_select(DmsPropertyTypePeer::getDataTypes(), $dms_type->getDataType())) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('Opslaan') ?>
&nbsp;<?php echo button_to_function('Annuleren', 'history.back();') ?>
</form>
</div>