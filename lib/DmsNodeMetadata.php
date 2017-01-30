<?php

class DmsNodeMetadata
{
  private $id;
  private $name;
  private $path;
  private $lastUpdatedTimestamp;

  public function __construct($id, $name, $path, $lastUpdatedTimestamp)
  {
    $this->id = $id;
    $this->name = $name;
    $this->path = $path;
    $this->lastUpdatedTimestamp = $lastUpdatedTimestamp;
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @return string
   */
  public function getPath()
  {
    return $this->path;
  }

  /**
   * @return string
   */
  public function getLastUpdatedTimestamp()
  {
    return $this->lastUpdatedTimestamp;
  }



}