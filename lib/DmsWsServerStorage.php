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
    $result = $this->diskStore->copy($fromMetadata, $toMetadata);
    $this->addNodeUpdatedEvent($toMetadata);
    
    return $result;
  }
  
  function write(DmsNodeMetadata $metadata, $data)
  {
    $result = $this->diskStore->write($metadata, $data);
    $this->addNodeUpdatedEvent($metadata);
    
    return $result;
  }
  
  function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata)
  {
    $result = $this->diskStore->moveUploadedFile($requestFileName, $metadata);
    $this->addNodeUpdatedEvent($metadata);
    
    return $result;
  }
  
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    $result = $this->diskStore->loadFromFile($absoluteFilepath, $metadata);
    $this->addNodeUpdatedEvent($metadata);
    
    return $result;
  }
  
  function mkdir(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->mkdir($metadata);
  }
  
  function exists(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->exists($metadata);
  }
  
  function isDir(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->isDir($metadata);
  }
  
  function isFile(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->isFile($metadata);
  }
  
  function getSize(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->getSize($metadata);
  }
  
  function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    return $this->diskStore->rename($oldMetadata, $newMetadata);
  }
  
  function listdir(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->listdir($metadata);
  }
  
  function read(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->read($metadata);
  }
  
  function output(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->output($metadata);
  }
  
  function unlink(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->unlink($metadata);
  }
  
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    return $this->diskStore->saveToFile($metadata, $absoluteFilepath);
  }
  
  function getMimeType(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->getMimeType($metadata);
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