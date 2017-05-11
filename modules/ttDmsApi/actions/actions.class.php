<?php

/**
 * Class ttDmsApiActions
 */
class ttDmsApiActions extends sfActions
{
  /** @var DmsStorage */
  private $storage;
  
  /** @var DmsNodeMetadata */
  private $metadata;
  
  /**
   * Uitvoeren van de preExecute actie
   * @return string|void sfView::NONE
   */
  public function preExecute()
  {
    $node = DmsNodePeer::retrieveByPK($this->getRequestParameter('id'));
    $this->validateNode($node);
    
    $this->metadata = $node->getMetadata();
    $this->storage = $node->getDmsStore()->getStorage();
  }
  
  /**
   * Uitvoeren van de read actie
   * @return string sfView::NONE
   */
  public function executeRead()
  {
    $this->validateHttpMethodIs(sfRequest::GET);
    
    $fileContents = $this->storage->read($this->metadata);
    
    return $this->createJsonSuccessResponse($fileContents, true);
  }
  
  /**
   * Uitvoeren van write actie
   * @return string sfView::NONE
   * @throws DmsWsException
   */
  public function executeWrite()
  {
    $this->validateHttpMethodIs(sfRequest::PUT);
    
    $data = file_get_contents('php://input');
    $this->storage->write($this->metadata, $data);
    
    return $this->createJsonSuccessResponse();
  }
  
  /**
   * Uitvoeren van moveUploadedFile actie
   * @return string sfView::NONE
   * @throws DmsWsException
   */
  public function executeMoveUploadedFile()
  {
    $this->validateHttpMethodIs(sfRequest::POST);
    
    $this->storage->moveUploadedFile('file', $this->metadata);
    
    return $this->createJsonSuccessResponse();
  }
  
  /**
   * Uitvoeren van de mkdir actie
   * @return string sfView::NONE
   * @throws DmsWsException
   */
  public function executeMkdir()
  {
    $this->validateHttpMethodIs(sfRequest::POST);
  
    $this->storage->mkdir($this->metadata);
  
    return $this->createJsonSuccessResponse();
  }
  
  /**
   * Uitvoeren van de exists actie
   * @return string sfView::NONE
   */
  public function executeExists()
  {
    $this->validateHttpMethodIs(sfRequest::GET);
    
    $exists = $this->storage->exists($this->metadata);
    
    return $this->createJsonSuccessResponse($exists);
  }
  
  /**
   * Uitvoeren van de unlink actie
   * return string sfView:NONE
   */
  public function executeUnlink()
  {
    $this->validateHttpMethodIs(sfRequest::DELETE);
  
    $this->storage->unlink($this->metadata);
    
    return $this->createJsonSuccessResponse();
  }
  
  /**
   * Uitvoeren van de getSize actie
   * @return string sfView::NONE
   */
  public function executeGetSize()
  {
    $this->validateHttpMethodIs(sfRequest::GET);
    
    return $this->createJsonSuccessResponse($this->storage->getSize($this->metadata));
  }
  
  /**
   * Uitvoeren van de getMimeType actie
   * @return string
   */
  public function executeGetMimeType()
  {
    $this->validateHttpMethodIs(sfRequest::GET);
    
    return $this->createJsonSuccessResponse($this->storage->getMimeType($this->metadata));
  }
  
  /**
   * Uitvoeren van de rename actie
   * @return string
   */
  public function executeRename()
  {
    $this->validateHttpMethodIs(sfRequest::PUT);
    
    $newPath = file_get_contents('php://input');
    $newMetadata = new DmsNodeMetadata(null, null, $newPath, null);
    $this->storage->rename($this->metadata, $newMetadata);
    
    return $this->createJsonSuccessResponse();
  }
  
  /**
   * @param $method
   * @throws DmsWsException
   */
  private function validateHttpMethodIs($method)
  {
    if ($this->getRequest()->getMethod() !== $method) {
      throw new DmsWsException('Method not allowed.', 405);
    };
  }
  
  /**
   * @param mixed $data
   * @param bool $base64Encode
   * @return string sfView::NONE
   */
  private function createJsonSuccessResponse($data = null, $base64Encode = false)
  {
    /** @var sfWebResponse $response */
    $response = $this->getResponse();
    $response->setStatusCode(200);
    $response->setContentType('application/json');
    
    $responseBody = [
      'success' => true,
      'status' => 200,
    ];
    
    if ($data) {
      $responseBody = array_merge($responseBody, [
        'base64_encoded' => $base64Encode,
        'data' => $base64Encode ? base64_encode($data) : $data
      ]);
    }
    
    return $this->renderText(json_encode($responseBody));
  }
  
  /**
   * @param DmsWsProblem $dmsWsProblem
   * @return string sfView::NONE
   */
  private function createJsonErrorResponse(DmsWsProblem $dmsWsProblem)
  {
    /** @var sfWebResponse $response */
    $response = $this->getResponse();
    $response->setStatusCode($dmsWsProblem->getStatusCode());
    $response->setContentType('application/problem+json');
  
    return $this->renderText(json_encode([
      'success' => false,
      'status' => $dmsWsProblem->getStatusCode(),
      'type' => $dmsWsProblem->getType(),
      'title' => $dmsWsProblem->getTitle(),
      'details' => $dmsWsProblem->getDetails()
    ]));
  }
  
  /**
   * @param DmsNode $node
   * @return string sfView::NONE
   */
  private function validateNode(DmsNode $node)
  {
    if (!$node) {
      $dmsWsProblem = new DmsWsProblem(404, DmsWsProblem::TYPE_NODE_NOT_FOUND);
      return $this->createJsonErrorResponse($dmsWsProblem);
    }
  }
}