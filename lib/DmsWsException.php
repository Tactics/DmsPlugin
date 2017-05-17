<?php

/**
 * Class DmsApiException
 */
class DmsWsException extends sfException
{
  /** @var DmsWsResponse */
  private $response;
  
  /**
   * @return DmsWsResponse
   */
  public function getResponse()
  {
    return $this->response;
  }
  
  /**
   * @param DmsWsResponse $response
   */
  public function setResponse(DmsWsResponse $response)
  {
    $this->response = $response;
  }
}