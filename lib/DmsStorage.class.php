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
   * @param string $path
   * 
   * @throws sfException indien het path geen directory is 
   */
  protected function checkIsDir($path)
  {
    if (!$this->isDir($path))
    {
      throw new sfException(sprintf('The item "%s" is not a directory.', $path));
    }
  }
  
  /**
   * Controleert of het opgegeven path een bestand is
   * 
   * @param string $path
   * 
   * @throws sfException indien het path geen bestand is 
   */
  protected function checkIsFile($path)
  {
    if (!$this->isFile($path))
    {
      throw new sfException(sprintf('The item "%s" is not a regular file.', $path));
    }
  }
  
  /**
   * Controleert of het opgegeven path bestaat
   * 
   * @param string $path
   * 
   * @throws sfException indien het path geen bestand is 
   */
  protected function checkExists($path)
  {
    if (!$this->exists($path))
    {
      throw new sfException(sprintf('The item "%s" does not exist.', $path));
    }
  }
  
  abstract function initialize();
  abstract function copy($fromPath, $toPath);
  abstract function mkdir($path);
  abstract function exists($path);
  abstract function isDir($path);
  abstract function isFile($path);
  abstract function getSize($path);
  abstract function rename($fromPath, $toPath);
  abstract function listdir($path);
  abstract function read($path);
  abstract function output($path);
  abstract function unlink($path);
  abstract function write($path, $data);
  
  abstract function moveUploadedFile($requestFileName, $path);
  abstract function getMimeType($path);
} 