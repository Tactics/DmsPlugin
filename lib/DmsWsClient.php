<?php

use Guzzle\Http\Client;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Message\RequestInterface;

/**
 * Class DmsWsClient
 */
class DmsWsClient
{
  /** @var Client */
  private $client;
  
  /**
   * DmsWsClient constructor.
   */
  public function __construct()
  {
    $wsUrl = sfConfig::get('sf_dms_ws_url');
    if (!$wsUrl) {
      throw new sfConfigurationException('sf_dms_ws_url config not found in config/settings.yml');
    }
    $this->client = new Client($wsUrl);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @return string|null if something went wrong
   */
  public function output(DmsNodeMetadata $metadata)
  {
    $response = $this->get($this->generateUri($metadata, 'output'));
    
    return $response->success() ? $response->getData() : null;
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @param string|resource|array|\Guzzle\Http\EntityBodyInterface $body Body to send in the request
   */
  public function write(DmsNodeMetadata $metadata, $body)
  {
    $this->put($this->generateUri($metadata, 'write'), $body);
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   */
  public function unlink(DmsNodeMetadata $metadata)
  {
    $this->delete($this->generateUri($metadata, 'unlink'));
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   */
  public function mkdir(DmsNodeMetadata $metadata)
  {
    $this->post($this->generateUri($metadata, 'mkdir'));
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @return bool|null if something went wrong
   */
  public function exists(DmsNodeMetadata $metadata)
  {
    $response = $this->get($this->generateUri($metadata, 'exists'));
    
    return $response->success() ? (bool)$response->getData() : null;
  }
  
  /**
   * @param DmsNodeMetadata $metadata
   * @param string $action
   * @return string
   */
  private function generateUri(DmsNodeMetadata $metadata, $action)
  {
    return sprintf('node/%u/%s', $metadata->getId(), $action);
  }
  
  /**
   * @param $uri
   * @return DmsWsResponse
   */
  private function get($uri)
  {
    $request = $this->client->get($uri);
  
    return $this->send($request);
  }
  
  /**
   * @param string $uri
   * @param string|resource|array|\Guzzle\Http\EntityBodyInterface $body Body to send in the request
   * @return DmsWsResponse
   */
  private function post($uri, $body = null)
  {
    $request = $this->client->post($uri, null, $body);
    
    return $this->send($request);
  }
  
  /**
   * @param string $uri
   * @param string|resource|array|\Guzzle\Http\EntityBodyInterface $body Body to send in the request
   * @return DmsWsResponse
   */
  private function put($uri, $body = null)
  {
    $request = $this->client->put($uri, null, $body);
    
    return $this->send($request);
  }
  
  /**
   * @param string $uri
   * @return DmsWsResponse
   */
  private function delete($uri)
  {
    $request = $this->client->delete($uri);
    
    return $this->send($request);
  }
  
  /**
   * @param $request
   * @return DmsWsResponse
   */
  private function send(RequestInterface $request)
  {
    try {
      return DmsWsResponse::fromGuzzleResponse($request->send());
    } catch (BadResponseException $e) { // catches 4XX en 5XX from API
      if ($e->getResponse()->getContentType() === 'application/problem+json') {
        return DmsWsResponse::fromGuzzleResponse($e->getResponse());
      };
    } catch (Exception $e) { // catches all other exceptions
      return DmsWsResponse::fromException($e);
    }
  }
}