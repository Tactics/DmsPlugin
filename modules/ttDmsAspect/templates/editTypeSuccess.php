<?php echo include_partial('breadcrumb', array('actie' => 'Types')); ?>

<?php use_helper('Object') ?>

<?php echo form_tag('ttDmsAspect/updateType') ?>

<?php echo object_input_hidden_tag($dms_type, 'getId') ?>

<?php
if(! function_exists('__'))
  \Misc::use_helper('I18N');
?>

<h2 class="pageblock"><?php echo $dms_type->getId() ? __('Bewerk') : __('Nieuw'); ?> <?php echo __('aspect');?></h2>
<div class="pageblock">

<?php include_partial("global/formvalidationerrors"); ?>

<table class="formtable">
<tbody>
<tr class='<?php echo $sf_request->hasError('name') ? 'error' : 'required'; ?>'>
  <th><?php echo __('Naam');?>:</th>
  <td><?php echo object_input_tag($dms_type, 'getName', array (
  'size' => 45,
)) ?></td>
</tr>

<tr>
  <th><?php echo __('Datatype');?>:</th>
  <td><?php echo select_tag('data_type', options_for_select(DmsPropertyTypePeer::getDataTypes(), $dms_type->getDataType()), array('class' => 'datatype')) ?></td>
</tr>
<tr class="select_options" style="display:none">
  <th><?php echo __('Opties');?>:</th>
  <td><?php echo textarea_tag('options', ($dms_type->getOptions() && ($dms_type->getDataType() == 'selectlist')) ? implode("\r\n", json_decode($dms_type->getOptions())) : $dms_type->getOptions(), array('size' => '45x5')); ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag(__('Opslaan')) ?>
&nbsp;<?php echo button_to_function(__('Annuleren'), 'history.back();') ?>
</form>
</div>

<script type="text/javascript">
  jQuery(function($){
    $('.datatype').change(function(){
      $('.select_options').toggle((this.value == 'selectlist') || (this.value == 'sqlselect'))
    }).trigger('change');
  });
</script>