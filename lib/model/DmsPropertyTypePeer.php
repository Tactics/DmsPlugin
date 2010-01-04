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
  
}
