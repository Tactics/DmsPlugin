<?php
/**
 * @package    symfony
 * @subpackage ttDmsHasStorageBehavior
 * @author     Gert Vrebos <gert.vrebos@tactics.be>
 */
 
/**
 * ttDmsStorageBehavior
 * 
 * Met dit behavior koppel je een DmsNode (storage folder) aan een object, de folder
 * wordt automatisch aangemaakt in een door het object opgegeven parent folder en met een
 * door het object opgegeven naam.
 * 
 * Via de auto_rename optie kan de folder ook automatisch hernoemt worden zodra het object
 * opgeslagen wordt (postSave) en een nieuwe foldernaam opgeeft via folder_name_function
 * 
 * behavior parameters zijn:
 *  folder_name_function, default: 'getDmsStorageParentFolder'
 *  parent_folder_function, default: 'getDmsStorageFolderName'
 *  auto_rename, default: true
 * 
 * @package CSJ
 * @author Tactics bvba
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class ttDmsStorageBehavior
{
  
  /**
   * Geeft de storagenode van dit object (en maakt deze optioneel zelfs aan)
   * 
   * @param bool $autoCreate
   * 
   * @return DmsNode
   */
  public function getDmsStorageFolder($object, $autoCreate = true)
  {

    $c = new Criteria();
    $c->add(DmsObjectNodeRefPeer::OBJECT_CLASS, get_class($object));
    $c->add(DmsObjectNodeRefPeer::OBJECT_ID, $object->getPrimaryKey());
    $c->setLimit(1);
    
    $ref = DmsObjectNodeRefPeer::doSelectJoinDmsNode($c);


    // Node bestaat reeds: geef deze terug
    if (count($ref) && $ref = reset($ref))
    {
      return $ref->getDmsNode();
    }
    if (! $autoCreate)
    {
      return null;
    }

    // Node bestaat nog niet: aanmaken
    $parentDmsNode = $object->getDmsStorageParentFolder();

    // Probleem bij fetchen parentnode
    if (! $parentDmsNode)
    {
      $objStr = '';
      
      if (method_exists($object, '__toString'))
      {
        $objStr = '"' . $object->__toString() . '"';
      }
      else if (method_exists($object, 'getId'))
      {
        $objStr = 'with id ' . $object->getId();
      }

     throw new sfException('Could not retrieve parentDmsNode from ' . get_class($object) . ' ' . $objStr);
    }
    
    $folder = $parentDmsNode->createFolder($object->getDmsStorageFolderName());
    
    $ref = new DmsObjectNodeRef();
    $ref->setObject($object);
    $ref->setNodeId($folder->getId());
    $ref->save();
    
    return $folder;
  }
  
  /**
   * Geeft aan of er reeds een storage node gekoppeld is aan dit object
   *
   * @return boolean
   */
  public function hasDmsStorageFolder($object)
  {
    $c = new Criteria();
    $c->add(DmsObjectNodeRef::OBJECT_CLASS, get_class($object));
    $c->add($object->getPrimaryKey());
    $c->setLimit(1);
  
    return (boolean) DmsObjectNodeRefPeer::doCount($c);
  }

  /**
   * Hernoemt de storage folder naar de opgegeven naam of automatisch
   * door de 'folder_name_function' op te roepen
   */
  public function renameDmsStorageFolder($object, $name = '$_auto_$', $autoCreate = false)
  {
    if ($name == '$_auto_$')
    {
      $name = $object->getDmsStorageFolderName();
    }
    
    $folder = self::getDmsStorageFolder($object, $autoCreate);

    if ($folder && ($name != $folder->getName()))
    {
      $folder->rename($name);
    }
  }

  /**
   * Hernoemt na opslaan eventueel de naam van de storage folder
   * 
   * Configureerbaar door de auto_rename parameter
   *
   * @param mixed sortable object
   * @param Connection an optional connection object
   *
   **/  
  public function postSave($object, $con = null)
  {
    if (sfConfig::get('propel_behavior_storage'.get_class($object).'_auto_rename', true))
    {
      self::renameDmsStorageFolder($object);
    }
  }

  /**
   * Verwijdert eventuele storage links alvorens het object zelf te verwijderen
   *
   * @param mixed sortable object
   * @param Connection an optional connection object
   *
   **/  
  public function preDelete($object, $con = null)
  {  
    $c = new Criteria();
    $c->add(DmsObjectNodeRefPeer::OBJECT_CLASS, get_class($object));
    $c->add(DmsObjectNodeRefPeer::OBJECT_ID, $object->getPrimaryKey());
    
    DmsObjectNodeRefPeer::doDelete($c);
  }
}
