<?php


abstract class BaseDmsAspect extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $created_by;


	
	protected $updated_by;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDmsAspectPropertyTypes;

	
	protected $lastDmsAspectPropertyTypeCriteria = null;

	
	protected $collDmsNodeAspects;

	
	protected $lastDmsNodeAspectCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
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
			$this->modifiedColumns[] = DmsAspectPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = DmsAspectPeer::NAME;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = DmsAspectPeer::CREATED_BY;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = DmsAspectPeer::UPDATED_BY;
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
			$this->modifiedColumns[] = DmsAspectPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DmsAspectPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->created_by = $rs->getInt($startcol + 2);

			$this->updated_by = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DmsAspect object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsAspect:delete:pre') as $callable)
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
			$con = Propel::getConnection(DmsAspectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DmsAspectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDmsAspect:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsAspect:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DmsAspectPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DmsAspectPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DmsAspectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDmsAspect:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsAspectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DmsAspectPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDmsAspectPropertyTypes !== null) {
				foreach($this->collDmsAspectPropertyTypes as $referrerFK) {
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


			if (($retval = DmsAspectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDmsAspectPropertyTypes !== null) {
					foreach($this->collDmsAspectPropertyTypes as $referrerFK) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsAspectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getCreatedBy();
				break;
			case 3:
				return $this->getUpdatedBy();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsAspectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getCreatedBy(),
			$keys[3] => $this->getUpdatedBy(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsAspectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setCreatedBy($value);
				break;
			case 3:
				$this->setUpdatedBy($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsAspectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedBy($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedBy($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DmsAspectPeer::DATABASE_NAME);

		if ($this->isColumnModified(DmsAspectPeer::ID)) $criteria->add(DmsAspectPeer::ID, $this->id);
		if ($this->isColumnModified(DmsAspectPeer::NAME)) $criteria->add(DmsAspectPeer::NAME, $this->name);
		if ($this->isColumnModified(DmsAspectPeer::CREATED_BY)) $criteria->add(DmsAspectPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(DmsAspectPeer::UPDATED_BY)) $criteria->add(DmsAspectPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(DmsAspectPeer::CREATED_AT)) $criteria->add(DmsAspectPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DmsAspectPeer::UPDATED_AT)) $criteria->add(DmsAspectPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DmsAspectPeer::DATABASE_NAME);

		$criteria->add(DmsAspectPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDmsAspectPropertyTypes() as $relObj) {
				$copyObj->addDmsAspectPropertyType($relObj->copy($deepCopy));
			}

			foreach($this->getDmsNodeAspects() as $relObj) {
				$copyObj->addDmsNodeAspect($relObj->copy($deepCopy));
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
			self::$peer = new DmsAspectPeer();
		}
		return self::$peer;
	}

	
	public function initDmsAspectPropertyTypes()
	{
		if ($this->collDmsAspectPropertyTypes === null) {
			$this->collDmsAspectPropertyTypes = array();
		}
	}

	
	public function getDmsAspectPropertyTypes($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsAspectPropertyTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsAspectPropertyTypes === null) {
			if ($this->isNew()) {
			   $this->collDmsAspectPropertyTypes = array();
			} else {

				$criteria->add(DmsAspectPropertyTypePeer::ASPECT_ID, $this->getId());

				DmsAspectPropertyTypePeer::addSelectColumns($criteria);
				$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DmsAspectPropertyTypePeer::ASPECT_ID, $this->getId());

				DmsAspectPropertyTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastDmsAspectPropertyTypeCriteria) || !$this->lastDmsAspectPropertyTypeCriteria->equals($criteria)) {
					$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDmsAspectPropertyTypeCriteria = $criteria;
		return $this->collDmsAspectPropertyTypes;
	}

	
	public function countDmsAspectPropertyTypes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsAspectPropertyTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DmsAspectPropertyTypePeer::ASPECT_ID, $this->getId());

		return DmsAspectPropertyTypePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDmsAspectPropertyType(DmsAspectPropertyType $l)
	{
		$this->collDmsAspectPropertyTypes[] = $l;
		$l->setDmsAspect($this);
	}


	
	public function getDmsAspectPropertyTypesJoinDmsPropertyType($criteria = null, $con = null)
	{
				include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsAspectPropertyTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDmsAspectPropertyTypes === null) {
			if ($this->isNew()) {
				$this->collDmsAspectPropertyTypes = array();
			} else {

				$criteria->add(DmsAspectPropertyTypePeer::ASPECT_ID, $this->getId());

				$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelectJoinDmsPropertyType($criteria, $con);
			}
		} else {
									
			$criteria->add(DmsAspectPropertyTypePeer::ASPECT_ID, $this->getId());

			if (!isset($this->lastDmsAspectPropertyTypeCriteria) || !$this->lastDmsAspectPropertyTypeCriteria->equals($criteria)) {
				$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelectJoinDmsPropertyType($criteria, $con);
			}
		}
		$this->lastDmsAspectPropertyTypeCriteria = $criteria;

		return $this->collDmsAspectPropertyTypes;
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

				$criteria->add(DmsNodeAspectPeer::ASPECT_ID, $this->getId());

				DmsNodeAspectPeer::addSelectColumns($criteria);
				$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DmsNodeAspectPeer::ASPECT_ID, $this->getId());

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

		$criteria->add(DmsNodeAspectPeer::ASPECT_ID, $this->getId());

		return DmsNodeAspectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDmsNodeAspect(DmsNodeAspect $l)
	{
		$this->collDmsNodeAspects[] = $l;
		$l->setDmsAspect($this);
	}


	
	public function getDmsNodeAspectsJoinDmsNode($criteria = null, $con = null)
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

				$criteria->add(DmsNodeAspectPeer::ASPECT_ID, $this->getId());

				$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelectJoinDmsNode($criteria, $con);
			}
		} else {
									
			$criteria->add(DmsNodeAspectPeer::ASPECT_ID, $this->getId());

			if (!isset($this->lastDmsNodeAspectCriteria) || !$this->lastDmsNodeAspectCriteria->equals($criteria)) {
				$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelectJoinDmsNode($criteria, $con);
			}
		}
		$this->lastDmsNodeAspectCriteria = $criteria;

		return $this->collDmsNodeAspects;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDmsAspect:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDmsAspect::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 