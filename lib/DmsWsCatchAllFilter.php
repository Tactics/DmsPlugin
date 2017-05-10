<?php

/**
 * Class DmsWsCatchAllFilter
 */
class DmsWsCatchAllFilter extends sfFilter
{
  /**
   * @param sfFilterChain $filterChain
   * @return string|void
   */
  public function execute(sfFilterChain $filterChain)
  {
    $context = $this->getContext();
    if ($context->getModuleName() !== 'ttDmsApi') {
      $filterChain->execute();
      return;
    }
    
    try {
      $filterChain->execute();
    } catch (\Exception $e) {
      $dmsWsProblem = new DmsWsProblem($e->getCode(), DmsWsProblem::TYPE_UNEXPECTED_ERROR, $e->getMessage());
      return $this->createJsonResponse($dmsWsProblem);
    }
  }
  
  /**
   * @param DmsWsProblem $dmsWsProblem
   * @return string sfView::NONE
   */
  private function createJsonResponse(DmsWsProblem $dmsWsProblem)
  {
    /** @var sfWebResponse $response */
    $response = $this->getContext()->getResponse();
    $response->setStatusCode($dmsWsProblem->getStatusCode());
    $response->setContentType('application/problem+json');
    $response->setContent(json_encode([
      'success' => false,
      'status' => $dmsWsProblem->getStatusCode(),
      'type' => $dmsWsProblem->getType(),
      'title' => $dmsWsProblem->getTitle(),
      'details' => $dmsWsProblem->getDetails()
    ]));
    
    return sfView::NONE;
  }
}