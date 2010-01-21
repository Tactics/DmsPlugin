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
      throw new sfException('cmsBorwser component verwacht een parameter "node" .');  
    }
    
    $defaultOptions = array(
      'width' => '900px',
      'upload_enabled' => true,
      'list_width' => '250px'
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
      throw new sfException('cmsBorwser component verwacht een parameter "node" met een DmsNode (folder!).');  
    }

    $defaultOptions = array(
      'showFolders' => false
    );
    
    $this->options = is_array($this->options) ? $this->options : array();
    $this->options = $this->options + $defaultOptions;
    
    $this->nodes = $this->node->getChildNodes();
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
      throw new sfException('cmsBorwser component verwacht een parameter "node" met een DmsNode (folder!).');  
    }

    $this->id = isset($this->id) ? $this->id : 'nodeTree'; 
    
    $json_data = DmsNodePeer::getNodeTree($this->node);

    $json_data = array(
      array(
        'attributes' => array('id' => ($this->node instanceof DmsStore) ? 'root' : ('node_' . $this->node->getId()) , 'folder' => '/', 'uri' => myEncoders::urlEncodeUri('/'), 'rel' => 'root'),
        'data' => array(
          'title' => '/'
        ),
        'children' => $json_data
      )
    ); 
    
    $this->json_data = json_encode($json_data);
    
  }
}
  
