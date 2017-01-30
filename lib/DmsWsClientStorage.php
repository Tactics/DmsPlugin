<?php


class DmsWsClientStorage extends DmsStorage
{
  /** @var DmsDiskStorage */
  private $diskStore;
  
  function initialize()
  {
    $this->diskStore = new DmsDiskStorage($this->options);
  }
  
  function copy(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    // TODO: Implement copy() method.
  }
  
  function mkdir(DmsNodeMetadata $metadata)
  {
    // TODO: Implement mkdir() method.
  }
  
  function exists(DmsNodeMetadata $metadata)
  {
    // TODO: Implement exists() method.
  }
  
  function isDir(DmsNodeMetadata $metadata)
  {
    // TODO: Implement isDir() method.
  }
  
  function isFile(DmsNodeMetadata $metadata)
  {
    // TODO: Implement isFile() method.
  }
  
  function getSize(DmsNodeMetadata $metadata)
  {
    // TODO: Implement getSize() method.
  }
  
  function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    // TODO: Implement rename() method.
  }
  
  function listdir(DmsNodeMetadata $metadata)
  {
    // TODO: Implement listdir() method.
  }
  
  function read(DmsNodeMetadata $metadata)
  {
    // TODO: Implement read() method.
  }
  
  function output(DmsNodeMetadata $metadata)
  {
    // TODO: Implement output() method.
  }
  
  function unlink(DmsNodeMetadata $metadata)
  {
    // TODO: Implement unlink() method.
  }
  
  function write(DmsNodeMetadata $metadata, $data)
  {
    // TODO: Implement write() method.
  }
  
  function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata)
  {
    // TODO: Implement moveUploadedFile() method.
  }
  
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    // TODO: Implement loadFromFile() method.
  }
  
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    // TODO: Implement saveToFile() method.
  }
  
  function getMimeType(DmsNodeMetadata $metadata)
  {
    // TODO: Implement getMimeType() method.
  }
}