<?php


abstract class BaseDmsNodeAspect extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $node_id;


	
	protected $aspect_id;


	
	protected $created_by;


	
	protected $updated_by;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDmsNode;

	
	protected $aDmsAspect;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNodeId()
	{

		return $this->node_id;
	}

	
	public function getAspectId()
	{

		return $this->aspect_id;
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
			$this->modifiedColumns[] = DmsNodeAspectPeer::ID;
		}

	} 
	
	public function setNodeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->node_id !== $v) {
			$this->node_id = $v;
			$this->modifiedColumns[] = DmsNodeAspectPeer::NODE_ID;
		}

		if ($this->aDmsNode !== null && $this->aDmsNode->getId() !== $v) {
			$this->aDmsNode = null;
		}

	} 
	
	public function setAspectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->aspect_id !== $v) {
			$this->aspect_id = $v;
			$this->modifiedColumns[] = DmsNodeAspectPeer::ASPECT_ID;
		}

		if ($this->aDmsAspect !== null && $this->aDmsAspect->getId() !== $v) {
			$this->aDmsAspect = null;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = DmsNodeAspectPeer::CREATED_BY;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = DmsNodeAspectPeer::UPDATED_BY;
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
			$this->modifiedColumns[] = DmsNodeAspectPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DmsNodeAspectPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->node_id = $rs->getInt($startcol + 1);

			$this->aspect_id = $rs->getInt($startcol + 2);

			$this->created_by = $rs->getInt($startcol + 3);

			$this->updated_by = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DmsNodeAspect object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodeAspect:delete:pre') as $callable)
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
			$con = Propel::getConnection(DmsNodeAspectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DmsNodeAspectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDmsNodeAspect:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodeAspect:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DmsNodeAspectPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DmsNodeAspectPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DmsNodeAspectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDmsNodeAspect:save:post') as $callable)
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


												
			if ($this->aDmsNode !== null) {
				if ($this->aDmsNode->isModified()) {
					$affectedRows += $this->aDmsNode->save($con);
				}
				$this->setDmsNode($this->aDmsNode);
			}

			if ($this->aDmsAspect !== null) {
				if ($this->aDmsAspect->isModified()) {
					$affectedRows += $this->aDmsAspect->save($con);
				}
				$this->setDmsAspect($this->aDmsAspect);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsNodeAspectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DmsNodeAspectPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aDmsNode !== null) {
				if (!$this->aDmsNode->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsNode->getValidationFailures());
				}
			}

			if ($this->aDmsAspect !== null) {
				if (!$this->aDmsAspect->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsAspect->getValidationFailures());
				}
			}


			if (($retval = DmsNodeAspectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodeAspectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNodeId();
				break;
			case 2:
				return $this->getAspectId();
				break;
			case 3:
				return $this->getCreatedBy();
				break;
			case 4:
				return $this->getUpdatedBy();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsNodeAspectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNodeId(),
			$keys[2] => $this->getAspectId(),
			$keys[3] => $this->getCreatedBy(),
			$keys[4] => $this->getUpdatedBy(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodeAspectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNodeId($value);
				break;
			case 2:
				$this->setAspectId($value);
				break;
			case 3:
				$this->setCreatedBy($value);
				break;
			case 4:
				$this->setUpdatedBy($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsNodeAspectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNodeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAspectId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedBy($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DmsNodeAspectPeer::DATABASE_NAME);

		if ($this->isColumnModified(DmsNodeAspectPeer::ID)) $criteria->add(DmsNodeAspectPeer::ID, $this->id);
		if ($this->isColumnModified(DmsNodeAspectPeer::NODE_ID)) $criteria->add(DmsNodeAspectPeer::NODE_ID, $this->node_id);
		if ($this->isColumnModified(DmsNodeAspectPeer::ASPECT_ID)) $criteria->add(DmsNodeAspectPeer::ASPECT_ID, $this->aspect_id);
		if ($this->isColumnModified(DmsNodeAspectPeer::CREATED_BY)) $criteria->add(DmsNodeAspectPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(DmsNodeAspectPeer::UPDATED_BY)) $criteria->add(DmsNodeAspectPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(DmsNodeAspectPeer::CREATED_AT)) $criteria->add(DmsNodeAspectPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DmsNodeAspectPeer::UPDATED_AT)) $criteria->add(DmsNodeAspectPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DmsNodeAspectPeer::DATABASE_NAME);

		$criteria->add(DmsNodeAspectPeer::ID, $this->id);

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

		$copyObj->setNodeId($this->node_id);

		$copyObj->setAspectId($this->aspect_id);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new DmsNodeAspectPeer();
		}
		return self::$peer;
	}

	
	public function setDmsNode($v)
	{


		if ($v === null) {
			$this->setNodeId(NULL);
		} else {
			$this->setNodeId($v->getId());
		}


		$this->aDmsNode = $v;
	}


	
	public function getDmsNode($con = null)
	{
		if ($this->aDmsNode === null && ($this->node_id !== null)) {
						include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePeer.php';

			$this->aDmsNode = DmsNodePeer::retrieveByPK($this->node_id, $con);

			
		}
		return $this->aDmsNode;
	}

	
	public function setDmsAspect($v)
	{


		if ($v === null) {
			$this->setAspectId(NULL);
		} else {
			$this->setAspectId($v->getId());
		}


		$this->aDmsAspect = $v;
	}


	
	public function getDmsAspect($con = null)
	{
		if ($this->aDmsAspect === null && ($this->aspect_id !== null)) {
						include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsAspectPeer.php';

			$this->aDmsAspect = DmsAspectPeer::retrieveByPK($this->aspect_id, $con);

			
		}
		return $this->aDmsAspect;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDmsNodeAspect:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDmsNodeAspect::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 