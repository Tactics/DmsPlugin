<?php
$aspects = DmsAspectPeer::doSelect(new Criteria());

echo tt_form_remote_tag(array(
  'method' => 'POST',
  'update' => 'nodeList',
  'url' => 'ttDmsBrowser/ajaxNodeList?node_id=' . $node->getId()
),
  array(
    'id' => 'zoekform'
  ));
echo input_hidden_tag('showType', $options['showType']);
echo input_hidden_tag('showAnnotations', $options['showAnnotations']);
echo input_hidden_tag('systemname_for_sportsubsidies', $options['systemname_for_sportsubsidies']);
?>
<table class="formtable" width='100%'>
  <tbody>
  <tr>
    <td width='50%'>
      <table>
        <tr>
          <th>Aspect:</th>
          <td><?php echo select_tag(DmsAspectPeer::ID, objects_for_select($aspects, 'getId', 'getName', $aspect_id, array('include_blank' => true)), array('class' => 'aspects')) ?></td>
        </tr>
      </table>
    </td>
    <td width='50%'>
      <table>
        <tr>
          <th>Subsidiejaar:</th>
          <td><?php echo select_year_tag('jaar', $jaar ? $jaar : '', array('year_start' => 2014, 'year_end' => date('Y') + 1, 'include_blank' => true)); ?></td>
        </tr>
      </table>
    </td>
  </tr>
  </tbody>
</table>
<?php echo input_hidden_tag("reset", 1); ?>
<br/>
<?php echo submit_tag('Zoeken') ?>&nbsp;
<?php echo button_to_function('Filter wissen', 'filterWissen()'); ?>
</form>