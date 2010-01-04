<?php echo include_partial('breadcrumb', array('actie' => 'Types')); ?>

<h2 class="pageblock">Dms propertytypes</h1>
<div class="pageblock">
<?php

$table = new myTable(array(
  array('name' => DmsPropertyTypePeer::NAME, 'text' => 'Naam'),
  array('text' => 'Acties', 'width' => 40, 'align' => 'center')
));

foreach ($pager->getResults() as $dms_type)
{
  $table->addRow(array(
    link_to($dms_type->getName(), 'ttDmsAspect/editType?id='.$dms_type->getId()),
    link_to(image_tag('icons/bewerk.16.png'), 'ttDmsAspect/editType?id='.$dms_type->getId())
  ));
}

echo $table;

?>
</tbody>
</table>
<hr />
<?php echo button_to ('Nieuw type', 'ttDmsAspect/createType') ?>
</div>