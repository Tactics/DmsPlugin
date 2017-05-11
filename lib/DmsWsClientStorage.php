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
    echo $this->read($metadata);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @return null|string
   */
  function read(DmsNodeMetadata $metadata)
  {
    $cacheKey = $this->getCacheKey($metadata);
    if (!$this->cache->has($cacheKey)) {
      if (($fileContents = $this->wsClient->read($metadata)) !== null) {
        // write it locally
        $this->cache->set($cacheKey, $fileContents);
        return $fileContents;
      }
    }
    
    return $this->cache->get($cacheKey, null);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @param string $fileContents
   */
  function write(DmsNodeMetadata $metadata, $fileContents)
  {
    $this->wsClient->write($metadata, $fileContents);
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
  
  /**
   * @param DmsNodeMetadata $oldMetadata
   * @param DmsNodeMetadata $newMetadata
   */
  function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    $this->wsClient->rename($oldMetadata, $newMetadata);
  }
  
  /**
   * Saves the DmsNode file contents to a LOCAL file
   * @param DmsNodeMetadata $metadata
   * @param string $absoluteFilepath
   */
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    file_put_contents($absoluteFilepath, $this->read($metadata));
  }
  
  /**
   * Writes the contents of a LOCAL file to the DmsNode
   * @param string $absoluteFilepath
   * @param DmsNodeMetadata $metadata
   */
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    $this->write($metadata, file_get_contents($absoluteFilepath));
  }
  
  /**
   * @param string $methodName
   * @throws sfException
   */
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
  
  // volgens mij is rest voorlopig niet nodig
  function copy(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    $this->throwMethodNotImplementedYetException(__FUNCTION__);
  }
  
  function listdir(DmsNodeMetadata $metadata)
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
}