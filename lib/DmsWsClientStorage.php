<?php


class DmsWsClientStorage extends DmsStorage
{
  /** @var DmsDiskStorage */
  private $diskStore;
  
  /** @var  DmsDiskCache */
  private $cache;
  
  /** @var DmsWsClient */
  private $wsClient;
  
  /**
   * @throws sfConfigurationException
   */
  function initialize()
  {
    $this->diskStore = new DmsDiskStorage($this->options);
    $this->cache = new DmsDiskCache($this->options);
    $this->wsClient = new DmsWsClient();
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   */
  function output(DmsNodeMetadata $metadata)
  {
    $cacheKey = $this->getCacheKey($metadata);
    if (!$this->cache->has($cacheKey)) {
      if (($output = $this->wsClient->output($metadata)) !== null) {
        // write it locally
        $this->cache->set($cacheKey, $output);
      } else {
        // @todo: nadenken of er hier nog iets moet gebeuren
      };
    }
    
    $this->cache->get($cacheKey);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @param $data
   */
  function write(DmsNodeMetadata $metadata, $data)
  {
    $this->wsClient->write($metadata, $data);
  }
  
  /**
   * @param string $fileId
   * @param DmsNodeMetadata $metadata
   */
  function moveUploadedFile($fileId, DmsNodeMetadata $metadata)
  {
    $this->wsClient->moveUploadedFile($metadata, $fileId);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   */
  function mkdir(DmsNodeMetadata $metadata)
  {
    $this->wsClient->mkdir($metadata);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   */
  function unlink(DmsNodeMetadata $metadata)
  {
    $this->wsClient->unlink($metadata);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @return bool|null
   */
  function exists(DmsNodeMetadata $metadata)
  {
    return $this->wsClient->exists($metadata);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @return int|null
   */
  function getSize(DmsNodeMetadata $metadata)
  {
    return $this->wsClient->getSize($metadata);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @return null|string
   */
  function getMimeType(DmsNodeMetadata $metadata)
  {
    return $this->wsClient->getMimeType($metadata);
  }
  
  
  // volgens mij is rest voorlopig niet nodig
  function copy(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
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
  
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  
  
  private function throwMethodNotImplementedYetException($methodName)
  {
    throw new sfException(sprintf("%s: method %s not implemented yet.", get_class($this), $methodName));
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @return string
   */
  private function getCacheKey(DmsNodeMetadata $metadata)
  {
    return sprintf("/%u_%s.bin", $metadata->getId(), $metadata->getLastUpdatedTimestamp());
  }
}