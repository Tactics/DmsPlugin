<?php

/**
 * Subclass for representing a row from the 'dms_property_type' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsPropertyType extends BaseDmsPropertyType
{
  /**
   * @return array[]Aspect
   */
  public function getRelatedAspects()
  {
    $c = new Criteria();
    $c->addJoin(DmsAspectPeer::ID, DmsAspectPropertyTypePeer::ASPECT_ID, Criteria::JOIN);
    $c->addJoin(DmsAspectPropertyTypePeer::TYPE_ID, DmsPropertyTypePeer::ID, Criteria::JOIN);
    $c->add(DmsPropertyTypePeer::ID, $this->getId());

    return DmsAspectPeer::doSelect($c);
  }

}

sfPropelBehavior::add('DmsPropertyType', array('updater_loggable'));
