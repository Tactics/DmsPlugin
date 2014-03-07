<?php

/**
 * Subclass for representing a row from the 'dms_node_property' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsNodeProperty extends BaseDmsNodeProperty
{
  
  /**
   * Zet de waarde van deze property
   * 
   * Afhankelijk van het datatype wordt de waarde in een ander dbveld opgeslagen
   */
  public function setValue($value)
  {
    $this->setBooleanValue(null);
    $this->setIntValue(null);
    $this->setFloatValue(null);
    $this->setStringValue(null);
    $this->setTextValue(null);
    
    switch($this->getDmsPropertyType()->getDataType())
    {
      case DmsPropertyTypePeer::TYPE_TEXT:
        return $this->setStringValue($value);
        
      case DmsPropertyTypePeer::TYPE_TEXTAREA:
        return $this->setTextValue($value);
        
      case DmsPropertyTypePeer::TYPE_CHECKBOX:
        return $this->setBooleanValue($value);
        
      case DmsPropertyTypePeer::TYPE_DATE:
        return $this->setStringValue($value);

      case DmsPropertyTypePeer::TYPE_SELECTLIST:
        return $this->setStringValue($value);

      case DmsPropertyTypePeer::TYPE_SQLSELECT:
        return $this->setStringValue($value);

      default:
        return $this->setStringValue('Unknow type: ' . $this->getTypeId());
    }
  }

  /**
   * Geeft de waarde van deze property
   *
   * Afhankelijk van het datatype wordt de waarde uit een ander dbveld opgehaald
   */
  public function getValue($formatted = false)
  {
    switch($this->getDmsPropertyType()->getDataType())
    {
      case DmsPropertyTypePeer::TYPE_TEXT:
        return $this->getStringValue();

      case DmsPropertyTypePeer::TYPE_TEXTAREA:
        return $this->getTextValue();

      case DmsPropertyTypePeer::TYPE_CHECKBOX:
        return $this->getBooleanValue();

      case DmsPropertyTypePeer::TYPE_DATE:
        sfLoader::loadHelpers(array('Date'));
        return $formatted
          ? format_date($this->getStringValue(), 'dd/MM/yyyy')
          : $this->getStringValue();

      case DmsPropertyTypePeer::TYPE_SELECTLIST:
        if ($formatted)
        {
          $options = json_decode($this->getDmsPropertyType()->getOptions());
        }
        return $formatted && isset($options[$this->getStringValue()]) ? $options[$this->getStringValue()] : $this->getStringValue();
      case DmsPropertyTypePeer::TYPE_SQLSELECT:
        if($formatted)
        {
          $selectOptions = array();
          foreach(myDbTools::getArrayFromSQL($this->getDmsPropertyType()->getOptions()) as $row)
          {
            switch (count($row))
            {
              case 1:
                $selectOptions[$row[0]] = $row[0];
                break;
              case 2:
                $selectOptions[$row[0]] = $row[1];
                break;
            }
          }
        }
        return $formatted ? $selectOptions[$this->getStringValue()] : $this->getStringValue();
    }
  }
}

sfPropelBehavior::add('DmsNodeProperty', array('updater_loggable'));