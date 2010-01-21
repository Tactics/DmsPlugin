<?php

/**
 * Subclass for representing a row from the 'dms_object_node_ref' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsObjectNodeRef extends BaseDmsObjectNodeRef
{
}

sfPropelBehavior::add('DmsObjectNodeRef', array('updater_loggable'));
sfPropelBehavior::add('DmsObjectNodeRef', array('related_object'));