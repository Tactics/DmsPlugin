<?php

/**
 * Subclass for performing query and update operations on the 'dms_property_type' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsPropertyTypePeer extends BaseDmsPropertyTypePeer
{
  const TYPE_TEXT = 'text';
  const TYPE_DATE = 'date';
  const TYPE_CHECKBOX = 'checkbox';
  const TYPE_TEXTAREA = 'textarea';
  
  
  static $data_types = 
    array(
      self::TYPE_TEXT => 'Tekstregel', self::TYPE_DATE => 'Datum', self::TYPE_CHECKBOX => 'Checkbox', self::TYPE_TEXTAREA => 'Tekstveld'
    );
  
  /**
   * 
   */
  public static function getDataTypes()
  {
    return self::$data_types;
  }

  /**
   * Geeft het property type met de gegeven system_name terug
   *
   * @param string $sys_name
   * @return \DmsPropertyType
   */
  public static function retrieveBySystemName($sys_name)
  {
    $c = new Criteria();
    $c->add(self::SYSTEM_NAME, $sys_name);

    return self::doSelectOne($c);
  }
}
