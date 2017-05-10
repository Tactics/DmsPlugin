<?php

use Guzzle\Http\Message\Response;

/**
 * Class DmsApiResponse
 */
class DmsWsResponse
{
  /** @var bool */
  private $success;
  /** @var int */
  private $statusCode;
  /** @var mixed */
  private $data;
  /** @var DmsWsProblem */
  private $problem;
  
  /**
   * @param Response $response
   * @return DmsWsResponse
   */
  public static function fromGuzzleResponse(Response $response)
  {
    try {
      $responseArr = $response->json();
    } catch (Exception $e) {
      return self::fromException($e);
    }
  
    $success = (bool)$responseArr['success'];
    $statusCode = (int)$responseArr['status'];
    $data = null;
    $problem = null;
  
    if ($success) {
      $data = (bool)$responseArr['base64_encoded'] ? base64_decode($responseArr['data']) : $responseArr['data'];
    } else {
      $problem = new DmsWsProblem($statusCode, $responseArr['type'], $responseArr['details']);
    }
    
    return new self(
      (bool)$responseArr['success'],
      (int)$responseArr['status'],
      $data,
      $problem
    );
  }
  
  /**
   * @param Exception $e
   * @return DmsWsResponse
   */
  public static function fromException(Exception $e)
  {
    $problem = new DmsWsProblem($e->getCode(), DmsWsProblem::TYPE_UNEXPECTED_ERROR, $e->getMessage());
    
    return new self(false, $e->getCode(), null, $problem);
  }
  
  /**
   * @return bool
   */
  public function success()
  {
    return $this->success;
  }
  
  /**
   * @return int
   */
  public function getStatusCode()
  {
    return $this->statusCode;
  }
  
  /**
   * @return mixed
   */
  public function getData()
  {
    return $this->data;
  }
  
  /**
   * @return DmsWsProblem
   */
  public function getProblem()
  {
    return $this->problem;
  }
  
  /**
   * DmsWsResponse constructor.
   * @param bool $success
   * @param int $statusCode
   * @param mixed $data
   * @param DmsWsProblem $problem
   */
  private function __construct($success, $statusCode, $data = null, DmsWsProblem $problem = null)
  {
    $this->success = $success;
    $this->statusCode = $statusCode;
    $this->data = $data;
    $this->problem = $problem;
  }
}