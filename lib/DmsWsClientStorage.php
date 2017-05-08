<?php


class DmsWsClientStorage extends DmsStorage
{
  /** @var DmsDiskStorage */
  private $diskStore;
  private $wsUrl;
  /** @var  DmsDiskCache */
  private $cache;

  function initialize()
  {
    $this->diskStore = new DmsDiskStorage($this->options);
    $this->wsUrl = sfConfig::get('sf_dms_ws_url');
    if (!$this->wsUrl){
      throw new sfConfigurationException('sf_dms_ws_url config not found in config/settings.yml');
    }
    $this->cache = new DmsDiskCache($this->options);
  }

  function output(DmsNodeMetadata $metadata)
  {
    $WsClientMetadata = $this->getWsClientMetadataForMetadata($metadata);
    if (! $this->cache->has($WsClientMetadata->getPath())){
      // file does not exist => get it via ws
      $url = sprintf("%s/getActiviteitNode?id=%u", $this->wsUrl, $WsClientMetadata->getId());

      // write it locally
      $this->cache->set($WsClientMetadata->getPath(), file_get_contents($url));
    }

    $this->cache->get($WsClientMetadata->getPath());
  }

  function exists(DmsNodeMetadata $metadata)
  {
    return $this->diskStore->exists($this->getWsClientMetadataForMetadata($metadata));
  }

  function write(DmsNodeMetadata $metadata, $data)
  {
    $this->diskStore->write($this->getWsClientMetadataForMetadata($metadata), $data);
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
   *
   * @return DmsNodeMetadata
   */
  private function getWsClientMetadataForMetadata(DmsNodeMetadata $metadata)
  {
    $wsPath = sprintf("/%u_%s.bin", $metadata->getId(), $metadata->getLastUpdatedTimestamp());

    return new DmsNodeMetadata($metadata->getId(), $metadata->getName(), $wsPath, $metadata->getLastUpdatedTimestamp());
  }
}