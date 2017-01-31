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
    $this->diskStore->copy($fromMetadata, $toMetadata);
    $this->addNodeUpdatedEvent($toMetadata);
  }
  
  function write(DmsNodeMetadata $metadata, $data)
  {
    $this->diskStore->write($metadata, $data);
    $this->addNodeUpdatedEvent($metadata);
  }
  
  function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata)
  {
    $this->diskStore->moveUploadedFile($requestFileName, $metadata);
    $this->addNodeUpdatedEvent($metadata);
  }
  
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    $this->diskStore->loadFromFile($absoluteFilepath, $metadata);
    $this->addNodeUpdatedEvent($metadata);
  }
  
  function mkdir(DmsNodeMetadata $metadata)
  {
    $this->diskStore->mkdir($metadata);
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
    $this->diskStore->rename($oldMetadata, $newMetadata);
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
    $this->diskStore->output($metadata);
  }
  
  function unlink(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->unlink($metadata);
  }
  
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    $this->diskStore->saveToFile($metadata, $absoluteFilepath);
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