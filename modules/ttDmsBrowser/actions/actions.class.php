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
 * ttDmsBrowser acties.
 *
 * @package    kvonline
 * @subpackage ttDmsBrowser
 * @author     Your name here
 */
class ttDmsBrowserActions extends sfActions
{
  /**
   * Standaard index actie
   */
  public function executeIndex()
  {
    $this->stores = DmsStorePeer::doSelect(new Criteria());
  }
  
  /**
   * Browse a content store
   */
  public function executeBrowse()
  {
    if ($this->hasRequestParameter('store_id'))
    {
      $this->store = DmsStorePeer::retrieveByPK($this->getRequestParameter('store_id'));
      $this->nodes = $this->store->getChildNodes();
    }
    else if ($this->hasRequestParameter('node_id'))
    {
      $this->node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
      $this->nodes = $this->node->getChildNodes();
      $this->store = $this->node->getDmsStore();
    }
  }
  
  /**
   * Creates a new folder
   */
  public function executeCreateFolder()
  {
    if ($this->getRequestParameter('node_id'))
    {
      $node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
      $folder = $node->createFolder($this->getRequestParameter('name'));
    }
    else if ($this->hasRequestParameter('store_id'))
    {
      $store = DmsStorePeer::retrieveByPK($this->getRequestParameter('store_id'));
      $folder = $store->createFolder($this->getRequestParameter('name'));
    }
    else
    {
      $this->forward404();
    }

    $this->redirect('ttDmsBrowser/browse?store_id=' . $folder->getStoreId());
  }
  
  /**
   * Upload een bestand in de opgegeven folder
   */
  public function executeUpload()
  {
    $folder = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    
    if ($this->getRequest()->hasFile('file') && ! $this->getRequest()->hasFileError('file'))
    {
      $folder->createNodeFromUpload('file');
    }
    
    $this->redirect('ttDmsBrowser/browse?store_id=' . $folder->getStoreId());
  }
  
  /**
   * Download één of meerdere nodes.  Indien meerdere wordt verzonden als zipfile
   */
  public function executeDownload()
  {
    $node_ids = explode(',', trim($this->getRequestParameter('node_ids'), ','));
    
    $c = new Criteria();
    $c->add(DmsNodePeer::ID, $node_ids, Criteria::IN);
    
    $nodes = DmsNodePeer::doSelect($c);
    
    if (! count($nodes))
    {
      exit();
    }
    
    $this->getResponse()->clearHttpHeaders();
    $this->response->setHttpheader('Pragma: public', true);
    $this->response->addCacheControlHttpHeader('Cache-Control', 'must-revalidate');
    //$this->response->setContentType('application/octet-stream', true);
    $this->response->setHttpHeader('Expires', gmdate("D, d M Y H:i:s", time()) . " GMT");
    $this->response->setHttpHeader('Content-Description', 'File Transfer');
    
    if (count($nodes) == 1)
    {
      $node = reset($nodes);
      
      if ($mime_type = $node->getMimeType())
      {
        $this->response->setContentType($mime_type, true);
      }
    
      $this->response->setHttpHeader('Content-Length', (string)($node->getSize()));
  
      $this->response->setHttpHeader('Last-modified', gmdate("D, d M Y H:i:s", $node->getUpdatedAt(null)) . " GMT");
      $this->response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $node->getName() . '"');
      $this->getResponse()->sendHttpHeaders();
          
      $node->output();
      exit();
    }
    else
    {
      $zip = new ZipArchive();
      $zipFilename = tempnam(sys_get_temp_dir(), 'downloadZip');

      // ZIPARCHIVE::OVERWRITE want ZIPARCHIVE::CREATE geeft foutmelding indien extensie niet .zip is
      if ($zip->open($zipFilename, ZIPARCHIVE::OVERWRITE) !== true)
      {
        exit("cannot open $zipFilename\n");
      }
  
      foreach($nodes as $node)
      {
        $zip->addFromString($node->getName(), $node->read());  
      }
  
      $zip->close();

      $this->getResponse()->clearHttpHeaders();
      $this->response->setHttpHeader('Last-modified', gmdate("D, d M Y H:i:s", $node->getUpdatedAt(null)) . " GMT");
      $this->response->setContentType('application/octet-stream', true);
      $this->response->setHttpHeader('Content-Transfer-Encoding', 'binary', true);
      $this->response->setHttpHeader('Content-Length', (string)filesize($zipFilename));
      $this->response->setHttpHeader('Content-Disposition', 'attachment; filename=files.zip');   
      $this->getResponse()->sendHttpHeaders();    

      readfile($zipFilename);
      unlink($zipFilename);
      
      exit();
    }
  }
  
  
  /**
   * Geeft een node detali weer
   */
  public function executeShow()
  {
    $this->node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    $this->forward404Unless($this->node);
    $this->mime_type = $this->node->getMimeType();
    
    $aspect_ids = array();
    foreach($this->node->getDmsNodeAspects() as $nodeAspect)
    {
      $aspect_ids[] = $nodeAspect->getAspectId();
    }
    
    $c = new Criteria();
    $c->add(DmsAspectPeer::ID, $aspect_ids, Criteria::NOT_IN);
    $this->aspects = DmsAspectPeer::doSelect($c);
  }
  
  /**
   * Voegt een aspect toe aan een node
   */
  public function executeAddAspect()
  {
    $node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    $this->forward404Unless($node);
    
    $aspect = DmsAspectPeer::retrieveByPK($this->getRequestParameter('aspect_id'));
    
    $node->addAspect($aspect);
    
    $this->redirect('ttDmsBrowser/show?node_id=' . $node->getId());
  }
  
  /**
   * Verwijdert een aspect van een node
   */
  public function executeRemoveAspect()
  {
    $nodeAspect = DmsNodeAspectPeer::retrieveByPK($this->getRequestParameter('nodeaspect_id'));
    $this->forward404Unless($nodeAspect);
    
    $nodeAspect->getDmsNode()->removeAspect($nodeAspect->getDmsAspect());
    
    $this->redirect('ttDmsBrowser/show?node_id=' . $nodeAspect->getDmsNode()->getId());
  }


  /**
   * Slaat de properties van een node op
   */
  public function executeSaveProperties()
  {
    $node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    $this->forward404Unless($node);
    
    foreach($node->getDmsNodeAspectsJoinDmsAspect() as $nodeAspect)
    {
      foreach($nodeAspect->getDmsAspect()->getDmsAspectPropertyTypesJoinDmsPropertyType() as $aspectPropertyType)
      {
        $node->setProperty($aspectPropertyType->getDmsPropertyType(), $this->getRequestParameter('input_' . $aspectPropertyType->getId()));
      }
    }

    $this->redirect('ttDmsBrowser/show?node_id=' . $node->getId());
  }

  /**
   * Geeft json error indien $object null is
   */
  private function jsonErrorUnless($object, $message = 'Not found')
  {
    if (! $object)
    {
      echo json_encode(array('success' => false, 'message' => $message));
      exit();
    }
  }
  
  /**
   * Geeft json folder data voor nodeTree
   */
  public function executeJsonTree()
  {
    $node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    
    echo json_encode(DmsNodePeer::getNodeTree($node));
    exit();
  }
  
  /**
   * JSON Rename node
   */
  public function executeJsonNodeRename()
  {
    $node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    $this->jsonErrorUnless($node, 'Node niet gevonden');
    
    try
    {
      $node->rename($this->getRequestParameter('new_name'));
    }
    catch(Exception $e)
    {
      echo json_encode(array('success' => false, 'message' => $e->getMessage()));
      exit();
    }
    
    echo json_encode(array('success' => true, 'message' => 'ok'));
    exit();
  }
 
  /**
   *JSON Move node
   */
  public function executeJsonNodeMove()
  {
    $node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    $this->jsonErrorUnless($node, 'Node niet gevonden');
    $target_node = DmsNodePeer::retrieveByPK($this->getRequestParameter('target_id'));
    $this->jsonErrorUnless($target_node, 'Targetnode niet gevonden');
    
    $type = $this->getRequestParameter('type');
    
    if ($type == 'after' || $type == 'before')
    {
      $target_node = $target_node->getParentNode();
    }
    
    try
    {
      $node->move($target_node);
    }
    catch(Exception $e)
    {
      echo json_encode(array('success' => false, 'message' => $e->getMessage()));
      exit();
    }
    
    echo json_encode(array('success' => true, 'message' => 'ok'));
    exit();
  }

  /**
   *JSON Create node
   */
  public function executeJsonNodeCreate()
  {
    $target_node = DmsNodePeer::retrieveByPK($this->getRequestParameter('target_id'));
    $this->jsonErrorUnless($target_node, 'Targetnode niet gevonden');
    
    $type = $this->getRequestParameter('type');
    
    if ($type == 'after' || $type == 'before')
    {
      $target_node = $target_node->getParentNode();
    }
    
    try
    {
      $folder = $target_node->createFolder($this->getRequestParameter('name'));
    }
    catch(Exception $e)
    {
      echo json_encode(array('success' => false, 'message' => $e->getMessage()));
      exit();
    }
    
    echo json_encode(array('success' => true, 'message' => 'ok', 'node_id' => $folder->getId()));
    exit();
  }
 
  /**
   *JSON Move delete
   */
  public function executeJsonNodeDelete()
  {
    $node_ids = explode(',', trim($this->getRequestParameter('node_ids'), ','));
    
    $c = new Criteria();
    $c->add(DmsNodePeer::ID, $node_ids, Criteria::IN);
    
    foreach(DmsNodePeer::doSelect($c) as $node)
    {
      try
      {
        $this->jsonErrorUnless($node);
        $node->delete();
      }
      catch(Exception $e)
      {
        echo json_encode(array('success' => false, 'message' => $e->getMessage()));
        exit();
      }
    }
        
    echo json_encode(array('success' => true, 'message' => 'ok'));
    exit();
  }
  
  
  /**
   * AJAX Node list (folder list)
   */
  public function executeAjaxNodeList()
  {
    if ($this->hasRequestParameter('store_id'))
    {
      $this->store = DmsStorePeer::retrieveByPK($this->getRequestParameter('store_id'));
      $this->nodes = $this->store->getChildNodes();
    }
    else if ($this->hasRequestParameter('node_id'))
    {
      $this->node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
      $this->nodes = $this->node->getChildNodes();
      $this->store = $this->node->getDmsStore();
    }
    
    $this->jsonErrorUnless($this->node->getIsFolder(), 'node is geen folder');
    
    Misc::use_helper('Partial');
    
    include_component('ttDmsBrowser', 'nodeList', array('folder' => $this->node ? $this->node : $this->store, 'nodes' => $this->nodes));
    
    exit();
  }
  
}
