<?php

/**
 * Subclass for performing query and update operations on the 'dms_object_node_ref' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsObjectNodeRefPeer extends BaseDmsObjectNodeRefPeer
{
  /**
   * geeft object node ref terug op basis van
   * @param mixed $object
   * @return DmsObjectNodeRef
   */
  public static function retrieveByObject($object)
  {
    $c = new Criteria();
    $c->add(self::OBJECT_CLASS, get_class($object));
    $c->add(self::OBJECT_ID, $object->getId());

    return self::doSelectOne($c);
  }
}
