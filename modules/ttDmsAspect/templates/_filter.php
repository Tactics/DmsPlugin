<?php
$aspects = isset($aspects)
  ? $aspects
  : DmsAspectPeer::doSelect(new Criteria());
?>

<table>
  <tr>
    <th>Aspect:</th>    
    <td><?php echo select_tag(DmsAspectPeer::ID, objects_for_select($aspects, 'getId', 'getName', $pager->get(DmsAspectPeer::ID), array('include_blank' => true)), array('class' => 'aspects')) ?></td>
  </tr>
  <?php
  $values = $pager->get('property_types');

  foreach(DmsPropertyTypePeer::doSelect(new Criteria()) as $propertyType)
  {    
    $dataAspects = array();
    foreach($propertyType->getRelatedAspects() as $aspect)
    {
      $dataAspects[]= 'aspect-' . $aspect->getId();
    }
    echo sprintf('<tr class="property_type" data-aspects="%s">', implode(' ', $dataAspects));

    echo '<th>'.$propertyType->getName().'</th><td>';

    $id = $propertyType->getId();
    $domId = 'property_types['.$id.']';

    switch ($propertyType->getDataType())
    {
      case DmsPropertyTypePeer::TYPE_TEXT:
      case DmsPropertyTypePeer::TYPE_TEXTAREA:
        echo input_tag($domId, isset($values[$id]) ? $values[$id] : '', array(
          'data-initial-value' => isset($values[$id]) ? $values[$id] : ''
        ));
        break;
      case DmsPropertyTypePeer::TYPE_CHECKBOX:
        echo ja_nee_tag($domId, isset($values[$id]) ? $values[$id] : '' ,array('include_blank' => true));
        break;
      case DmsPropertyTypePeer::TYPE_DATE:
        echo input_date_tag($domId, isset($values[$id]) ? $values[$id] : '',
          array("rich" => "on",
            "calendar_button_img" => "icons/calendar.gif",
            'class' => 'mask_date',
            'format' => 'dd/MM/yyyy',
            'size' => '11',
          ));
        break;
      case DmsPropertyTypePeer::TYPE_SELECTLIST:        
        echo select_tag($domId, options_for_select(json_decode($propertyType->getOptions())), array(
          'data-initial-value' => isset($values[$id]) ? $values[$id] : ''
        ));
        break;
      case DmsPropertyTypePeer::TYPE_SQLSELECT:
        $sql = $propertyType->getOptions();
        echo select_tag($domId, options_for_select(myDbTools::getIndexedArrayFromSQL($sql)), array(
          'data-initial-value' => isset($values[$id]) ? $values[$id] : ''
        ));
        break;
      default:
        break;
    }

    echo '</td></tr>';
  }
  ?>
</table>

<script type="text/javascript">  
  jQuery(function($)
  {
    // Juiste properties laten zien om op te filteren
    $('.aspects').on('change', function(){
      var $rows = $('tr.property_type');
      $rows.hide();
      $rows.find(':input').each(function(){
        var $input = $(this);
        var initVal = $input.data('initial-value');
        $input.val(initVal ? initVal : '');
        $input.data('initial-value', '');
      });
      
      var aspectId = this.value;
      if (aspectId != '')
      {
        $rows.each(function(){
          var $row = $(this);
          var aspects = $row.data('aspects').split(' ');          
          $row.toggle($.inArray('aspect-' + aspectId, aspects) !== -1);
        });
      }
    }).trigger('change');
  });
</script>
