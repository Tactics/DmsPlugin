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
    $c = $c ? clone $c : new Criteria();

    $options = array();

    foreach(self::doSelect($c) as $aspect)
    {
      $options[$aspect->getId()] = $aspect->getName();
    }

    return $options;
  }

  /**
   * Geeft het aspect met de gegeven system_name terug
   * 
   * @param string $sys_name
   * @return \DmsAspect
   */
  public static function retrieveBySystemName($sys_name)
  {
    $c = new Criteria();
    $c->add(self::SYSTEM_NAME, $sys_name);

    return self::doSelectOne($c);
  }


}
