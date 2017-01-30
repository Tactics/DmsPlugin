<?php

/**
 * @author Tactics bvba
 * @copyright 2009
 */

abstract class DmsStorage
{
  protected $root;
  protected $options;

  /**
   * Constructor
   * 
   * @param array $options
   */
  public function __construct($options = array())
  {
    $this->options = $options;
    $this->root = $options['root'];
    $this->initialize();
  }

  /**
   * Controleert of het opgegeven path een directory is
   *
   * @param DmsNodeMetadata $metadata
   *
   * @throws sfException indien het path geen directory is
   *
   */
  protected function checkIsDir(DmsNodeMetadata $metadata)
  {
    if (!$this->isDir($metadata))
    {
      throw new sfException(sprintf('The item "%s" is not a directory.', $metadata->getPath()));
    }
  }

  /**
   * Controleert of het opgegeven path een bestand is
   *
   * @param DmsNodeMetadata $metadata
   *
   * @throws sfException indien het path geen bestand is
   *
   */
  protected function checkIsFile(DmsNodeMetadata $metadata)
  {
    if (!$this->isFile($metadata))
    {
      throw new sfException(sprintf('The item "%s" is not a regular file.', $metadata->getPath()));
    }
  }

  /**
   * Controleert of het opgegeven path bestaat
   *
   * @param DmsNodeMetadata $metadata
   *
   * @throws sfException indien het path geen bestand is
   *
   */
  protected function checkExists(DmsNodeMetadata $metadata)
  {
    if (!$this->exists($metadata))
    {
      throw new sfException(sprintf('The item "%s" does not exist.', $metadata->getPath()));
    }
  }
  
  abstract function initialize();
  abstract function copy(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata);
  abstract function mkdir(DmsNodeMetadata $metadata);
  abstract function exists(DmsNodeMetadata $metadata);
  abstract function isDir(DmsNodeMetadata $metadata);
  abstract function isFile(DmsNodeMetadata $metadata);
  abstract function getSize(DmsNodeMetadata $metadata);
  abstract function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata);
  abstract function listdir(DmsNodeMetadata $metadata);
  abstract function read(DmsNodeMetadata $metadata);
  abstract function output(DmsNodeMetadata $metadata);
  abstract function unlink(DmsNodeMetadata $metadata);
  abstract function write(DmsNodeMetadata $metadata, $data);
  
  abstract function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata);
  abstract function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata);
  abstract function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath);
  abstract function getMimeType(DmsNodeMetadata $metadata);
} 