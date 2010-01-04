<?php use_helper('Object') ?>

<?php echo form_tag('ttDmsAspect/update') ?>

<?php echo object_input_hidden_tag($dms_aspect, 'getId') ?>

<h2 class="pageblock"><?php echo $dms_aspect->getId() ? 'Bewerk' : 'Nieuw'; ?> aspect</h2>
<div class="pageblock">
<table class="formtable">
<tbody>
<tr>
  <th>Naam:</th>
  <td><?php echo object_input_tag($dms_aspect, 'getName', array (
  'size' => 45,
)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('Opslaan') ?>
<?php if ($dms_aspect->getId()): ?>
  &nbsp;<?php echo button_to_function('Annuleren', 'history.back();') ?>
<?php endif; ?>
</form>
</div>