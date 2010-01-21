<?php


abstract class BaseDmsNode extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $store_id;


	
	protected $parent_id;


	
	protected $is_folder;


	
	protected $name;


	
	protected $disk_name;


	
	protected $created_by;


	
	protected $updated_by;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDmsStore;

	
	protected $aDmsNodeRelatedByParentId;

	
	protected $collDmsNodesRelatedByParentId;

	
	protected $lastDmsNodeRelatedByParentIdCriteria = null;

	
	protected $collDmsNodePropertys;

	
	protected $lastDmsNodePropertyCriteria = null;

	
	protected $collDmsNodeAspects;

	
	protected $lastDmsNodeAspectCriteria = null;

	
	protected $collDmsObjectNodeRefs;

	
	protected $lastDmsObjectNodeRefCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getStoreId()
	{

		return $this->store_id;
	}

	
	public function getParentId()
	{

		return $this->parent_id;
	}

	
	public function getIsFolder()
	{

		return $this->is_folder;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDiskName()
	{

		return $this->disk_name;
	}

	
	public function getCreatedBy()
	{

		return $this->created_by;
	}

	
	public function getUpdatedBy()
	{

		return $this->updated_by;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DmsNodePeer::ID;
		}

	} 
	
	public function setStoreId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->store_id !== $v) {
			$this->store_id = $v;
			$this->modifiedColumns[] = DmsNodePeer::STORE_ID;
		}

		if ($this->aDmsStore !== null && $this->aDmsStore->getId() !== $v) {
			$this->aDmsStore = null;
		}

	} 
	
	public function setParentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = DmsNodePeer::PARENT_ID;
		}

		if ($this->aDmsNodeRelatedByParentId !== null && $this->aDmsNodeRelatedByParentId->getId() !== $v) {
			$this->aDmsNodeRelatedByParentId = null;
		}

	} 
	
	public function setIsFolder($v)
	{

		if ($this->is_folder !== $v) {
			$this->is_folder = $v;
			$this->modifiedColumns[] = DmsNodePeer::IS_FOLDER;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = DmsNodePeer::NAME;
		}

	} 
	
	public function setDiskName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->disk_name !== $v) {
			$this->disk_name = $v;
			$this->modifiedColumns[] = DmsNodePeer::DISK_NAME;
		}

	} 
	
	public function setCreatedBy($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = DmsNodePeer::CREATED_BY;
		}

	} 
	
	public function setUpdatedBy($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = DmsNodePeer::UPDATED_BY;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = DmsNodePeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = DmsNodePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->store_id = $rs->getInt($startcol + 1);

			$this->parent_id = $rs->getInt($startcol + 2);

			$this->is_folder = $rs->getBoolean($startcol + 3);

			$this->name = $rs->getString($startcol + 4);

			$this->disk_name = $rs->getString($startcol + 5);

			$this->created_by = $rs->getInt($startcol + 6);

			$this->updated_by = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DmsNode object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNode:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DmsNodePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DmsNodePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDmsNode:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNode:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DmsNodePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DmsNodePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DmsNodePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDmsNode:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aDmsStore !== null) {
				if ($this->aDmsStore->isModified()) {
					$affectedRows += $this->aDmsStore->save($con);
				}
				$this->setDmsStore($this->aDmsStore);
			}

			if ($this->aDmsNodeRelatedByParentId !== null) {
				if ($this->aDmsNodeRelatedByParentId->isModified()) {
					$affectedRows += $this->aDmsNodeRelatedByParentId->save($con);
				}
				$this->setDmsNodeRelatedByParentId($this->aDmsNodeRelatedByParentId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsNodePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DmsNodePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDmsNodesRelatedByParentId !== null) {
				foreach($this->collDmsNodesRelatedByParentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDmsNodePropertys !== null) {
				foreach($this->collDmsNodePropertys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDmsNodeAspects !== null) {
				foreach($this->collDmsNodeAspects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDmsObjectNodeRefs !== null) {
				foreach($this->collDmsObjectNodeRefs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aDmsStore !== null) {
				if (!$this->aDmsStore->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsStore->getValidationFailures());
				}
			}

			if ($this->aDmsNodeRelatedByParentId !== null) {
				if (!$this->aDmsNodeRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsNodeRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = DmsNodePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDmsNodePropertys !== null) {
					foreach($this->collDmsNodePropertys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDmsNodeAspects !== null) {
					foreach($this->collDmsNodeAspects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDmsObjectNodeRefs !== null) {
					foreach($this->collDmsObjectNodeRefs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getStoreId();
				break;
			case 2:
				return $this->getParentId();
				break;
			case 3:
				return $this->getIsFolder();
				break;
			case 4:
				return $this->getName();
				break;
			case 5:
				return $this->getDiskName();
				break;
			case 6:
				return $this->getCreatedBy();
				break;
			case 7:
				return $this->getUpdatedBy();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsNodePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getStoreId(),
			$keys[2] => $this->getParentId(),
			$keys[3] => $this->getIsFolder(),
			$keys[4] => $this->getName(),
			$keys[5] => $this->getDiskName(),
			$keys[6] => $this->getCreatedBy(),
			$keys[7] => $this->getUpdatedBy(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setStoreId($value);
				break;
			case 2:
				$this->setParentId($value);
				break;
			case 3:
				$this->setIsFolder($value);
				break;
			case 4:
				$this->setName($value);
				break;
			case 5:
				$this->setDiskName($value);
				break;
			case 6:
				$this->setCreatedBy($value);
				break;
			case 7:
				$this->setUpdatedBy($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsNodePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStoreId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setParentId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsFolder($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDiskName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedBy($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedBy($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DmsNodePeer::DATABASE_NAME);

		if ($this->isColumnModified(DmsNodePeer::ID)) $criteria->add(DmsNodePeer::ID, $this->id);
		if ($this->isColumnModified(DmsNodePeer::STORE_ID)) $criteria->add(DmsNodePeer::STORE_ID, $this->store_id);
		if ($this->isColumnModified(DmsNodePeer::PARENT_ID)) $criteria->add(DmsNodePeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(DmsNodePeer::IS_FOLDER)) $criteria->add(DmsNodePeer::IS_FOLDER, $this->is_folder);
		if ($this->isColumnModified(DmsNodePeer::NAME)) $criteria->add(DmsNodePeer::NAME, $this->name);
		if ($this->isColumnModified(DmsNodePeer::DISK_NAME)) $criteria->add(DmsNodePeer::DISK_NAME, $this->disk_name);
		if ($this->isColumnModified(DmsNodePeer::CREATED_BY)) $criteria->add(DmsNodePeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(DmsNodePeer::UPDATED_BY)) $criteria->add(DmsNodePeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(DmsNodePeer::CREATED_AT)) $criteria->add(DmsNodePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DmsNodePeer::UPDATED_AT)) $criteria->add(DmsNodePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DmsNodePeer::DATABASE_NAME);

		$criteria->add(DmsNodePeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStoreId($this->store_id);

		$copyObj->setParentId($this->parent_id);

		$copyObj->setIsFolder($this->is_folder);

		$copyObj->setName($this->name);

		$copyObj->setDiskName($this->disk_name);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDmsNodesRelatedByParentId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addDmsNodeRelatedByParentId($relObj->copy($deepCopy));
			}

			foreach($this->getDmsNodePropertys() as $relObj) {
				$copyObj->addDmsNodeProperty($relObj->copy($deepCopy));
			}

			foreach($this->getDmsNodeAspects() as $relObj) {
				$copyObj->addDmsNodeAspect($relObj->copy($deepCopy));
			}

			foreach($this->getDmsObjectNodeRefs() as $relObj) {
				$copyObj->addDmsObjectNodeRef($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DmsNodePeer();
		}
		return self::$peer;
	}

	
	public function setDmsStore($v)
	{


		if ($v === null) {
			$this->setStoreId(NULL);
		} else {
			$this->setStoreId($v->getId());
		}


		$this->aDmsStore = $v;
	}


	
	public function getDmsStore($con = null)
	{
		if ($this->aDmsStore === null && ($this->store_id !== null)) {
						include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsStorePeer.php';

			$this->aDmsStore = DmsStorePeer::retrieveByPK($this->store_id, $con);

			
		}
		return $this->aDmsStore;
	}

	
	public function setDmsNodeRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->aDmsNodeRelatedByParentId = $v;
	}


	
	public function getDmsNodeRelatedByParentId($con = null)
	{
		if ($this->aDmsNodeRelatedByParentId === null && ($this->parent_id !== null)) {
						include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePeer.php';

			$this->aDmsNodeRelatedByParentId = DmsNodePeer::retrieveByPK($this->parent_id, $con);

			
		}
		return $this->aDmsNodeRelatedByParentId;
	}

	
	public function initDmsNodesRelatedByParentId()
	{
		if ($this->collDmsNodesRelatedByParentId === null) {
			$this->collDmsNodesRelatedByParentId = array();
		}
	}

	
	public function getDmsNodesRelatedByParentId($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsNodesRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collDmsNodesRelatedByParentId = array();
			} else {

				$criteria->add(DmsNodePeer::PARENT_ID, $this->getId());

				DmsNodePeer::addSelectColumns($criteria);
				$this->collDmsNodesRelatedByParentId = DmsNodePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DmsNodePeer::PARENT_ID, $this->getId());

				DmsNodePeer::addSelectColumns($criteria);
				if (!isset($this->lastDmsNodeRelatedByParentIdCriteria) || !$this->lastDmsNodeRelatedByParentIdCriteria->equals($criteria)) {
					$this->collDmsNodesRelatedByParentId = DmsNodePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDmsNodeRelatedByParentIdCriteria = $criteria;
		return $this->collDmsNodesRelatedByParentId;
	}

	
	public function countDmsNodesRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DmsNodePeer::PARENT_ID, $this->getId());

		return DmsNodePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDmsNodeRelatedByParentId(DmsNode $l)
	{
		$this->collDmsNodesRelatedByParentId[] = $l;
		$l->setDmsNodeRelatedByParentId($this);
	}


	
	public function getDmsNodesRelatedByParentIdJoinDmsStore($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsNodesRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDmsNodesRelatedByParentId = array();
			} else {

				$criteria->add(DmsNodePeer::PARENT_ID, $this->getId());

				$this->collDmsNodesRelatedByParentId = DmsNodePeer::doSelectJoinDmsStore($criteria, $con);
			}
		} else {
									
			$criteria->add(DmsNodePeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDmsNodeRelatedByParentIdCriteria) || !$this->lastDmsNodeRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDmsNodesRelatedByParentId = DmsNodePeer::doSelectJoinDmsStore($criteria, $con);
			}
		}
		$this->lastDmsNodeRelatedByParentIdCriteria = $criteria;

		return $this->collDmsNodesRelatedByParentId;
	}

	
	public function initDmsNodePropertys()
	{
		if ($this->collDmsNodePropertys === null) {
			$this->collDmsNodePropertys = array();
		}
	}

	
	public function getDmsNodePropertys($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsNodePropertys === null) {
			if ($this->isNew()) {
			   $this->collDmsNodePropertys = array();
			} else {

				$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

				DmsNodePropertyPeer::addSelectColumns($criteria);
				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

				DmsNodePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastDmsNodePropertyCriteria) || !$this->lastDmsNodePropertyCriteria->equals($criteria)) {
					$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDmsNodePropertyCriteria = $criteria;
		return $this->collDmsNodePropertys;
	}

	
	public function countDmsNodePropertys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

		return DmsNodePropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDmsNodeProperty(DmsNodeProperty $l)
	{
		$this->collDmsNodePropertys[] = $l;
		$l->setDmsNode($this);
	}


	
	public function getDmsNodePropertysJoinDmsPropertyType($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsNodePropertys === null) {
			if ($this->isNew()) {
				$this->collDmsNodePropertys = array();
			} else {

				$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelectJoinDmsPropertyType($criteria, $con);
			}
		} else {
									
			$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

			if (!isset($this->lastDmsNodePropertyCriteria) || !$this->lastDmsNodePropertyCriteria->equals($criteria)) {
				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelectJoinDmsPropertyType($criteria, $con);
			}
		}
		$this->lastDmsNodePropertyCriteria = $criteria;

		return $this->collDmsNodePropertys;
	}

	
	public function initDmsNodeAspects()
	{
		if ($this->collDmsNodeAspects === null) {
			$this->collDmsNodeAspects = array();
		}
	}

	
	public function getDmsNodeAspects($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodeAspectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsNodeAspects === null) {
			if ($this->isNew()) {
			   $this->collDmsNodeAspects = array();
			} else {

				$criteria->add(DmsNodeAspectPeer::NODE_ID, $this->getId());

				DmsNodeAspectPeer::addSelectColumns($criteria);
				$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DmsNodeAspectPeer::NODE_ID, $this->getId());

				DmsNodeAspectPeer::addSelectColumns($criteria);
				if (!isset($this->lastDmsNodeAspectCriteria) || !$this->lastDmsNodeAspectCriteria->equals($criteria)) {
					$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDmsNodeAspectCriteria = $criteria;
		return $this->collDmsNodeAspects;
	}

	
	public function countDmsNodeAspects($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodeAspectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DmsNodeAspectPeer::NODE_ID, $this->getId());

		return DmsNodeAspectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDmsNodeAspect(DmsNodeAspect $l)
	{
		$this->collDmsNodeAspects[] = $l;
		$l->setDmsNode($this);
	}


	
	public function getDmsNodeAspectsJoinDmsAspect($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodeAspectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsNodeAspects === null) {
			if ($this->isNew()) {
				$this->collDmsNodeAspects = array();
			} else {

				$criteria->add(DmsNodeAspectPeer::NODE_ID, $this->getId());

				$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelectJoinDmsAspect($criteria, $con);
			}
		} else {
									
			$criteria->add(DmsNodeAspectPeer::NODE_ID, $this->getId());

			if (!isset($this->lastDmsNodeAspectCriteria) || !$this->lastDmsNodeAspectCriteria->equals($criteria)) {
				$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelectJoinDmsAspect($criteria, $con);
			}
		}
		$this->lastDmsNodeAspectCriteria = $criteria;

		return $this->collDmsNodeAspects;
	}

	
	public function initDmsObjectNodeRefs()
	{
		if ($this->collDmsObjectNodeRefs === null) {
			$this->collDmsObjectNodeRefs = array();
		}
	}

	
	public function getDmsObjectNodeRefs($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsObjectNodeRefPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsObjectNodeRefs === null) {
			if ($this->isNew()) {
			   $this->collDmsObjectNodeRefs = array();
			} else {

				$criteria->add(DmsObjectNodeRefPeer::NODE_ID, $this->getId());

				DmsObjectNodeRefPeer::addSelectColumns($criteria);
				$this->collDmsObjectNodeRefs = DmsObjectNodeRefPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DmsObjectNodeRefPeer::NODE_ID, $this->getId());

				DmsObjectNodeRefPeer::addSelectColumns($criteria);
				if (!isset($this->lastDmsObjectNodeRefCriteria) || !$this->lastDmsObjectNodeRefCriteria->equals($criteria)) {
					$this->collDmsObjectNodeRefs = DmsObjectNodeRefPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDmsObjectNodeRefCriteria = $criteria;
		return $this->collDmsObjectNodeRefs;
	}

	
	public function countDmsObjectNodeRefs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsObjectNodeRefPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DmsObjectNodeRefPeer::NODE_ID, $this->getId());

		return DmsObjectNodeRefPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDmsObjectNodeRef(DmsObjectNodeRef $l)
	{
		$this->collDmsObjectNodeRefs[] = $l;
		$l->setDmsNode($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDmsNode:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDmsNode::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 