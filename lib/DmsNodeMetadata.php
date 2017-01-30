<?php

class DmsNodeMetadata
{
  private $id;
  private $name;
  private $diskName;
  private $lastUpdatedTimestamp;

  public function __construct($id, $name, $diskName, $lastUpdatedTimestamp)
  {
    $this->id = $id;
    $this->name = $name;
    $this->diskName = $diskName;
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
  public function getDiskName()
  {
    return $this->diskName;
  }

  /**
   * @return mixed
   */
  public function getLastUpdatedTimestamp()
  {
    return $this->lastUpdatedTimestamp;
  }



}