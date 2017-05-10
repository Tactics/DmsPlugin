<?php

/**
 * Class DmsApiProblem
 * Based on draft https://tools.ietf.org/html/draft-nottingham-http-problem-07
 */
class DmsWsProblem
{
  const TYPE_NODE_NOT_FOUND = 'node_not_found';
  const TYPE_UNEXPECTED_ERROR = 'unexpected_error';
  
  static private $titles = array(
    self::TYPE_NODE_NOT_FOUND => 'The node was not found.',
    self::TYPE_UNEXPECTED_ERROR => 'Unexpected error.'
  );
  
  /** @var int */
  private $statusCode;
  /** @var string */
  private $type;
  /** @var string */
  private $title;
  /** @var string */
  private $details;
  
  /**
   * DmsApiProblem constructor.
   * @param $statusCode
   * @param $type
   * @param string $details
   */
  public function __construct($statusCode, $type, $details = '')
  {
    $this->statusCode = $statusCode;
    $this->type = $type;
    $this->details = $details;
    
    if (!isset(self::$titles[$type])) {
      throw new \InvalidArgumentException('No title for type ' . $type);
    }
    
    $this->title = self::$titles[$type];
  }
  
  /**
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }
  
  /**
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }
  
  /**
   * @return int
   */
  public function getStatusCode()
  {
    return $this->statusCode;
  }
  
  /**
   * @return string
   */
  public function getDetails()
  {
    return $this->details;
  }
}