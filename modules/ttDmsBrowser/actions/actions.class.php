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
   * Lijst van alle geuploade bestanden
   */
  public function executeList()
  {
    $this->pager = $this->getPager();
    $this->pager->init();
  }

  /**
   * Pager voor node lijst
   */
  private function getPager()
  {
    $pager = new myFilteredPager('DmsNode', 'DmsNode/list');

    $pager->getCriteria()->addJoin(DmsNodePeer::ID, DmsNodeAspectPeer::NODE_ID, Criteria::LEFT_JOIN);
    $pager->getCriteria()->add(DmsNodePeer::IS_FOLDER, 1, Criteria::NOT_EQUAL);
    $pager->getCriteria()->addDescendingOrderByColumn(DmsNodePeer::CREATED_AT);
    $pager->getCriteria()->setDistinct();

    $aspectId = $pager->add(DmsNodeAspectPeer::ASPECT_ID);
    $pager->add(DmsNodePeer::NAME, array('comparison' => Criteria::LIKE));
    $values = $pager->add('aspect_type', array('addToCriteria' => false));

    $crit = $pager->getCriteria();
    if ($aspectId && is_array($values))
    {
      $aspect = DmsAspectPeer::retrieveByPK($aspectId);

      foreach($aspect->getDmsAspectPropertyTypes() as $propertyType)
      {
        $property = DmsPropertyTypePeer::retrieveByPK($propertyType->getTypeId());
        $value = $values[$propertyType->getTypeId()];
        $dataType = $property->getDataType();

        if (!$value)
        {
          continue;
        }

        $alias = 'prop' . $property->getId();
        $crit->addAlias($alias, DmsNodePropertyPeer::TABLE_NAME);
        $crit->addJoin(DmsNodePeer::ID, DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::NODE_ID), Criteria::JOIN);
        $crit->add(DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::TYPE_ID), $property->getId());

        switch ($dataType)
        {
          case DmsPropertyTypePeer::TYPE_TEXT:
          case DmsPropertyTypePeer::TYPE_DATE:
            $crit->add(DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::STRING_VALUE), '%' . $value . '%', Criteria::LIKE);
            break;
          case DmsPropertyTypePeer::TYPE_TEXTAREA:
            $crit->add(DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::TEXT_VALUE), '%' . $value . '%', Criteria::LIKE);
            break;
          case DmsPropertyTypePeer::TYPE_CHECKBOX:
            $crit->add(DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::BOOLEAN_VALUE), $value);
            break;
          default:
            $crit->add(DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::STRING_VALUE), '%' . $value . '%', Criteria::LIKE);
            break;
        }
      }
    }

    return $pager;
  }

  /**
   * Browse a content store
   */
  public function executeBrowse()
  {
    if ($this->hasRequestParameter('store_id'))
    {
      $this->node = DmsStorePeer::retrieveByPK($this->getRequestParameter('store_id'));
      $this->store = $this->node;
    }
    else if ($this->hasRequestParameter('node_id'))
    {
      $this->node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
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
      $node = $folder->createNodeFromUpload('file', null, true);
    }
    
    echo json_encode(array(
      'node_id' => $node ? $node->getId() : ''
    ));
    
    return sfView::NONE;
    //$this->redirect('ttDmsBrowser/browse?store_id=' . $folder->getStoreId());
  }

  /**
   * Download één of meerdere nodes.  Indien meerdere wordt verzonden als zipfile
   * Parameter recursive bepaald of ook submappen toegevoegd moeten worden.
   */
  public function executeDownload()
  {
    $recursive = $this->getRequestParameter('recursive', false);

    // Single file download
    if ($this->hasRequestParameter('node_id'))
    {
      $node = DmsNodePeer::retrieveByPk($this->getRequestParameter('node_id'));
      $type = 'file';
    }
    // Selection download (zip)
    else if ($this->hasRequestParameter('node_ids'))
    {
      $node_ids = explode(',', trim($this->getRequestParameter('node_ids'), ','));

      $c = new Criteria();
      $c->add(DmsNodePeer::ID, $node_ids, Criteria::IN);

      $nodes = DmsNodePeer::doSelect($c);
      $this->forward404Unless(count($nodes));

      $zipFilename = 'files.zip';
      $type = 'zip';
    }
    // Folder download (zip)
    else if ($this->hasRequestParameter('folder_id'))
    {
      $folder = DmsNodePeer::retrieveByPK($this->getRequestParameter('folder_id'));
      $this->forward404Unless($folder);

      $c = new Criteria();
      if (! $recursive)
      {
        $c->add(DmsNodePeer::IS_FOLDER, false);
      }

      $nodes = $folder->getChildNodes($c);

      $zipFilename = $folder->getDiskName() . '.zip';
      $type = 'zip';
    }

    $this->getResponse()->clearHttpHeaders();
    $this->response->setHttpheader('Pragma: public', true);
    $this->response->addCacheControlHttpHeader('Cache-Control', 'must-revalidate');
    $this->response->setHttpHeader('Expires', gmdate("D, d M Y H:i:s", time()) . " GMT");
    $this->response->setHttpHeader('Content-Description', 'File Transfer');

    // Indien een enkel bestand: directe download
    if ($type == 'file')
    {
      if ($mime_type = $node->getMimeType())
      {
        $this->response->setContentType($mime_type, true);
      }

      $this->response->setHttpHeader('Content-Length', (string)($node->getSize()));

      $this->response->setHttpHeader('Last-modified', gmdate("D, d M Y H:i:s", $node->getUpdatedAt(null)) . " GMT");
      $this->response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $node->getName() . '"');
      if(strstr($_SERVER["HTTP_USER_AGENT"],"MSIE") == false)
      {
        $this->response->setHttpHeader('Content-Type', 'application/force-download');
      }

      $this->getResponse()->sendHttpHeaders();

      $node->output();
      exit();
    }
    else // $type == 'zip'
    {
      if (!function_exists('sys_get_temp_dir'))
      {

        function sys_get_temp_dir()
        {
          if ($temp = getenv('TMP'))
          {
            return $temp;
          }
          if ($temp = getenv('TEMP'))
          {
            return $temp;
          }
          if ($temp = getenv('TMPDIR'))
          {
            return $temp;
          }
          $temp = tempnam(__FILE__, '');
          if (file_exists($temp))
          {
            unlink($temp);
            return dirname($temp);
          }
          return null;
        }

      }
      $zip = new ZipArchive();
      $tmpZipFileName = tempnam(sys_get_temp_dir(), 'downloadZip');

      // ZIPARCHIVE::OVERWRITE want ZIPARCHIVE::CREATE geeft foutmelding indien extensie niet .zip is
      if ($zip->open($tmpZipFileName, ZIPARCHIVE::OVERWRITE) !== true)
      {
        exit("cannot open $tmpZipFileName\n");
      }

      foreach($nodes as $node)
      {
        $node->addToZip($zip, '', $recursive);
      }

      $zip->close();

      $this->getResponse()->clearHttpHeaders();
      $this->response->setHttpHeader('Last-modified', gmdate("D, d M Y H:i:s", time()) . " GMT");
      $this->response->setContentType('application/octet-stream', true);
      $this->response->setHttpHeader('Content-Transfer-Encoding', 'binary', true);
      $this->response->setHttpHeader('Content-Length', (string)filesize($tmpZipFileName));
      $this->response->setHttpHeader('Content-Disposition', 'attachment; filename=' . $zipFilename);
      $this->getResponse()->sendHttpHeaders();

      readfile($tmpZipFileName);
      unlink($tmpZipFileName);

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

    $this->redirect_url = $this->getRequestParameter('redirect_url', 'ttDmsBrowser/list');
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

    $this->redirect($this->getRequestParameter('redirect_url', 'ttDmsBrowser/list'));
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
    $data = DmsNodePeer::getNodeTree($node);

    echo json_encode($data['children']);
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
    if ($this->getRequestParameter('node_id'))
    {
      $node_ids = array($this->getRequestParameter('node_id'));;
    }
    else
    {
      $node_ids = explode(',', trim($this->getRequestParameter('node_ids'), ','));
    }

    if (! count($node_ids))
    {
      echo json_encode(array('success' => false, 'message' => 'Geen bestand(en) geselecteerd'));
      exit();
    }

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
      $this->node = DmsStorePeer::retrieveByPK($this->getRequestParameter('store_id'));
    }
    else if ($this->hasRequestParameter('node_id'))
    {
      $this->node = DmsNodePeer::retrieveByPK($this->getRequestParameter('node_id'));
    }

    $this->jsonErrorUnless($this->node && $this->node->getIsFolder(), 'node is geen folder');

    // sorteerbaar maken van ttDmsBrowser
    $namespace = 'ttDmsBrowser';
    $attributeHolder = $this->getUser()->getAttributeHolder();

    $this->orderAsc = $attributeHolder->get("orderasc", true, $namespace);

    // Op volgorde geklikt ?
    if ($this->getRequestParameter("orderby"))
    {
      // zelfde = keer volgorde om
      if ($this->getRequestParameter("orderby") == $attributeHolder->get("orderby", "-", $namespace))
      {
        $this->orderBy  = $this->getRequestParameter("orderby");
        $this->orderAsc = ! $this->orderAsc;
      }
      // anders: nieuw sorteerveld en ascending
      else
      {
        $this->orderBy  = $this->getRequestParameter("orderby");
        $this->orderAsc = true;
      }
    }
    // Behoud volgorde (uit sessie)
    else
    {
      $this->orderBy = $attributeHolder->get("orderby", DmsNodePeer::NAME, $namespace);
    }

    $attributeHolder->set("orderasc", $this->orderAsc, $namespace);
    $attributeHolder->set("orderby", $this->orderBy, $namespace);

    Misc::use_helper('Partial');

    include_component('ttDmsBrowser', 'nodeList', array('node' => $this->node));

    exit();
  }

}
