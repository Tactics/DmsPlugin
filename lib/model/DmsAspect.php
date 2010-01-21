<?php

/**
 * Subclass for representing a row from the 'dms_aspect' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsAspect extends BaseDmsAspect
{
  /**
   * Default weergave
   */
  public function __toString()
  {
    return $this->getName();
  }
}

sfPropelBehavior::add('DmsAspect', array('updater_loggable'));
