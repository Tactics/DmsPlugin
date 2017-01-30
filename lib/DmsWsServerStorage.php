<?php


class DmsWsServerStorage extends DmsStorage
{
  /** @var DmsDiskStorage */
  private $diskStore;
  
  public function __construct(array $options = array())
  {
    $this->diskStore = new DmsDiskStorage($options);
  }
  
  private function addNodeUpdatedEvent(DmsNodeMetadata $metadata)
  {
    $wsUpdated = new DmsWsUpdated();
    $wsUpdated->setNodeId($metadata->getId());
    $wsUpdated->save();
  }
  
  function initialize()
  {
    $this->diskStore->initialize();
  }
  
  function copy(DmsNodeMetadata $fromMetadata, DmsNodeMetadata $toMetadata)
  {
    $this->diskStore->copy($fromMetadata, $toMetadata);
    $this->addNodeUpdatedEvent($toMetadata);
  }
  
  function mkdir(DmsNodeMetadata $metadata)
  {
    $this->diskStore->mkdir($metadata);
  }
  
  function exists(DmsNodeMetadata $metadata)
  {
    $this->diskStore->exists($metadata);
  }
  
  function isDir(DmsNodeMetadata $metadata)
  {
    $this->diskStore->isDir($metadata);
  }
  
  function isFile(DmsNodeMetadata $metadata)
  {
    $this->diskStore->isFile($metadata);
  }
  
  function getSize(DmsNodeMetadata $metadata)
  {
    $this->diskStore->getSize($metadata);
  }
  
  function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    $this->diskStore->rename($oldMetadata, $newMetadata);
  }
  
  function listdir(DmsNodeMetadata $metadata)
  {
    $this->diskStore->listdir($metadata);
  }
  
  function read(DmsNodeMetadata $metadata)
  {
    $this->diskStore->read($metadata);
  }
  
  function output(DmsNodeMetadata $metadata)
  {
    $this->diskStore->output($metadata);
  }
  
  function unlink(DmsNodeMetadata $metadata)
  {
    $this->diskStore->unlink($metadata);
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
  
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    $this->diskStore->saveToFile($metadata, $absoluteFilepath);
  }
  
  function getMimeType(DmsNodeMetadata $metadata)
  {
    $this->diskStore->getMimeType($metadata);
  }
}