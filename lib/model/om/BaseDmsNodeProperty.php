<?php


abstract class BaseDmsNodeProperty extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $node_id;


	
	protected $type_id;


	
	protected $boolean_value;


	
	protected $int_value;


	
	protected $float_value;


	
	protected $string_value;


	
	protected $text_value;


	
	protected $created_by;


	
	protected $updated_by;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDmsPropertyType;

	
	protected $aDmsNode;

	
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

	
	public function getTypeId()
	{

		return $this->type_id;
	}

	
	public function getBooleanValue()
	{

		return $this->boolean_value;
	}

	
	public function getIntValue()
	{

		return $this->int_value;
	}

	
	public function getFloatValue()
	{

		return $this->float_value;
	}

	
	public function getStringValue()
	{

		return $this->string_value;
	}

	
	public function getTextValue()
	{

		return $this->text_value;
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
			$this->modifiedColumns[] = DmsNodePropertyPeer::ID;
		}

	} 
	
	public function setNodeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->node_id !== $v) {
			$this->node_id = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::NODE_ID;
		}

		if ($this->aDmsNode !== null && $this->aDmsNode->getId() !== $v) {
			$this->aDmsNode = null;
		}

	} 
	
	public function setTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type_id !== $v) {
			$this->type_id = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::TYPE_ID;
		}

		if ($this->aDmsPropertyType !== null && $this->aDmsPropertyType->getId() !== $v) {
			$this->aDmsPropertyType = null;
		}

	} 
	
	public function setBooleanValue($v)
	{

		if ($this->boolean_value !== $v) {
			$this->boolean_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::BOOLEAN_VALUE;
		}

	} 
	
	public function setIntValue($v)
	{

		if ($this->int_value !== $v) {
			$this->int_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::INT_VALUE;
		}

	} 
	
	public function setFloatValue($v)
	{

		if ($this->float_value !== $v) {
			$this->float_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::FLOAT_VALUE;
		}

	} 
	
	public function setStringValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->string_value !== $v) {
			$this->string_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::STRING_VALUE;
		}

	} 
	
	public function setTextValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text_value !== $v) {
			$this->text_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::TEXT_VALUE;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::CREATED_BY;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::UPDATED_BY;
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
			$this->modifiedColumns[] = DmsNodePropertyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DmsNodePropertyPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->node_id = $rs->getInt($startcol + 1);

			$this->type_id = $rs->getInt($startcol + 2);

			$this->boolean_value = $rs->getBoolean($startcol + 3);

			$this->int_value = $rs->getBoolean($startcol + 4);

			$this->float_value = $rs->getFloat($startcol + 5);

			$this->string_value = $rs->getString($startcol + 6);

			$this->text_value = $rs->getString($startcol + 7);

			$this->created_by = $rs->getInt($startcol + 8);

			$this->updated_by = $rs->getInt($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DmsNodeProperty object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodeProperty:delete:pre') as $callable)
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
			$con = Propel::getConnection(DmsNodePropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DmsNodePropertyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDmsNodeProperty:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodeProperty:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DmsNodePropertyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DmsNodePropertyPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DmsNodePropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDmsNodeProperty:save:post') as $callable)
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


												
			if ($this->aDmsPropertyType !== null) {
				if ($this->aDmsPropertyType->isModified()) {
					$affectedRows += $this->aDmsPropertyType->save($con);
				}
				$this->setDmsPropertyType($this->aDmsPropertyType);
			}

			if ($this->aDmsNode !== null) {
				if ($this->aDmsNode->isModified()) {
					$affectedRows += $this->aDmsNode->save($con);
				}
				$this->setDmsNode($this->aDmsNode);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsNodePropertyPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DmsNodePropertyPeer::doUpdate($this, $con);
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


												
			if ($this->aDmsPropertyType !== null) {
				if (!$this->aDmsPropertyType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsPropertyType->getValidationFailures());
				}
			}

			if ($this->aDmsNode !== null) {
				if (!$this->aDmsNode->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDmsNode->getValidationFailures());
				}
			}


			if (($retval = DmsNodePropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodePropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTypeId();
				break;
			case 3:
				return $this->getBooleanValue();
				break;
			case 4:
				return $this->getIntValue();
				break;
			case 5:
				return $this->getFloatValue();
				break;
			case 6:
				return $this->getStringValue();
				break;
			case 7:
				return $this->getTextValue();
				break;
			case 8:
				return $this->getCreatedBy();
				break;
			case 9:
				return $this->getUpdatedBy();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsNodePropertyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNodeId(),
			$keys[2] => $this->getTypeId(),
			$keys[3] => $this->getBooleanValue(),
			$keys[4] => $this->getIntValue(),
			$keys[5] => $this->getFloatValue(),
			$keys[6] => $this->getStringValue(),
			$keys[7] => $this->getTextValue(),
			$keys[8] => $this->getCreatedBy(),
			$keys[9] => $this->getUpdatedBy(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodePropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTypeId($value);
				break;
			case 3:
				$this->setBooleanValue($value);
				break;
			case 4:
				$this->setIntValue($value);
				break;
			case 5:
				$this->setFloatValue($value);
				break;
			case 6:
				$this->setStringValue($value);
				break;
			case 7:
				$this->setTextValue($value);
				break;
			case 8:
				$this->setCreatedBy($value);
				break;
			case 9:
				$this->setUpdatedBy($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsNodePropertyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNodeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBooleanValue($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIntValue($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFloatValue($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStringValue($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTextValue($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedBy($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedBy($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DmsNodePropertyPeer::DATABASE_NAME);

		if ($this->isColumnModified(DmsNodePropertyPeer::ID)) $criteria->add(DmsNodePropertyPeer::ID, $this->id);
		if ($this->isColumnModified(DmsNodePropertyPeer::NODE_ID)) $criteria->add(DmsNodePropertyPeer::NODE_ID, $this->node_id);
		if ($this->isColumnModified(DmsNodePropertyPeer::TYPE_ID)) $criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->type_id);
		if ($this->isColumnModified(DmsNodePropertyPeer::BOOLEAN_VALUE)) $criteria->add(DmsNodePropertyPeer::BOOLEAN_VALUE, $this->boolean_value);
		if ($this->isColumnModified(DmsNodePropertyPeer::INT_VALUE)) $criteria->add(DmsNodePropertyPeer::INT_VALUE, $this->int_value);
		if ($this->isColumnModified(DmsNodePropertyPeer::FLOAT_VALUE)) $criteria->add(DmsNodePropertyPeer::FLOAT_VALUE, $this->float_value);
		if ($this->isColumnModified(DmsNodePropertyPeer::STRING_VALUE)) $criteria->add(DmsNodePropertyPeer::STRING_VALUE, $this->string_value);
		if ($this->isColumnModified(DmsNodePropertyPeer::TEXT_VALUE)) $criteria->add(DmsNodePropertyPeer::TEXT_VALUE, $this->text_value);
		if ($this->isColumnModified(DmsNodePropertyPeer::CREATED_BY)) $criteria->add(DmsNodePropertyPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(DmsNodePropertyPeer::UPDATED_BY)) $criteria->add(DmsNodePropertyPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(DmsNodePropertyPeer::CREATED_AT)) $criteria->add(DmsNodePropertyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DmsNodePropertyPeer::UPDATED_AT)) $criteria->add(DmsNodePropertyPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DmsNodePropertyPeer::DATABASE_NAME);

		$criteria->add(DmsNodePropertyPeer::ID, $this->id);
		$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->node_id);
		$criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->type_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getNodeId();

		$pks[2] = $this->getTypeId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setNodeId($keys[1]);

		$this->setTypeId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setBooleanValue($this->boolean_value);

		$copyObj->setIntValue($this->int_value);

		$copyObj->setFloatValue($this->float_value);

		$copyObj->setStringValue($this->string_value);

		$copyObj->setTextValue($this->text_value);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setNodeId(NULL); 
		$copyObj->setTypeId(NULL); 
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
			self::$peer = new DmsNodePropertyPeer();
		}
		return self::$peer;
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDmsNodeProperty:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDmsNodeProperty::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 