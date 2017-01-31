<?php


class DmsWsServerStorage extends DmsStorage
{
  /** @var DmsDiskStorage */
  private $diskStore;
  
  function initialize()
  {
    $this->diskStore = new DmsDiskStorage($this->options);
  }
  
  function copy(DmsNodeMetadata $fromMetadata, DmsNodeMetadata $toMetadata)
  {
    $result = $this->diskStore->copy($fromMetadata->getPath(), $toMetadata->getPath());
    $this->addNodeUpdatedEvent($toMetadata);
    
    return $result;
  }
  
  function write(DmsNodeMetadata $metadata, $data)
  {
    $result = $this->diskStore->write($metadata->getPath(), $data);
    $this->addNodeUpdatedEvent($metadata);
    
    return $result;
  }
  
  function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata)
  {
    $result = $this->diskStore->moveUploadedFile($requestFileName, $metadata->getPath());
    $this->addNodeUpdatedEvent($metadata);
    
    return $result;
  }
  
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    $result = $this->diskStore->loadFromFile($absoluteFilepath, $metadata->getPath());
    $this->addNodeUpdatedEvent($metadata);
    
    return $result;
  }
  
  function mkdir(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->mkdir($metadata->getPath());
  }
  
  function exists(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->exists($metadata->getPath());
  }
  
  function isDir(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->isDir($metadata->getPath());
  }
  
  function isFile(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->isFile($metadata->getPath());
  }
  
  function getSize(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->getSize($metadata->getPath());
  }
  
  function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    return $this->diskStore->rename($oldMetadata->getPath(), $newMetadata->getPath());
  }
  
  function listdir(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->listdir($metadata->getPath());
  }
  
  function read(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->read($metadata->getPath());
  }
  
  function output(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->output($metadata->getPath());
  }
  
  function unlink(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->unlink($metadata->getPath());
  }
  
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    return $this->diskStore->saveToFile($metadata->getPath(), $absoluteFilepath);
  }
  
  function getMimeType(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->getMimeType($metadata->getPath());
  }
  
  /**
   * Adds a DmsWsUpdated entry
   *
   * @param DmsNodeMetadata $metadata
   */
  private function addNodeUpdatedEvent(DmsNodeMetadata $metadata)
  {
    $wsUpdated = new DmsWsUpdated();
    $wsUpdated->setNodeId($metadata->getId());
    $wsUpdated->save();
  }
}