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
      if ($output = $this->wsClient->output($metadata) !== null) {
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
   * @param string $requestFileName
   * @param DmsNodeMetadata $metadata
   */
  function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata)
  {
    $tmpFilename = $_FILES[$requestFileName]['tmp_name'];
    $data = file_get_contents($tmpFilename);
    
    $this->wsClient->write($metadata, $data);
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
   * @return string
   */
  private function getCacheKey(DmsNodeMetadata $metadata)
  {
    return sprintf("/%u_%s.bin", $metadata->getId(), $metadata->getLastUpdatedTimestamp());
  }
}