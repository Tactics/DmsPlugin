<?php

/*
 * Dit bestand maakt deel uit van een applicatie voor Digipolis Antwerpen.
 * 
 * (c) 2009 Tactics BVBA
 *
 * Recht werd verleend om dit bestand te gebruiken als onderdeel van de genoemde
 * applicatie. Mag niet doorverkocht worden, noch rechtstreeks noch via een
 * derde partij. Meer informatie in het desbetreffende aankoopcontract. 
 */
 
/**
 * Acties ivm dms_aspects
 *
 * @package    Koi
 * @subpackage ttDmsAspect 
 * @author     Gert Vrebos
 */
class ttDmsAspectActions extends sfActions
{
  /**
   * Geeft de lijst met dms_aspects weer
   */
  public function executeList()
  {
    $this->pager = new myFilteredPager('DmsAspect', 'ttDmsAspectActions/list');

    // aspects met system_name laten we niet zien
    $c = $this->pager->getCriteria();
    $c->add(DmsAspectPeer::SYSTEM_NAME, NULL, Criteria::ISNULL);
    
    $this->pager->init();
  }

  /**
   * Geeft een dms_aspect weer
   */
  public function executeShow()
  {
    $this->dms_aspect = DmsAspectPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->dms_aspect);
  }

  /**
   * Geeft het scherm om een nieuw(e) dms_aspect toe te voegen
   */
  public function executeCreate()
  {
    $this->dms_aspect = new DmsAspect();

    $this->setTemplate('edit');
  }

  /**
   * Geeft het scherm om een bestaand(e) dms_aspect te bewerken
   */
  public function executeEdit()
  {
    $this->dms_aspect = DmsAspectPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->dms_aspect);
  }

  /**
   * Maakt een nieuw(e) dms_aspect aan of sla wijzigingen aan een bestaand(e) op
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $dms_aspect = new DmsAspect();
    }
    else
    {
      $dms_aspect = DmsAspectPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($dms_aspect);
    }

    $dms_aspect->setName($this->getRequestParameter('name'));

    $dms_aspect->save();

    return $this->redirect('ttDmsAspect/show?id='.$dms_aspect->getId());
  }
  
  /**
	 * Handelt form validation errors af bij het bewerken van een dms_aspect
	 */
	public function handleErrorUpdate()
  {
	  if ($this->getRequestParameter("id") != "")
	  {
		  $this->forward('ttDmsAspect', 'edit');
		}
	  else
	  {
		  $this->forward('ttDmsAspect', 'create');
		}
  }

  /**
   * Verwijdert een dms_aspect
   */
  public function executeDelete()
  {
    $dms_aspect = DmsAspectPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($dms_aspect);

    $dms_aspect->delete();

    return $this->redirect('ttDmsAspect/list');
  }


  /**
   * Geeft de lijst met dms_property_types weer
   */
  public function executeListTypes()
  {
    $this->pager = new myFilteredPager('DmsPropertyType', 'ttDmsAspectActions/listTypes');

    // aspects met system_name laten we niet zien
    $c = $this->pager->getCriteria();
    $c->add(DmsPropertyTypePeer::SYSTEM_NAME, NULL, Criteria::ISNULL);
    
    $this->pager->init();
    
    $this->setTemplate('listTypes');
  }

  /**
   * Geeft het scherm om een nieuw(e) dms_property_type toe te voegen
   */
  public function executeCreateType()
  {
    $this->dms_type = new DmsPropertyType();

    $this->setTemplate('editType');
  }

  /**
   * Geeft het scherm om een bestaand(e) dms_property_type te bewerken
   */
  public function executeEditType()
  {
    $this->dms_type = DmsPropertyTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->dms_type);
  }

  /**
   * Maakt een nieuw(e) dms_property_type aan of sla wijzigingen aan een bestaand(e) op
   */
  public function executeUpdateType()
  {
    if (!$this->getRequestParameter('id'))
    {
      $dms_type = new DmsPropertyType();
    }
    else
    {
      $dms_type = DmsPropertyTypePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($dms_type);
    }

    $dms_type->setName($this->getRequestParameter('name'));
    $dms_type->setDataType($this->getRequestParameter('data_type'));
    $options = $this->getRequestParameter('options');
    $dms_type->setOptions(($options && ($this->getRequestParameter('name') == 'selectlist')) ? json_encode(explode("\r\n", $options)) : $this->getRequestParameter('options'));

    $dms_type->save();

    return $this->redirect('ttDmsAspect/listTypes');
  }

  /**
   * Valideert voor het opslaan van dms_property_type
   */
  public function validateUpdateType()
  {
    $sql = $this->getRequestParameter('options');
    $sql_lowercase = strtolower($sql);

    $harmfullSQL = array(
      'insert', 'update', 'delete', 'drop', 'alter', 'create', 'index', 'execute', 'show'
    );

    foreach ($harmfullSQL as $keyword)
    {
      if (strpos($sql_lowercase, $keyword) !== false)
      {
        $this->getRequest()->setError('options', 'Keyword "' . strtoupper($keyword) . '" niet toegestaan in SQL query.');
      }
    }

    foreach(myDbTools::getArrayFromSQL($sql) as $row)
    {
      if (count($row) > 2)
      {
        $this->getRequest()->setError('options', 'Selecteer minstens 1 en maximaal 2 kolommen.');
      }
    }

    return !$this->getRequest()->hasErrors();
  }

  /**
	 * Handelt form validation errors af bij het bewerken van een dms_property_type
	 */
	public function handleErrorUpdateType()
  {
	  if ($this->getRequestParameter("id") != "")
	  {
		  $this->forward('ttDmsAspect', 'editType');
		}
	  else
	  {
		  $this->forward('ttDmsAspect', 'createType');
		}
  }

  /**
   * Verwijdert een dms_aspect
   */
  public function executeDeleteType()
  {
    $dms_type = DmsPropertyTypePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($dms_type);

    $dms_type->delete();

    return $this->redirect('ttDmsAspect/listTypes');
  }
  
  /**
   * Voegt een property type toe aan een aspect
   */
  public function executeAddType()
  {
    $dms_aspect = DmsAspectPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($dms_aspect);
    
    $c = new Criteria();
    $c->add(DmsAspectPropertyTypePeer::TYPE_ID, $this->getRequestParameter('type_id'));
    $c->add(DmsAspectPropertyTypePeer::ASPECT_ID, $this->getRequestParameter('id'));
    
    // Slechts 1 maal toevoegen!
    if (! DmsAspectPropertyTypePeer::doCount($c))
    {
      $rel = new DmsAspectPropertyType();
      $rel->setDmsAspect($dms_aspect);
      $rel->setTypeId($this->getRequestParameter('type_id'));
      $rel->save();
    }
    
    $this->redirect('ttDmsAspect/show?id=' . $dms_aspect->getId());
  } 
  
  /**
   * Verwijdert een property type van een aspect
   */
  public function executeRemoveType()
  {
    $rel = DmsAspectPropertyTypePeer::retrieveByPK($this->getRequestParameter('id'));
    $this->forward404Unless($rel);
    
    $rel->delete();
    
    $this->redirect('ttDmsAspect/show?id=' . $rel->getAspectId());
  }
  
}
