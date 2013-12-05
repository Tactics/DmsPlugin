<?php

/**
 * Subclass for performing query and update operations on the 'dms_aspect' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsAspectPeer extends BaseDmsAspectPeer
{
  public static function getOptionsForSelect($c = null)
  {
    $c = $c ? $c : new Criteria();

    $options = array();

    foreach(self::doSelect($c) as $aspect)
    {
      $options[$aspect->getId()] = $aspect->getName();
    }

    return $options;
  }
}
