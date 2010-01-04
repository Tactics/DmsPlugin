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
   * @param array options
   */
  public function executeNodeList()
  {
    $defaultOptions = array(
      'showFolders' => false
    );
    
    $this->options = (is_array($this->options) ? $this->options : array()) + $defaultOptions;
    
  }
  
  
  /**
   * Node tree
   * 
   * @param id optional
   * @param root
   */
  public function executeNodeTree()
  {
    $this->id = isset($this->id) ? $this->id : 'nodeTree'; 
    
    $json_data = DmsNodePeer::getNodeTree($this->root);

    $json_data = array(
      array(
        'attributes' => array('id' => 'root', 'folder' => '/', 'uri' => myEncoders::urlEncodeUri('/'), 'rel' => 'root'),
        'data' => array(
          'title' => '/'
        ),
        'children' => $json_data
      )
    ); 
    
    $this->json_data = json_encode($json_data);
  }
}
  
