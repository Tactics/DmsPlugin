<?php

/**
 * Subclass for representing a row from the 'dms_store' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsStore extends BaseDmsStore
{
  private $_storage = null;
  
  /**
   * Geeft de geconfigureerde 
   * 
   * @return DmsStorage
   */
  public function getStorage()
  {
    if (! $this->_storage)
    {
      if ($uri = @parse_url($this->getUri()))
      {
        switch($uri['scheme'])
        {
          case 'sfdata':
            $storageRootFolder = sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $uri['host'] . $uri['path']);
            $this->_storage = new DmsDiskStorage(array('root' => $storageRootFolder));
            break;
        }
      }
    
      if (! $this->_storage)
      {
        throw sfException('Ongeldige DMS storage configuratie');
      }
    }
    
    return $this->_storage;
  }
  
  
  
  /**
   * Geeft alle nodes in de root v/d store terug
   */
  public function getChildNodes($c = null)
  {
    if ($c === null)
    {
      $c = new Criteria();  
    }
    
    if (! $c->getOrderByColumns())
    {
      $c->addAscendingOrderByColumn(DmsNodePeer::NAME);
    }
    
    $c->add(DmsNodePeer::STORE_ID, $this->getId());
    $c->add(DmsNodePeer::PARENT_ID, null);
    
    return DmsNodePeer::doSelect($c);
  }
  
  /**
   * Maakt een nieuwe folder
   */
  public function createFolder($name)
  {
    try
    {
      $this->getStorage()->mkdir($name);
    }
    catch(sfException $e)
    {
      echo $e->getMessage();
      return false;
    }
    
    $folder = new DmsNode();
    $folder->setName($name);
    $folder->setDiskName($name);
    $folder->setStoreId($this->getId());
    $folder->setParentId(null);
    $folder->setIsFolder(true);
    $folder->save();
    
    return $folder;
    
  }
}
