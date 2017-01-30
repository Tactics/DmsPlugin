<?php

/**
 * Base class that represents a row from the 'dms_node_property' table.
 *
 * 
 *
 * @package    plugins.ttDmsPlugin.lib.model.om
 */
abstract class BaseDmsNodeProperty extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DmsNodePropertyPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the node_id field.
	 * @var        int
	 */
	protected $node_id;


	/**
	 * The value for the type_id field.
	 * @var        int
	 */
	protected $type_id;


	/**
	 * The value for the boolean_value field.
	 * @var        boolean
	 */
	protected $boolean_value;


	/**
	 * The value for the int_value field.
	 * @var        boolean
	 */
	protected $int_value;


	/**
	 * The value for the float_value field.
	 * @var        double
	 */
	protected $float_value;


	/**
	 * The value for the string_value field.
	 * @var        string
	 */
	protected $string_value;


	/**
	 * The value for the text_value field.
	 * @var        string
	 */
	protected $text_value;


	/**
	 * The value for the created_by field.
	 * @var        int
	 */
	protected $created_by;


	/**
	 * The value for the updated_by field.
	 * @var        int
	 */
	protected $updated_by;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the updated_at field.
	 * @var        int
	 */
	protected $updated_at;

	/**
	 * @var        DmsPropertyType
	 */
	protected $aDmsPropertyType;

	/**
	 * @var        DmsNode
	 */
	protected $aDmsNode;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [node_id] column value.
	 * 
	 * @return     int
	 */
	public function getNodeId()
	{

		return $this->node_id;
	}

	/**
	 * Get the [type_id] column value.
	 * 
	 * @return     int
	 */
	public function getTypeId()
	{

		return $this->type_id;
	}

	/**
	 * Get the [boolean_value] column value.
	 * 
	 * @return     boolean
	 */
	public function getBooleanValue()
	{

		return $this->boolean_value;
	}

	/**
	 * Get the [int_value] column value.
	 * 
	 * @return     boolean
	 */
	public function getIntValue()
	{

		return $this->int_value;
	}

	/**
	 * Get the [float_value] column value.
	 * 
	 * @return     double
	 */
	public function getFloatValue()
	{

		return $this->float_value;
	}

	/**
	 * Get the [string_value] column value.
	 * 
	 * @return     string
	 */
	public function getStringValue()
	{

		return $this->string_value;
	}

	/**
	 * Get the [text_value] column value.
	 * 
	 * @return     string
	 */
	public function getTextValue()
	{

		return $this->text_value;
	}

	/**
	 * Get the [created_by] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedBy()
	{

		return $this->created_by;
	}

	/**
	 * Get the [updated_by] column value.
	 * 
	 * @return     int
	 */
	public function getUpdatedBy()
	{

		return $this->updated_by;
	}

	/**
	 * Get the [optionally formatted] [created_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
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

	/**
	 * Get the [optionally formatted] [updated_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
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

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [node_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setNodeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
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

	} // setNodeId()

	/**
	 * Set the value of [type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
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

	} // setTypeId()

	/**
	 * Set the value of [boolean_value] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setBooleanValue($v)
	{

		if ($this->boolean_value !== $v) {
			$this->boolean_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::BOOLEAN_VALUE;
		}

	} // setBooleanValue()

	/**
	 * Set the value of [int_value] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIntValue($v)
	{

		if ($this->int_value !== $v) {
			$this->int_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::INT_VALUE;
		}

	} // setIntValue()

	/**
	 * Set the value of [float_value] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setFloatValue($v)
	{

		if ($this->float_value !== $v) {
			$this->float_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::FLOAT_VALUE;
		}

	} // setFloatValue()

	/**
	 * Set the value of [string_value] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStringValue($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->string_value !== $v) {
			$this->string_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::STRING_VALUE;
		}

	} // setStringValue()

	/**
	 * Set the value of [text_value] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setTextValue($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text_value !== $v) {
			$this->text_value = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::TEXT_VALUE;
		}

	} // setTextValue()

	/**
	 * Set the value of [created_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::CREATED_BY;
		}

	} // setCreatedBy()

	/**
	 * Set the value of [updated_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = DmsNodePropertyPeer::UPDATED_BY;
		}

	} // setUpdatedBy()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = DmsNodePropertyPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = DmsNodePropertyPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
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

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 12; // 12 = DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating DmsNodeProperty object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
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
	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
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

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsNodePropertyPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += DmsNodePropertyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
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

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

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

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodePropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
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
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
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

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DmsNodePropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
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
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
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

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
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

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DmsNodePropertyPeer::DATABASE_NAME);

		$criteria->add(DmsNodePropertyPeer::ID, $this->id);
		$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->node_id);
		$criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->type_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getNodeId();

		$pks[2] = $this->getTypeId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setNodeId($keys[1]);

		$this->setTypeId($keys[2]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of DmsNodeProperty (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
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

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

		$copyObj->setNodeId(NULL); // this is a pkey column, so set to default value

		$copyObj->setTypeId(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     DmsNodeProperty Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     DmsNodePropertyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DmsNodePropertyPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a DmsPropertyType object.
	 *
	 * @param      DmsPropertyType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setDmsPropertyType($v)
	{


		if ($v === null) {
			$this->setTypeId(NULL);
		} else {
			$this->setTypeId($v->getId());
		}


		$this->aDmsPropertyType = $v;
	}


	/**
	 * Get the associated DmsPropertyType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     DmsPropertyType The associated DmsPropertyType object.
	 * @throws     PropelException
	 */
	public function getDmsPropertyType($con = null)
	{
		if ($this->aDmsPropertyType === null && ($this->type_id !== null)) {
			// include the related Peer class
			include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsPropertyTypePeer.php';

			$this->aDmsPropertyType = DmsPropertyTypePeer::retrieveByPK($this->type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DmsPropertyTypePeer::retrieveByPK($this->type_id, $con);
			   $obj->addDmsPropertyTypes($this);
			 */
		}
		return $this->aDmsPropertyType;
	}

	/**
	 * Declares an association between this object and a DmsNode object.
	 *
	 * @param      DmsNode $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setDmsNode($v)
	{


		if ($v === null) {
			$this->setNodeId(NULL);
		} else {
			$this->setNodeId($v->getId());
		}


		$this->aDmsNode = $v;
	}


	/**
	 * Get the associated DmsNode object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     DmsNode The associated DmsNode object.
	 * @throws     PropelException
	 */
	public function getDmsNode($con = null)
	{
		if ($this->aDmsNode === null && ($this->node_id !== null)) {
			// include the related Peer class
			include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePeer.php';

			$this->aDmsNode = DmsNodePeer::retrieveByPK($this->node_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DmsNodePeer::retrieveByPK($this->node_id, $con);
			   $obj->addDmsNodes($this);
			 */
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


} // BaseDmsNodeProperty
