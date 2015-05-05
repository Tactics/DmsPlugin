<?php

/*
 * Dit bestand maakt deel uit van een applicatie voor Digipolis Antwerpen.
 * 
 * (c) <?php echo date('Y'); ?> Tactics BVBA
 *
 * Recht werd verleend om dit bestand te gebruiken als onderdeel van de genoemde
 * applicatie. Mag niet doorverkocht worden, noch rechtstreeks noch via een
 * derde partij. Meer informatie in het desbetreffende aankoopcontract. 
 */
 
/**
 * ttDmsBrowser componenten.
 *
 * @package    kvonline
 * @subpackage ttDmsBrowser
 * @author     Your name here
 */
class ttDmsBrowserComponents extends sfComponents
{

  /**
   * Node list
   * 
   * @param DmsNode node
   * @param array options
   */
  public function executeBrowser()
  {
    if (! $this->node || ! ($this->node instanceof DmsStore || $this->node->getIsFolder()))
    {
      throw new sfException('cmsBrowser component verwacht een parameter "node" .');  
    }
    
    $defaultOptions = array(
      'width' => '900px',
      'upload_enabled' => true,
      'list_width' => '250px',
      'showType' => true,
      'showAnnotations' => false,
      'filter_enabled' => false
    );
    
    $this->options = is_array($this->options) ? $this->options : array();
    $this->options = $this->options + $defaultOptions;
  }
  
  
  
  /**
   * Node list
   * 
   * @param DmsNode node
   * @param array options
   */
  public function executeNodeList()
  {
    if (! $this->node || ! ($this->node instanceof DmsStore || $this->node->getIsFolder()))
    {
      throw new sfException('cmsBrowser component verwacht een parameter "node" met een DmsNode (folder!).');  
    }

    $defaultOptions = array(
      'showFolders' => false
    );
    
    $this->options = is_array($this->options) ? $this->options : array();
    $this->options = $this->options + $defaultOptions;

    // sorteerbaar maken van ttDmsBrowser
    // deze params worden gezet in ttDmsBrowser/ajaxNodeList
    $namespace = 'ttDmsBrowser';
    $attributeHolder = $this->getUser()->getAttributeHolder();
    $this->orderAsc = $attributeHolder->get("orderasc", true, $namespace);
    $this->orderBy = $attributeHolder->get("orderby", '-', $namespace);
    $this->aspectId = $attributeHolder->get('aspect_id', '', $namespace);

    $c = new Criteria();
    if ($this->orderBy != '-')
    {
      $this->orderAsc ? $c->addAscendingOrderByColumn($this->orderBy) : $c->addDescendingOrderByColumn($this->orderBy);
    }
    if ($this->aspectId)
    {
      $c->addJoin(DmsNodePeer::ID, DmsNodeAspectPeer::NODE_ID, Criteria::JOIN);
      $c->add(DmsNodeAspectPeer::ASPECT_ID, $this->aspectId);
    }
    
    $this->nodes = $this->node->getChildNodes($c);    
  }
  
  
  /**
   * Node tree
   * 
   * @param id optional
   * @param root
   */
  public function executeNodeTree()
  {
    if (! $this->node || ! ($this->node instanceof DmsStore || $this->node->getIsFolder()))
    {
      throw new sfException('cmsBrowser component verwacht een parameter "node" met een DmsNode (folder!).');  
    }

    $this->id = isset($this->id) ? $this->id : 'nodeTree'; 
    $json_data = DmsNodePeer::getNodeTree($this->node);
    $json_data['state'] = 'open';
    $json_data['data']['title'] = '/';
    $this->json_data = json_encode($json_data);
  }

  /**
   * Node filter
   */
  public function executeNodeFilter()
  {
    if (! $this->node || ! ($this->node instanceof DmsStore || $this->node->getIsFolder()))
    {
      throw new sfException('cmsBrowser component verwacht een parameter "node" met een DmsNode (folder!).');
    }

    $this->options = isset($this->options) ? $this->options : array();

    $namespace = 'ttDmsBrowser';
    $attributeHolder = $this->getUser()->getAttributeHolder();
    $this->aspect_id = $attributeHolder->get("aspect_id", '', $namespace);
  }
}
  
