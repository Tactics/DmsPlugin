<?php

/**
 * Base class that represents a row from the 'dms_property_type' table.
 *
 * 
 *
 * @package    plugins.ttDmsPlugin.lib.model.om
 */
abstract class BaseDmsPropertyType extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DmsPropertyTypePeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;


	/**
	 * The value for the system_name field.
	 * @var        string
	 */
	protected $system_name;


	/**
	 * The value for the data_type field.
	 * @var        string
	 */
	protected $data_type;


	/**
	 * The value for the options field.
	 * @var        string
	 */
	protected $options;


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
	 * Collection to store aggregation of collDmsNodePropertys.
	 * @var        array
	 */
	protected $collDmsNodePropertys;

	/**
	 * The criteria used to select the current contents of collDmsNodePropertys.
	 * @var        Criteria
	 */
	protected $lastDmsNodePropertyCriteria = null;

	/**
	 * Collection to store aggregation of collDmsAspectPropertyTypes.
	 * @var        array
	 */
	protected $collDmsAspectPropertyTypes;

	/**
	 * The criteria used to select the current contents of collDmsAspectPropertyTypes.
	 * @var        Criteria
	 */
	protected $lastDmsAspectPropertyTypeCriteria = null;

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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{

		return $this->name;
	}

	/**
	 * Get the [system_name] column value.
	 * 
	 * @return     string
	 */
	public function getSystemName()
	{

		return $this->system_name;
	}

	/**
	 * Get the [data_type] column value.
	 * 
	 * @return     string
	 */
	public function getDataType()
	{

		return $this->data_type;
	}

	/**
	 * Get the [options] column value.
	 * 
	 * @return     string
	 */
	public function getOptions()
	{

		return $this->options;
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
			$this->modifiedColumns[] = DmsPropertyTypePeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = DmsPropertyTypePeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [system_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSystemName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v;
		}

		if ($this->system_name !== $v) {
			$this->system_name = $v;
			$this->modifiedColumns[] = DmsPropertyTypePeer::SYSTEM_NAME;
		}

	} // setSystemName()

	/**
	 * Set the value of [data_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDataType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v;
		}

		if ($this->data_type !== $v) {
			$this->data_type = $v;
			$this->modifiedColumns[] = DmsPropertyTypePeer::DATA_TYPE;
		}

	} // setDataType()

	/**
	 * Set the value of [options] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setOptions($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v;
		}

		if ($this->options !== $v) {
			$this->options = $v;
			$this->modifiedColumns[] = DmsPropertyTypePeer::OPTIONS;
		}

	} // setOptions()

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
			$this->modifiedColumns[] = DmsPropertyTypePeer::CREATED_BY;
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
			$this->modifiedColumns[] = DmsPropertyTypePeer::UPDATED_BY;
		}

	} // setUpdatedBy()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
     * @throws     PropelException
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
			$this->modifiedColumns[] = DmsPropertyTypePeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
     * @throws     PropelException
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
			$this->modifiedColumns[] = DmsPropertyTypePeer::UPDATED_AT;
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

			$this->name = $rs->getString($startcol + 1);

			$this->system_name = $rs->getString($startcol + 2);

			$this->data_type = $rs->getString($startcol + 3);

			$this->options = $rs->getString($startcol + 4);

			$this->created_by = $rs->getInt($startcol + 5);

			$this->updated_by = $rs->getInt($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

			return $startcol + DmsPropertyTypePeer::NUM_COLUMNS - DmsPropertyTypePeer::NUM_LAZY_LOAD_COLUMNS;

		} catch (Exception $e) {
			throw new PropelException("Error populating DmsPropertyType object", $e);
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

    foreach (sfMixer::getCallables('BaseDmsPropertyType:delete:pre') as $callable)
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
			$con = Propel::getConnection(DmsPropertyTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DmsPropertyTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDmsPropertyType:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseDmsPropertyType:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DmsPropertyTypePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DmsPropertyTypePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DmsPropertyTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDmsPropertyType:save:post') as $callable)
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsPropertyTypePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += DmsPropertyTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collDmsNodePropertys !== null) {
				foreach($this->collDmsNodePropertys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDmsAspectPropertyTypes !== null) {
				foreach($this->collDmsAspectPropertyTypes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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


			if (($retval = DmsPropertyTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDmsNodePropertys !== null) {
					foreach($this->collDmsNodePropertys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDmsAspectPropertyTypes !== null) {
					foreach($this->collDmsAspectPropertyTypes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = DmsPropertyTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getSystemName();
				break;
			case 3:
				return $this->getDataType();
				break;
			case 4:
				return $this->getOptions();
				break;
			case 5:
				return $this->getCreatedBy();
				break;
			case 6:
				return $this->getUpdatedBy();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
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
	 * @return     mixed[string] an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DmsPropertyTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getSystemName(),
			$keys[3] => $this->getDataType(),
			$keys[4] => $this->getOptions(),
			$keys[5] => $this->getCreatedBy(),
			$keys[6] => $this->getUpdatedBy(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
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
		$pos = DmsPropertyTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$this->setByPosition($pos, $value);
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
				$this->setName($value);
				break;
			case 2:
				$this->setSystemName($value);
				break;
			case 3:
				$this->setDataType($value);
				break;
			case 4:
				$this->setOptions($value);
				break;
			case 5:
				$this->setCreatedBy($value);
				break;
			case 6:
				$this->setUpdatedBy($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
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
		$keys = DmsPropertyTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSystemName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDataType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOptions($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedBy($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedBy($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(DmsPropertyTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(DmsPropertyTypePeer::ID)) $criteria->add(DmsPropertyTypePeer::ID, $this->id);
		if ($this->isColumnModified(DmsPropertyTypePeer::NAME)) $criteria->add(DmsPropertyTypePeer::NAME, $this->name);
		if ($this->isColumnModified(DmsPropertyTypePeer::SYSTEM_NAME)) $criteria->add(DmsPropertyTypePeer::SYSTEM_NAME, $this->system_name);
		if ($this->isColumnModified(DmsPropertyTypePeer::DATA_TYPE)) $criteria->add(DmsPropertyTypePeer::DATA_TYPE, $this->data_type);
		if ($this->isColumnModified(DmsPropertyTypePeer::OPTIONS)) $criteria->add(DmsPropertyTypePeer::OPTIONS, $this->options);
		if ($this->isColumnModified(DmsPropertyTypePeer::CREATED_BY)) $criteria->add(DmsPropertyTypePeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(DmsPropertyTypePeer::UPDATED_BY)) $criteria->add(DmsPropertyTypePeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(DmsPropertyTypePeer::CREATED_AT)) $criteria->add(DmsPropertyTypePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DmsPropertyTypePeer::UPDATED_AT)) $criteria->add(DmsPropertyTypePeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(DmsPropertyTypePeer::DATABASE_NAME);

		$criteria->add(DmsPropertyTypePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of DmsPropertyType (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setSystemName($this->system_name);

		$copyObj->setDataType($this->data_type);

		$copyObj->setOptions($this->options);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getDmsNodePropertys() as $relObj) {
				$copyObj->addDmsNodeProperty($relObj->copy($deepCopy));
			}

			foreach($this->getDmsAspectPropertyTypes() as $relObj) {
				$copyObj->addDmsAspectPropertyType($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

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
	 * @return     DmsPropertyType Clone of current object.
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
	 * @return     DmsPropertyTypePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DmsPropertyTypePeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collDmsNodePropertys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDmsNodePropertys()
	{
		if ($this->collDmsNodePropertys === null) {
			$this->collDmsNodePropertys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsPropertyType has previously
	 * been saved, it will retrieve related DmsNodePropertys from storage.
	 * If this DmsPropertyType is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     DmsNodeProperty[] DmsNodePropertys
	 */
	public function getDmsNodePropertys($criteria = null, $con = null)
	{
		// include the Peer class
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

				$criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->getId());

				DmsNodePropertyPeer::addSelectColumns($criteria);
				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->getId());

				DmsNodePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastDmsNodePropertyCriteria) || !$this->lastDmsNodePropertyCriteria->equals($criteria)) {
					$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDmsNodePropertyCriteria = $criteria;
		return $this->collDmsNodePropertys;
	}

	/**
	 * Returns the number of related DmsNodePropertys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of DmsNodePropertys
	 * @throws     PropelException
	 */
	public function countDmsNodePropertys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->getId());

		return DmsNodePropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a DmsNodeProperty object to this object
	 * through the DmsNodeProperty foreign key attribute
	 *
	 * @param      DmsNodeProperty $l DmsNodeProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDmsNodeProperty(DmsNodeProperty $l)
	{
		$this->collDmsNodePropertys[] = $l;
		$l->setDmsPropertyType($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsPropertyType is new, it will return
	 * an empty collection; or if this DmsPropertyType has previously
	 * been saved, it will retrieve related DmsNodePropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsPropertyType.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return DmsNodeProperty[] DmsNodePropertys joined with DmsNode
	 */
	public function getDmsNodePropertysJoinDmsNode(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
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

				$criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->getId());

				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelectJoinDmsNode($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DmsNodePropertyPeer::TYPE_ID, $this->getId());

			if (!isset($this->lastDmsNodePropertyCriteria) || !$this->lastDmsNodePropertyCriteria->equals($criteria)) {
				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelectJoinDmsNode($criteria, $con);
			}
		}
		$this->lastDmsNodePropertyCriteria = $criteria;

		return $this->collDmsNodePropertys;
	}

	/**
	 * Temporary storage of collDmsAspectPropertyTypes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDmsAspectPropertyTypes()
	{
		if ($this->collDmsAspectPropertyTypes === null) {
			$this->collDmsAspectPropertyTypes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsPropertyType has previously
	 * been saved, it will retrieve related DmsAspectPropertyTypes from storage.
	 * If this DmsPropertyType is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     DmsAspectPropertyType[] DmsAspectPropertyTypes
	 */
	public function getDmsAspectPropertyTypes($criteria = null, $con = null)
	{
		// include the Peer class
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

				$criteria->add(DmsAspectPropertyTypePeer::TYPE_ID, $this->getId());

				DmsAspectPropertyTypePeer::addSelectColumns($criteria);
				$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DmsAspectPropertyTypePeer::TYPE_ID, $this->getId());

				DmsAspectPropertyTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastDmsAspectPropertyTypeCriteria) || !$this->lastDmsAspectPropertyTypeCriteria->equals($criteria)) {
					$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDmsAspectPropertyTypeCriteria = $criteria;
		return $this->collDmsAspectPropertyTypes;
	}

	/**
	 * Returns the number of related DmsAspectPropertyTypes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of DmsAspectPropertyTypes
	 * @throws     PropelException
	 */
	public function countDmsAspectPropertyTypes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsAspectPropertyTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DmsAspectPropertyTypePeer::TYPE_ID, $this->getId());

		return DmsAspectPropertyTypePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a DmsAspectPropertyType object to this object
	 * through the DmsAspectPropertyType foreign key attribute
	 *
	 * @param      DmsAspectPropertyType $l DmsAspectPropertyType
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDmsAspectPropertyType(DmsAspectPropertyType $l)
	{
		$this->collDmsAspectPropertyTypes[] = $l;
		$l->setDmsPropertyType($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsPropertyType is new, it will return
	 * an empty collection; or if this DmsPropertyType has previously
	 * been saved, it will retrieve related DmsAspectPropertyTypes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsPropertyType.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return DmsAspectPropertyType[] DmsAspectPropertyTypes joined with DmsAspect
	 */
	public function getDmsAspectPropertyTypesJoinDmsAspect(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
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

				$criteria->add(DmsAspectPropertyTypePeer::TYPE_ID, $this->getId());

				$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelectJoinDmsAspect($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DmsAspectPropertyTypePeer::TYPE_ID, $this->getId());

			if (!isset($this->lastDmsAspectPropertyTypeCriteria) || !$this->lastDmsAspectPropertyTypeCriteria->equals($criteria)) {
				$this->collDmsAspectPropertyTypes = DmsAspectPropertyTypePeer::doSelectJoinDmsAspect($criteria, $con);
			}
		}
		$this->lastDmsAspectPropertyTypeCriteria = $criteria;

		return $this->collDmsAspectPropertyTypes;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDmsPropertyType:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDmsPropertyType::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseDmsPropertyType
