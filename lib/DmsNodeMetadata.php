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
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getPath()
  {
    return $this->path;
  }

  /**
   * @return mixed
   */
  public function getLastUpdatedTimestamp()
  {
    return $this->lastUpdatedTimestamp;
  }



}