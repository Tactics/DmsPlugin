<?php

/**
 * Subclass for performing query and update operations on the 'dms_store' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsStorePeer extends BaseDmsStorePeer
{
  /**
   * Return DmsStore by name
   *
   * @return DmsStore
   */
  public static function retrieveByName($name)
  {
    $c = new Criteria();
    $c->add(DmsStorePeer::NAME, $name);

    return self::doSelectOne($c);
  }
}
