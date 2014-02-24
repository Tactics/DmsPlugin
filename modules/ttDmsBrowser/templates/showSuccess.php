<style type="text/css">
  div.calendar{
    z-index: 10000;
  }
</style>

<?php use_helper('Dms'); ?>
<h2 class="pageblock">
  <?php echo image_tag(filetype_image_path($node->getExtension()), array('title' => $mime_type)); ?>
  <?php include_partial('nodeTrail', array('node' => $node)); ?>
</h2>
<div class="pageblock">
  <table class="objectdetails">
    <tr>
      <th>Naam:</th>
      <td><?php echo $node->getName(); ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $mime_type; ?></td>
    </tr>
    <tr>
      <th>Grootte:</th>
      <td><?php echo format_filesize($node->getSize()); ?></td>
    </tr>
    <tr>
      <th>Aangemaakt op:</th>
      <td>
        <?php echo format_date($node->getCreatedAt(), 'f'); ?>
      </td>
    </tr>
    <tr>
      <th>Laatst gewijzigd op:</th>
      <td><?php echo format_date($node->getUpdatedAt(), 'f'); ?></td>
    </tr>
  </table>
</div>

<h2 class="pageblock">Eigenschappen</h2>
<div class="pageblock">
  <?php if (count($aspects)): ?>
    <?php echo form_tag('ttDmsBrowser/addAspect'); ?>
      Aspect <?php echo input_hidden_tag('node_id', $node->getId()); ?>
      <?php echo select_tag('aspect_id', objects_for_select($aspects, 'getId', 'getName') ); ?>
      <?php echo submit_tag('toevoegen'); ?>
    </form>
  <?php endif; ?>
  
  <?php 
  $aspects = $node->getDmsNodeAspectsJoinDmsAspect();
  
  if (count($aspects)) : 
  
  echo form_tag('ttDmsBrowser/saveProperties');
  echo input_hidden_tag('node_id', $node->getId());
  echo input_hidden_tag('redirect_url', $redirect_url);
  ?>
  
    <?php foreach($aspects as $nodeAspect): ?>
    <fieldset>
      <legend>
        <?php echo $nodeAspect->getDmsAspect()->getName(); ?>
        <?php echo link_to('X', 'ttDmsBrowser/removeAspect?nodeaspect_id=' . $nodeAspect->getId(), array('confirm' => 'Dit aspect en bijhorende gegevens verwijderen?')); ?>
      </legend>
      
      <table class="formtable">
        <?php foreach($nodeAspect->getDmsAspect()->getDmsAspectPropertyTypesJoinDmsPropertyType() as $aspectProperyType): ?>
        <tr>
          <th><?php echo $aspectProperyType->getDmsPropertyType()->getName(); ?></th>
          <td>
            <?php
              $propertyType = $aspectProperyType->getDmsPropertyType();
              
              switch($propertyType->getDataType())
              {
                case DmsPropertyTypePeer::TYPE_TEXT:
                  echo input_tag('input_' . $aspectProperyType->getId(), $node->getProperty($propertyType), array('style' => 'width: 300px;'));
                  break;
                case DmsPropertyTypePeer::TYPE_DATE:
                  echo input_date_tag('input_' . $aspectProperyType->getId(), $node->getProperty($propertyType), array('rich' => true, "calendar_button_img" => "calendar.gif"));
                  break;
                case DmsPropertyTypePeer::TYPE_TEXTAREA:
                  echo textarea_tag('input_' . $aspectProperyType->getId(), $node->getProperty($propertyType), array('style' => 'width: 300px; height: 80px;'));
                  break;
                case DmsPropertyTypePeer::TYPE_CHECKBOX:
                  echo select_tag('input_' . $aspectProperyType->getId(), options_for_select(array(0 => 'Ja', 1 => 'Nee'), $node->getProperty($propertyType)));
                  break;
                case DmsPropertyTypePeer::TYPE_SELECTLIST:
                  echo select_tag('input_' . $aspectProperyType->getId(), options_for_select(json_decode($propertyType->getOptions()), $node->getProperty($propertyType)));
                  break;
                case DmsPropertyTypePeer::TYPE_SQLSELECT:
                  foreach(myDbTools::getArrayFromSQL($propertyType->getOptions()) as $row)
                  {
                    // skip dubbele indexen
                    if (isset($selectOptions[$row[0]]))
                    {
                      continue;
                    }

                    switch (count($row))
                    {
                      case 1:
                        $selectOptions[$row[0]] = $row[0];
                        break;
                      case 2:
                        $selectOptions[$row[0]] = $row[1];
                        break;
                    }
                  }
                  echo select_tag('input_' . $aspectProperyType->getId(), options_for_select($selectOptions, $node->getProperty($propertyType)));
                  break;
                default:
                  echo  'Unknow type: ' . $aspectProperyType->getDmsPropertyType()->getName();
              }
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </fieldset>
    
    <?php endforeach; ?>
  
    <?php echo submit_tag('Opslaan');?>
    <?php echo button_to_function('Annuleren', 'closeNodeDetails();'); ?>
  </form>
  <?php 
  endif;
  ?>
  
</div>


<!-- wordt blijkbaar nergens gebruikt?
<h2 class="pageblock">Preview</h2>
<div class="pageblock">

</div>
-->