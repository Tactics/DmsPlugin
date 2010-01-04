<?php

/**
 * Subclass for representing a row from the 'dms_aspect_property_type' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsAspectPropertyType extends BaseDmsAspectPropertyType
{
}

sfPropelBehavior::add('DmsAspectPropertyType', array('act_as_sortable' => array('column' => 'volgorde', 'groupColumns' => array('aspect_id'))));
