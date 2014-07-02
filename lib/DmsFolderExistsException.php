<?php

/**
 * Class DmsFolderExistsException
 */
class DmsFolderExistsException extends sfException
{
  /**
   * @param string $path
   */
  public function __construct($path)
  {
    parent::__construct("Dir {$path} already exists.");
  }
}