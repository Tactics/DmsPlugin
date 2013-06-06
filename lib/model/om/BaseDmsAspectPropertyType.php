<?php


abstract class BaseDmsAspectPropertyType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $aspect_id;


	
	protected $type_id;


	
	protected $volgorde;


	
	protected $created_by;


	
	protected $updated_by;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDmsAspect;

	
	protected $aDmsPropertyType;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAspectId()
	{

		return $this->aspect_id;
	}

	
	public function getTypeId()
	{

		return $this->type_id;
	}

	
	public function getVolgorde()
	{

		return $this->volgorde;
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
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::ID;
		}

	} 
	
	public function setAspectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->aspect_id !== $v) {
			$this->aspect_id = $v;
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::ASPECT_ID;
		}

		if ($this->aDmsAspect !== null && $this->aDmsAspect->getId() !== $v) {
			$this->aDmsAspect = null;
		}

	} 
	
	public function setTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type_id !== $v) {
			$this->type_id = $v;
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::TYPE_ID;
		}

		if ($this->aDmsPropertyType !== null && $this->aDmsPropertyType->getId() !== $v) {
			$this->aDmsPropertyType = null;
		}

	} 
	
	public function setVolgorde($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->volgorde !== $v) {
			$this->volgorde = $v;
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::VOLGORDE;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::CREATED_BY;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::UPDATED_BY;
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
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::CREATED_AT;
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
			$this->modifiedColumns[] = DmsAspectPropertyTypePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->aspect_id = $rs->getInt($startcol + 1);

			$this->type_id = $rs->getInt($startcol + 2);

			$this->volgorde = $rs->getInt($startcol + 3);

			$this->created_by = $rs->getInt($startcol + 4);

			$this->updated_by = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DmsAspectPropertyType object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsAspectPropertyType:delete:pre') as $callable)
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
			$con = Propel::getConnection(DmsAspectPropertyTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DmsAspectPropertyTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDmsAspectPropertyType:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsAspectPropertyType:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DmsAspectPropertyTypePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DmsAspectPropertyTypePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DmsAspectPropertyTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDmsAspectPropertyType:save:post') as $callable)
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


												
			if ($this->aDmsAspect !== null) {
				if ($this->aDmsAspect->isModified()) {
					$affectedRows += $this->aDmsAspect->save($con);
				}
				$this->setDmsAspect($this->aDmsAspect);
			}

			if ($this->aDmsPropertyType !== null) {
				if ($this->aDmsPropertyType->isModified()) {
					$affectedRows += $this->aDmsPropertyType->save($con);
				}
				$this->setDmsPropertyType($this->aDmsPropertyType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsAspectPropertyTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DmsAspectPropertyTypePeer::doUpdate($this, $con);
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


												
			if ($this->aDmsAspect !== null) {
				if (!$this->aDmsAspect->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsAspect->getValidationFailures());
				}
			}

			if ($this->aDmsPropertyType !== null) {
				if (!$this->aDmsPropertyType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsPropertyType->getValidationFailures());
				}
			}


			if (($retval = DmsAspectPropertyTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsAspectPropertyTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAspectId();
				break;
			case 2:
				return $this->getTypeId();
				break;
			case 3:
				return $this->getVolgorde();
				break;
			case 4:
				return $this->getCreatedBy();
				break;
			case 5:
				return $this->getUpdatedBy();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsAspectPropertyTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAspectId(),
			$keys[2] => $this->getTypeId(),
			$keys[3] => $this->getVolgorde(),
			$keys[4] => $this->getCreatedBy(),
			$keys[5] => $this->getUpdatedBy(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsAspectPropertyTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAspectId($value);
				break;
			case 2:
				$this->setTypeId($value);
				break;
			case 3:
				$this->setVolgorde($value);
				break;
			case 4:
				$this->setCreatedBy($value);
				break;
			case 5:
				$this->setUpdatedBy($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsAspectPropertyTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAspectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVolgorde($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedBy($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DmsAspectPropertyTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(DmsAspectPropertyTypePeer::ID)) $criteria->add(DmsAspectPropertyTypePeer::ID, $this->id);
		if ($this->isColumnModified(DmsAspectPropertyTypePeer::ASPECT_ID)) $criteria->add(DmsAspectPropertyTypePeer::ASPECT_ID, $this->aspect_id);
		if ($this->isColumnModified(DmsAspectPropertyTypePeer::TYPE_ID)) $criteria->add(DmsAspectPropertyTypePeer::TYPE_ID, $this->type_id);
		if ($this->isColumnModified(DmsAspectPropertyTypePeer::VOLGORDE)) $criteria->add(DmsAspectPropertyTypePeer::VOLGORDE, $this->volgorde);
		if ($this->isColumnModified(DmsAspectPropertyTypePeer::CREATED_BY)) $criteria->add(DmsAspectPropertyTypePeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(DmsAspectPropertyTypePeer::UPDATED_BY)) $criteria->add(DmsAspectPropertyTypePeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(DmsAspectPropertyTypePeer::CREATED_AT)) $criteria->add(DmsAspectPropertyTypePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DmsAspectPropertyTypePeer::UPDATED_AT)) $criteria->add(DmsAspectPropertyTypePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DmsAspectPropertyTypePeer::DATABASE_NAME);

		$criteria->add(DmsAspectPropertyTypePeer::ID, $this->id);

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

		$copyObj->setAspectId($this->aspect_id);

		$copyObj->setTypeId($this->type_id);

		$copyObj->setVolgorde($this->volgorde);

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
			self::$peer = new DmsAspectPropertyTypePeer();
		}
		return self::$peer;
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

	
	public function setDmsPropertyType($v)
	{


		if ($v === null) {
			$this->setTypeId(NULL);
		} else {
			$this->setTypeId($v->getId());
		}


		$this->aDmsPropertyType = $v;
	}


	
	public function getDmsPropertyType($con = null)
	{
		if ($this->aDmsPropertyType === null && ($this->type_id !== null)) {
						include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsPropertyTypePeer.php';

			$this->aDmsPropertyType = DmsPropertyTypePeer::retrieveByPK($this->type_id, $con);

			
		}
		return $this->aDmsPropertyType;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDmsAspectPropertyType:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDmsAspectPropertyType::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 