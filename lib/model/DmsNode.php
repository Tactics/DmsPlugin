<?php

/**
 * Subclass for representing a row from the 'dms_node' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsNode extends BaseDmsNode
{
  /**
   * Geeft de parent node
   * 
   * @return Node
   */
  public function getParentNode()
  {
    return $this->getParentId() ? $this->getDmsNodeRelatedByParentId() : null;
  }
  
  /**
   * Geeft de onderliggende nodes, standaard alfabetisch gesorteerd
   * 
   * @return array
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
    
    return $this->getDmsNodesRelatedByParentIdJoinDmsStore($c);
  }

  /**
   * Geeft de onderliggende node met de opgegeven naam
   * 
   * @param string $name
   * @param Criteria $name optional
   * 
   * @return DmsNode
   */
  public function getChildByName($name, Criteria $c = null)
  {
    if (!$c)
    {
      $c = new Criteria();
    }
    
    $c->add(DmsNodePeer::STORE_ID, $this->getStoreId());
    $c->add(DmsNodePeer::NAME, $name);
    $c->add(DmsNodePeer::PARENT_ID, $this->getId());
    
    return DmsNodePeer::doSelectOne($c);
  }

  /**
   * Geeft de onderliggende node met de opgegeven naam op schijf
   * 
   * @param string $diskname
   * 
   * @return DmsNode
   */
  public function getChildByDiskName($diskname)
  {
    $c = new Criteria();
    
    $c->add(DmsNodePeer::STORE_ID, $this->getStoreId());
    $c->add(DmsNodePeer::DISK_NAME, $diskname);
    $c->add(DmsNodePeer::PARENT_ID, $this->getId());
    
    return DmsNodePeer::doSelectOne($c);
  }
   
  /**
   * Geeft het pad als een array met alle parentobjecten of 
   * als array met het resultaat van een functie op de parentobjecten
   * 
   * @return array DmsNode
   */
  public function getPath($classFtie = null)
  {
    $parent = $this->getParentNode();
    
    return ($parent ? array_merge($parent->getPath($classFtie), array($classFtie ? $parent->$classFtie() : $parent)) : array());
  }
  
  /**
   * Geeft het volledige storage path van deze node
   * 
   * @return string
   */
  public function getStoragePath()
  {
    if (! $this->getDiskName())
    {
      throw new sfException('Geen naam gezet voor deze node');
    }
    
    $parent = $this->getParentNode();
    
    return ($parent ? $parent->getStoragePath() : '') . '/' . $this->getDiskName();
  }

  /**
   * Maakt een nieuwe subfolder
   * 
   * @param string $name
   * 
   * @return DmsNode
   *
   * @throws DmsNodeExistsException
   */
  public function createFolder($name)
  {
    return $this->createNode($name, true);
  }
  
  /**
   * Maakt een nieuwe subnode (geen folder)
   * 
   * @param string $name
   * 
   * @return DmsNode
   *
   * @throws DmsNodeExistsException
   */
  public function createNode($name, $folder = false)
  {
    // Controleer of er reeds een node bestaat met exact dezelfde naam (speciale characters ..)
    if ($this->getChildByName($name))
    {
      throw new DmsNodeExistsException('A node with this name already exists. (Name: ' . $name . ')');
    }

    // Controleer of er reeds een node bestaat met dezelfde diskname: zoek een ongebruikte diskname
    $safeName = DmsTools::safeFilename($name);
    $extension = pathinfo($safeName, PATHINFO_EXTENSION);
    $basename = basename($safeName, $extension ? ('.' . $extension) : '');
    
    $maxFilenameLength = sfConfig::get('sf_dms_filename_maxlength', 255);    
    $basename = substr($basename, 0, min(strlen($basename), $maxFilenameLength - strlen($extension) - 1));
    $safeName = $basename . ($extension ? ('.' . $extension) : '');    
    
    $c = 1;
    
    while ($this->getChildByDiskName($safeName))
    {
      $safeName = $basename . '_' . $c . ($extension ? ('.' . $extension) : '');
      $c++;
    }

    if ($folder)
    {
      $this->getDmsStore()->getStorage()->mkdir($this->getStoragePath() . '/' . $safeName);
    }
    
    $node = new DmsNode();
    $node->setName($name);
    $node->setDiskName($safeName);
    $node->setStoreId($this->getStoreId());
    $node->setParentId($this->getId());
    $node->setIsFolder($folder);
    
    $node->save();
    
    return $node;
  }
  
  /**
   * Maakt een nieuwe subnode op basis van een geuploaded bestand
   *
   * @param string $file_id : id of the HTML upload component
   * @param string optional $fileName: name for the uploaded file.  Defaults to the original uploaded file name
   * @param boolean optional $autoRename default false: auto numbering if file exists
   */
  public function createNodeFromUpload($file_id, $fileName = null, $autoRename = false)
  {
    $fileName = $fileName ? $fileName : sfContext::getInstance()->getRequest()->getFileName($file_id);

    // Info voor mocht het bestand reeds bestaan, dan beginnen we te nummeren
    $success = false;
    $cnt = 1;

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $basename = basename($fileName, $extension ? ('.' . $extension) : '');

    while (! $success)
    {
      try
      {
        $node = $this->createNode($fileName);
        $success = true;
      }
      catch(DmsNodeExistsException $e)
      {
        if (! $autoRename)
        {
          throw($e);
        }
        // bestand bestaat al, begin te nummeren
        $fileName = $basename . '_' . $cnt . ($extension ? ('.' . $extension) : '');
        $cnt++;
      }
    }

    $node->moveUploadedFile($file_id);
    
    return $node;
  }
  
  /**
   * Hernoemt de node
   * 
   * @param string $newName
   */
  public function rename($newName)
  {
    if ($newName == $this->getName())
    {
      return;
    }

    // Controleer of er reeds een node bestaat met exact dezelfde naam (speciale characters ..)
    $existingNode = $this->getChildByName($newName);
    if ($existingNode && $existingNode->getId() != $this->getId())
    {
      throw new DmsNodeExistsException('A node with this name already exists. (Name: ' . $name . ')');
    }

    // Controleer of er reeds een node bestaat met dezelfde diskname: zoek een ongebruikte diskname
    $safeName = DmsTools::safeFilename($newName);
    $maxFilenameLength = sfConfig::get('sf_dms_filename_maxlength', 30);
    if ($this->getIsFolder())
    {
      $safeName = substr($safeName, 0, min(strlen($safeName), $maxFilenameLength)); 
    }
    else
    {
      $extension = pathinfo($safeName, PATHINFO_EXTENSION);
      $basename = basename($safeName, $extension ? ('.' . $extension) : '');
       
      $basename = substr($basename, 0, min(strlen($basename), $maxFilenameLength - strlen($extension) - 1));   
      $safeName = $basename . ($extension ? ('.' . $extension) : '');    
    }
    
    $c = 1;

    while (($existingNode = $this->getChildByDiskName($safeName)) && $existingNode->getId() != $this->getId())
    {
      $safeName = $basename . '_' . $c . ($extension ? ('.' . $extension) : '');
      $c++;
    }

    $oldPath = $this->getStoragePath();
    $newPath = dirname($oldPath) . '/' . $safeName;

    $this->getDmsStore()->getStorage()->rename($oldPath, $newPath);

    $this->setName($newName);
    $this->setDiskName($safeName);
    $this->save();
    
    return $this;
  }
  
  /**
   * Verplaatst de node naar een andere folder
   * 
   * @param DmsNode $targetNode
   */
  public function move($targetNode)
  {
    $oldPath = $this->getStoragePath();
    $newPath = $targetNode->getStoragePath() . '/' . $this->getDiskName();
    
    $this->getDmsStore()->getStorage()->rename($oldPath, $newPath);
    
    $this->setParentId($targetNode->getId());
    $this->save();
  }
  
  /**
   * Verwijdert deze node (en eventuele onderliggende nodes)
   * 
   * @param Connection $con
   */
  public function delete($con = null)
  {
    // Eerst child nodes verwijderen
    if ($this->getIsFolder())
    {
      foreach($this->getChildNodes() as $node)
      {
        $node->delete();
      }
    }
    
    // Dan huidige node
    $this->getDmsStore()->getStorage()->unlink($this->getStoragePath());
    return parent::delete($con);
  }
  
  
  /**
   * Schrijft data 
   * 
   * @param mixed $data
   */
  public function write($data)
  {
    $this->getDmsStore()->getStorage()->write($this->getStoragePath(), $data);
  }

  /**
   * Leest de data uit het bestand
   * 
   * @return mixed
   */
  public function read()
  {
    return $this->getDmsStore()->getStorage()->read($this->getStoragePath());
  }
  
  /**
   * Verplaatst een geuploaded bestand naar deze node
   * 
   * @param string $file_id File upload id
   */
  public function moveUploadedFile($file_id)
  {
    $this->getDmsStore()->getStorage()->moveUploadedFile($file_id, $this->getStoragePath());
  }

  /**
   * Exporteert de node naar een bestandslocatie
   *
   * @param string $file_id File upload id
   */
  public function saveToFile($filePath)
  {
    $this->getDmsStore()->getStorage()->saveToFile($this->getStoragePath(), $filePath);
  }

  /**
   * Exporteert de node naar een bestandslocatie
   *
   * @param string $file_id File upload id
   */
  public function loadFromFile($filePath)
  {
    $this->getDmsStore()->getStorage()->loadFromFile($filePath, $this->getStoragePath());
  }

  /**
   * Geeft het mimetype terug
   * 
   * @return string
   */
  public function getMimeType()
  {
    return $this->getDmsStore()->getStorage()->getMimeType($this->getStoragePath());
  }
  
  /**
   * Geeft de bestandsextentie
   * 
   * @return string
   */
  public function getExtension()
  {
    $info = pathinfo($this->getName());
    
    return isset($info['extension']) ? $info['extension'] : null;
  }
  
  /**
   * Geeft de grootte van de node
   * 
   * @return integer (grootte in bytes)
   */
  public function getSize()
  {
    return $this->getDmsStore()->getStorage()->getSize($this->getStoragePath());
  }

  /**
   * Stuur inhoud naar output
   * 
   * @param boolean $includeHeaders : default false
   */
  public function output($includeHeaders = false)
  {
    if ($includeHeaders)
    {
      $response = sfContext::getInstance()->getResponse();
      $response->clearHttpHeaders();
      $response->setHttpheader('Pragma: public', true);
      $response->addCacheControlHttpHeader('Cache-Control', 'must-revalidate');
      $response->setHttpHeader('Expires', gmdate("D, d M Y H:i:s", time()) . " GMT");
      $response->setHttpHeader('Content-Description', 'File Transfer');

      if ($mime_type = $this->getMimeType())
      {
        $response->setContentType($mime_type, true);
      }

      $response->setHttpHeader('Content-Length', (string)($this->getSize()));
      $response->setHttpHeader('Last-modified', gmdate("D, d M Y H:i:s", $this->getUpdatedAt(null)) . " GMT");
      $response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $this->getName() . '"');
      $response->sendHttpHeaders();      
    }
    
    return $this->getDmsStore()->getStorage()->output($this->getStoragePath());
  }
  
  /**
   * Voegt een aspect toe aan deze node
   * 
   * @param DmsAspect $aspect
   */
  public function addAspect($aspect)
  {
    // Controle dubbele
    $c = new Criteria();
    $c->add(DmsNodeAspectPeer::ASPECT_ID, $aspect->getId());
    
    if ($this->countDmsNodeAspects($c))
    {
      return;
    }
    
    $nodeAspect = new DmsNodeAspect();
    $nodeAspect->setAspectId($aspect->getId());
    $nodeAspect->setNodeId($this->getId());
    $nodeAspect->save();
  }
  
  /**
   * Verwijdert een aspect en alle waarden op de huidige node voor propertytypes
   * die enkel aan het te verwijderen aspect gekoppeld zijn
   * 
   * @param DmsNodeAspect $aspect Het van deze node te verwijderen aspect
   */
  public function removeAspect($aspect)
  {
    // Te verwijderen properties = properties van het aspect
    $teVerwijderen = array();
    foreach($aspect->getDmsAspectPropertyTypes() as $t)
    {
      $teVerwijderen[$t->getTypeId()] = $t->getTypeId();
    }
    
    // Niet te verwijderen zijn de properties van het te verwijderen aspect
    // die ook nog in een ander aspect voorkomen
    foreach($this->getDmsNodeAspectsJoinDmsAspect() as $nodeAspect)
    {
      if ($nodeAspect->getAspectId() != $aspect->getId())
      {
        foreach($nodeAspect->getDmsAspect()->getDmsAspectPropertyTypes() as $t)
        {
          unset($teVerwijderen[$t->getTypeId()]);
        }
      }
    }
    
    // Verwijder properties
    $c = new Criteria();
    $c->add(DmsNodePropertyPeer::NODE_ID, $this->getId());
    $c->add(DmsNodePropertyPeer::TYPE_ID, $teVerwijderen, Criteria::IN);
    DmsNodePropertyPeer::doDelete($c);

    // Verwijder aspect
    $c = new Criteria();
    $c->add(DmsNodeAspectPeer::ASPECT_ID, $aspect->getId());
    $c->add(DmsNodeAspectPeer::NODE_ID, $this->getId());
    DmsNodeAspectPeer::doDelete($c);
  }
  
  /**
   * Zet een property op de node
   * 
   * @param DmsPropertyType $propertyType Het te zetten type
   * @param mixed $value De te zetten waarde, null wist de waarde en daarme de tabelrij waarin de waarde wordt opgeslagen
   * @param boolean $îsUserInput Indien true wordt $value nog ge parsed als userinput (culture etc)
   */
  public function setProperty($propertyType, $value, $isUserInput = true)
  {
    $c = new Criteria();
    $c->add(DmsNodePropertyPeer::TYPE_ID, $propertyType->getId());
    $c->add(DmsNodePropertyPeer::NODE_ID, $this->getId());
    
    if (! $property = DmsNodePropertyPeer::doSelectOne($c))
    {
      $property = new DmsNodeProperty();
      $property->setTypeId($propertyType->getId());
      $property->setNodeId($this->getId());
    }
    
    if ($isUserInput)
    {
      switch($propertyType->getDataType())
      {
        case DmsPropertyTypePeer::TYPE_DATE:
          $value = myDateTools::cultureDateToPropelDate($value);
          break;
        default:
          break;
      }
    }
    
    if ($value !== null)
    {
      $property->setValue($value);
      $property->save();
    }
    else
    {
      $property->delete();
    }
  }

  /**
   * Geeft de waarde van een property
   * 
   * @param DmsPropertyType $propertyType
   * 
   * @return mixed
   */
  public function getProperty($propertyType)
  {
    $c = new Criteria();
    $c->add(DmsNodePropertyPeer::TYPE_ID, $propertyType->getId());
    $c->add(DmsNodePropertyPeer::NODE_ID, $this->getId());
    
    $property = DmsNodePropertyPeer::doSelectOne($c);
    
    if (! $property)
    {
      return null;
    }
    
    return $property->getValue();
  }

  
  /**
   * Voegt deze node toe aan de opgegeven zipfile
   * indien deze node een folder is, wordt de folder met alle inhoud toegevoegd
   * parameter recursive geeft aan of ook de subfolders dan nog toegevoegd moeten worden
   * 
   * @param ZipArchive $zip
   * @param string $path (folder in the zip to put this node in)
   * @param boolean $recursive default false
   */
  public function addToZip(&$zip, $path = "", $recursive = false)
  {
    if (! $this->getIsFolder())
    {
      // if this node is a file: just add it to the zip in the correct folder (path)
      $zip->addFromString($path . $this->getName(), $this->read());  
    }
    else
    {
      // if this node is a folder: create the folder in the zip file
      $zip->addEmptyDir($path . $this->getName());
      
      // and add all subnodes
      foreach($this->getChildNodes() as $node)
      {
        // add all files
        if (! $node->getIsFolder())
        {
          $node->addToZip($zip, $path . $this->getName() . '/');
        }
        // add sub
        else if ($recursive)
        {
          $node->addToZip($zip, $path . $this->getName() . '/', true);
        }
      }
    }
  }

}

sfPropelBehavior::add('DmsNode', array('updater_loggable'));