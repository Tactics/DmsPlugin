<?php use_helper('Object') ?>

<?php
if(! function_exists('__'))
  \Misc::use_helper('i18n');
?>

<?php echo form_tag('ttDmsAspect/update') ?>

<?php echo object_input_hidden_tag($dms_aspect, 'getId') ?>

<h2 class="pageblock"><?php echo $dms_aspect->getId() ? __('Bewerk') : __('Nieuw'); ?> <?php echo __('aspect');?></h2>
<div class="pageblock">

<?php include_partial("global/formvalidationerrors"); ?>

<table class="formtable">
<tbody>
<tr class='<?php echo $sf_request->hasError('name') ? 'error' : 'required'; ?>'>
  <th><?php echo __('Naam');?>:</th>
  <td><?php echo object_input_tag($dms_aspect, 'getName', array (
  'size' => 45,
)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag(__('Opslaan')) ?>
<?php if ($dms_aspect->getId()): ?>
  &nbsp;<?php echo button_to_function(__('Annuleren'), 'history.back();') ?>
<?php endif; ?>
</form>
</div>