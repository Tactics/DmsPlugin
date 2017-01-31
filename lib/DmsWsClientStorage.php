<?php


class DmsWsClientStorage extends DmsStorage
{
  /** @var DmsDiskStorage */
  private $diskStore;
  private $wsUrl;
  
  function initialize()
  {
    $this->diskStore = new DmsDiskStorage($this->options);
    $this->wsUrl = sfConfig::get('sf_dms_ws_url');
    if (!$this->wsUrl){
      throw new sfConfigurationException('sf_dms_ws_url config not found in config/settings.yml');
    }
  }
  
  function output(DmsNodeMetadata $metadata)
  {
    if (! $this->exists($metadata)){
      // file does not exist => get it via ws
      $url = sprintf("%s/getActiviteitNode?id=%u", $this->wsUrl, $metadata->getId());
      // write it locally
      $this->write($metadata, file_get_contents($url));
    }
  
    return $this->diskStore->output($this->getPathForMetadata($metadata));
  }
  
  function exists(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->exists($this->getPathForMetadata($metadata));
  }
  
  function write(DmsNodeMetadata $metadata, $data)
  {
    $this->diskStore->write($this->getPathForMetadata($metadata), $data);
  }
  
  
  // volgens mij is rest voorlopig niet nodig
  function copy(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function mkdir(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function isDir(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function isFile(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function getSize(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function listdir(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function read(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function unlink(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function getMimeType(DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  private function throwMethodNotImplementedYetException($methodName)
  {
    throw new sfException(sprintf("%s: method %s not implemented yet.", get_class($this), $methodName));
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   */
  private function getPathForMetadata(DmsNodeMetadata $metadata)
  {
    return sprintf("/%u_%s.bin", $metadata->getId(), $metadata->getLastUpdatedTimestamp());
  }
}