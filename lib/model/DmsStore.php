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
            $storageRootFolder = sfConfig::get('sf_data_dir') . '/' . $uri['host'] . $uri['path'];
            $this->_storage = new DmsDiskStorage(array('root' => $storageRootFolder));
            break;

          case 'sfweb':
            $storageRootFolder = sfConfig::get('sf_web_dir') . '/' . $uri['host'] . $uri['path'];
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
    $name = DmsTools::safeFilename($name);

    try
    {
      $this->getStorage()->mkdir($name);
    }
    catch (DmsFolderExistsException $exception)
    {
      // do nothing, folder exists.
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

  /**
   * Geeft een node in de root van deze store op basis van de opgegeven naam
   *
   * @param string $name
   */
  public function getChildByName($name)
  {
    $c = new Criteria();

    $c->add(DmsNodePeer::STORE_ID, $this->getId());
    $c->add(DmsNodePeer::PARENT_ID, null);
    $c->add(DmsNodePeer::NAME, $name);

    return DmsNodePeer::doSelectOne($c);
  }

  /**
   * Geeft een node in de root van deze store op basis van de opgegeven naam op schijf
   *
   * @param string $diskname
   */
  public function getChildByDiskName($diskname)
  {
    $c = new Criteria();

    $c->add(DmsNodePeer::STORE_ID, $this->getId());
    $c->add(DmsNodePeer::PARENT_ID, null);
    $c->add(DmsNodePeer::DISK_NAME, $diskname);

    return DmsNodePeer::doSelectOne($c);
  }

  /**
   * Geeft de store terug
   */
  public function getStore()
  {
    return $this;
  }


}

sfPropelBehavior::add('DmsStore', array('updater_loggable'));