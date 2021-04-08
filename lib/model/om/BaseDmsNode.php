<?php

/**
 * Base class that represents a row from the 'dms_node' table.
 *
 * 
 *
 * @package    plugins.ttDmsPlugin.lib.model.om
 */
abstract class BaseDmsNode extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DmsNodePeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the store_id field.
	 * @var        int
	 */
	protected $store_id;


	/**
	 * The value for the parent_id field.
	 * @var        int
	 */
	protected $parent_id;


	/**
	 * The value for the is_folder field.
	 * @var        boolean
	 */
	protected $is_folder;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;


	/**
	 * The value for the disk_name field.
	 * @var        string
	 */
	protected $disk_name;


	/**
	 * The value for the content_updated_at field.
	 * @var        int
	 */
	protected $content_updated_at;


	/**
	 * The value for the gearchiveerd field.
	 * @var        boolean
	 */
	protected $gearchiveerd = false;


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
	 * @var        DmsStore
	 */
	protected $aDmsStore;

	/**
	 * @var        DmsNode
	 */
	protected $aDmsNodeRelatedByParentId;

	/**
	 * Collection to store aggregation of collSubsidieBijlages.
	 * @var        array
	 */
	protected $collSubsidieBijlages;

	/**
	 * The criteria used to select the current contents of collSubsidieBijlages.
	 * @var        Criteria
	 */
	protected $lastSubsidieBijlageCriteria = null;

	/**
	 * Collection to store aggregation of collAccountAanvraags.
	 * @var        array
	 */
	protected $collAccountAanvraags;

	/**
	 * The criteria used to select the current contents of collAccountAanvraags.
	 * @var        Criteria
	 */
	protected $lastAccountAanvraagCriteria = null;

	/**
	 * Collection to store aggregation of collMateriaalCategories.
	 * @var        array
	 */
	protected $collMateriaalCategories;

	/**
	 * The criteria used to select the current contents of collMateriaalCategories.
	 * @var        Criteria
	 */
	protected $lastMateriaalCategorieCriteria = null;

	/**
	 * Collection to store aggregation of collRoutess.
	 * @var        array
	 */
	protected $collRoutess;

	/**
	 * The criteria used to select the current contents of collRoutess.
	 * @var        Criteria
	 */
	protected $lastRoutesCriteria = null;

	/**
	 * Collection to store aggregation of collTegoedbons.
	 * @var        array
	 */
	protected $collTegoedbons;

	/**
	 * The criteria used to select the current contents of collTegoedbons.
	 * @var        Criteria
	 */
	protected $lastTegoedbonCriteria = null;

	/**
	 * Collection to store aggregation of collSportsubsidieBestelbonUitbetalings.
	 * @var        array
	 */
	protected $collSportsubsidieBestelbonUitbetalings;

	/**
	 * The criteria used to select the current contents of collSportsubsidieBestelbonUitbetalings.
	 * @var        Criteria
	 */
	protected $lastSportsubsidieBestelbonUitbetalingCriteria = null;

	/**
	 * Collection to store aggregation of collDmsNodesRelatedByParentId.
	 * @var        array
	 */
	protected $collDmsNodesRelatedByParentId;

	/**
	 * The criteria used to select the current contents of collDmsNodesRelatedByParentId.
	 * @var        Criteria
	 */
	protected $lastDmsNodeRelatedByParentIdCriteria = null;

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
	 * Collection to store aggregation of collDmsNodeAspects.
	 * @var        array
	 */
	protected $collDmsNodeAspects;

	/**
	 * The criteria used to select the current contents of collDmsNodeAspects.
	 * @var        Criteria
	 */
	protected $lastDmsNodeAspectCriteria = null;

	/**
	 * Collection to store aggregation of collDmsObjectNodeRefs.
	 * @var        array
	 */
	protected $collDmsObjectNodeRefs;

	/**
	 * The criteria used to select the current contents of collDmsObjectNodeRefs.
	 * @var        Criteria
	 */
	protected $lastDmsObjectNodeRefCriteria = null;

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
	 * Get the [store_id] column value.
	 * 
	 * @return     int
	 */
	public function getStoreId()
	{

		return $this->store_id;
	}

	/**
	 * Get the [parent_id] column value.
	 * 
	 * @return     int
	 */
	public function getParentId()
	{

		return $this->parent_id;
	}

	/**
	 * Get the [is_folder] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsFolder()
	{

		return $this->is_folder;
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
	 * Get the [disk_name] column value.
	 * 
	 * @return     string
	 */
	public function getDiskName()
	{

		return $this->disk_name;
	}

	/**
	 * Get the [optionally formatted] [content_updated_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getContentUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->content_updated_at === null || $this->content_updated_at === '') {
			return null;
		} elseif (!is_int($this->content_updated_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->content_updated_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [content_updated_at] as date/time value: " . var_export($this->content_updated_at, true));
			}
		} else {
			$ts = $this->content_updated_at;
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
	 * Get the [gearchiveerd] column value.
	 * 
	 * @return     boolean
	 */
	public function getGearchiveerd()
	{

		return $this->gearchiveerd;
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
			$this->modifiedColumns[] = DmsNodePeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [store_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStoreId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
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

	} // setStoreId()

	/**
	 * Set the value of [parent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setParentId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
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

	} // setParentId()

	/**
	 * Set the value of [is_folder] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsFolder($v)
	{

		if ($this->is_folder !== $v) {
			$this->is_folder = $v;
			$this->modifiedColumns[] = DmsNodePeer::IS_FOLDER;
		}

	} // setIsFolder()

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
			$this->modifiedColumns[] = DmsNodePeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [disk_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDiskName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v;
		}

		if ($this->disk_name !== $v) {
			$this->disk_name = $v;
			$this->modifiedColumns[] = DmsNodePeer::DISK_NAME;
		}

	} // setDiskName()

	/**
	 * Set the value of [content_updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
     * @throws     PropelException
	 */
	public function setContentUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [content_updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->content_updated_at !== $ts) {
			$this->content_updated_at = $ts;
			$this->modifiedColumns[] = DmsNodePeer::CONTENT_UPDATED_AT;
		}

	} // setContentUpdatedAt()

	/**
	 * Set the value of [gearchiveerd] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setGearchiveerd($v)
	{

		if ($this->gearchiveerd !== $v || $v === false) {
			$this->gearchiveerd = $v;
			$this->modifiedColumns[] = DmsNodePeer::GEARCHIVEERD;
		}

	} // setGearchiveerd()

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
			$this->modifiedColumns[] = DmsNodePeer::CREATED_BY;
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
			$this->modifiedColumns[] = DmsNodePeer::UPDATED_BY;
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
			$this->modifiedColumns[] = DmsNodePeer::CREATED_AT;
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
			$this->modifiedColumns[] = DmsNodePeer::UPDATED_AT;
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

			$this->store_id = $rs->getInt($startcol + 1);

			$this->parent_id = $rs->getInt($startcol + 2);

			$this->is_folder = $rs->getBoolean($startcol + 3);

			$this->name = $rs->getString($startcol + 4);

			$this->disk_name = $rs->getString($startcol + 5);

			$this->content_updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->gearchiveerd = $rs->getBoolean($startcol + 7);

			$this->created_by = $rs->getInt($startcol + 8);

			$this->updated_by = $rs->getInt($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

			return $startcol + DmsNodePeer::NUM_COLUMNS - DmsNodePeer::NUM_LAZY_LOAD_COLUMNS;

		} catch (Exception $e) {
			throw new PropelException("Error populating DmsNode object", $e);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DmsNodePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += DmsNodePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSubsidieBijlages !== null) {
				foreach($this->collSubsidieBijlages as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAccountAanvraags !== null) {
				foreach($this->collAccountAanvraags as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMateriaalCategories !== null) {
				foreach($this->collMateriaalCategories as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRoutess !== null) {
				foreach($this->collRoutess as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTegoedbons !== null) {
				foreach($this->collTegoedbons as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSportsubsidieBestelbonUitbetalings !== null) {
				foreach($this->collSportsubsidieBestelbonUitbetalings as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


				if ($this->collSubsidieBijlages !== null) {
					foreach($this->collSubsidieBijlages as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAccountAanvraags !== null) {
					foreach($this->collAccountAanvraags as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMateriaalCategories !== null) {
					foreach($this->collMateriaalCategories as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRoutess !== null) {
					foreach($this->collRoutess as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTegoedbons !== null) {
					foreach($this->collTegoedbons as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSportsubsidieBestelbonUitbetalings !== null) {
					foreach($this->collSportsubsidieBestelbonUitbetalings as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = DmsNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getContentUpdatedAt();
				break;
			case 7:
				return $this->getGearchiveerd();
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
	 * @return     mixed[string] an associative array containing the field names (as keys) and field values
	 */
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
			$keys[6] => $this->getContentUpdatedAt(),
			$keys[7] => $this->getGearchiveerd(),
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
		$pos = DmsNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setContentUpdatedAt($value);
				break;
			case 7:
				$this->setGearchiveerd($value);
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
		$keys = DmsNodePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStoreId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setParentId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsFolder($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDiskName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setContentUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setGearchiveerd($arr[$keys[7]]);
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
		$criteria = new Criteria(DmsNodePeer::DATABASE_NAME);

		if ($this->isColumnModified(DmsNodePeer::ID)) $criteria->add(DmsNodePeer::ID, $this->id);
		if ($this->isColumnModified(DmsNodePeer::STORE_ID)) $criteria->add(DmsNodePeer::STORE_ID, $this->store_id);
		if ($this->isColumnModified(DmsNodePeer::PARENT_ID)) $criteria->add(DmsNodePeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(DmsNodePeer::IS_FOLDER)) $criteria->add(DmsNodePeer::IS_FOLDER, $this->is_folder);
		if ($this->isColumnModified(DmsNodePeer::NAME)) $criteria->add(DmsNodePeer::NAME, $this->name);
		if ($this->isColumnModified(DmsNodePeer::DISK_NAME)) $criteria->add(DmsNodePeer::DISK_NAME, $this->disk_name);
		if ($this->isColumnModified(DmsNodePeer::CONTENT_UPDATED_AT)) $criteria->add(DmsNodePeer::CONTENT_UPDATED_AT, $this->content_updated_at);
		if ($this->isColumnModified(DmsNodePeer::GEARCHIVEERD)) $criteria->add(DmsNodePeer::GEARCHIVEERD, $this->gearchiveerd);
		if ($this->isColumnModified(DmsNodePeer::CREATED_BY)) $criteria->add(DmsNodePeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(DmsNodePeer::UPDATED_BY)) $criteria->add(DmsNodePeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(DmsNodePeer::CREATED_AT)) $criteria->add(DmsNodePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DmsNodePeer::UPDATED_AT)) $criteria->add(DmsNodePeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(DmsNodePeer::DATABASE_NAME);

		$criteria->add(DmsNodePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of DmsNode (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStoreId($this->store_id);

		$copyObj->setParentId($this->parent_id);

		$copyObj->setIsFolder($this->is_folder);

		$copyObj->setName($this->name);

		$copyObj->setDiskName($this->disk_name);

		$copyObj->setContentUpdatedAt($this->content_updated_at);

		$copyObj->setGearchiveerd($this->gearchiveerd);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getSubsidieBijlages() as $relObj) {
				$copyObj->addSubsidieBijlage($relObj->copy($deepCopy));
			}

			foreach($this->getAccountAanvraags() as $relObj) {
				$copyObj->addAccountAanvraag($relObj->copy($deepCopy));
			}

			foreach($this->getMateriaalCategories() as $relObj) {
				$copyObj->addMateriaalCategorie($relObj->copy($deepCopy));
			}

			foreach($this->getRoutess() as $relObj) {
				$copyObj->addRoutes($relObj->copy($deepCopy));
			}

			foreach($this->getTegoedbons() as $relObj) {
				$copyObj->addTegoedbon($relObj->copy($deepCopy));
			}

			foreach($this->getSportsubsidieBestelbonUitbetalings() as $relObj) {
				$copyObj->addSportsubsidieBestelbonUitbetaling($relObj->copy($deepCopy));
			}

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
	 * @return     DmsNode Clone of current object.
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
	 * @return     DmsNodePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DmsNodePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a DmsStore object.
	 *
	 * @param      BaseDmsStore $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setDmsStore($v)
	{


		if ($v === null) {
			$this->setStoreId(NULL);
		} else {
			$this->setStoreId($v->getId());
		}


		$this->aDmsStore = $v;
	}


	/**
	 * Get the associated DmsStore object
	 *
	 * @param      Connection $con Optional Connection object.
	 * @return     DmsStore The associated DmsStore object.
	 * @throws     PropelException
	 */
	public function getDmsStore($con = null)
	{
		if ($this->aDmsStore === null && ($this->store_id !== null)) {
			// include the related Peer class
			include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsStorePeer.php';

			$this->aDmsStore = DmsStorePeer::retrieveByPK($this->store_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DmsStorePeer::retrieveByPK($this->store_id, $con);
			   $obj->addDmsStores($this);
			 */
		}
		return $this->aDmsStore;
	}

	/**
	 * Declares an association between this object and a DmsNode object.
	 *
	 * @param      BaseDmsNode $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setDmsNodeRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->aDmsNodeRelatedByParentId = $v;
	}


	/**
	 * Get the associated DmsNode object
	 *
	 * @param      Connection $con Optional Connection object.
	 * @return     DmsNode The associated DmsNode object.
	 * @throws     PropelException
	 */
	public function getDmsNodeRelatedByParentId($con = null)
	{
		if ($this->aDmsNodeRelatedByParentId === null && ($this->parent_id !== null)) {
			// include the related Peer class
			include_once 'plugins/ttDmsPlugin/lib/model/om/BaseDmsNodePeer.php';

			$this->aDmsNodeRelatedByParentId = DmsNodePeer::retrieveByPK($this->parent_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DmsNodePeer::retrieveByPK($this->parent_id, $con);
			   $obj->addDmsNodesRelatedByParentId($this);
			 */
		}
		return $this->aDmsNodeRelatedByParentId;
	}

	/**
	 * Temporary storage of collSubsidieBijlages to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSubsidieBijlages()
	{
		if ($this->collSubsidieBijlages === null) {
			$this->collSubsidieBijlages = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related SubsidieBijlages from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     SubsidieBijlage[] SubsidieBijlages
	 */
	public function getSubsidieBijlages($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSubsidieBijlagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubsidieBijlages === null) {
			if ($this->isNew()) {
			   $this->collSubsidieBijlages = array();
			} else {

				$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

				SubsidieBijlagePeer::addSelectColumns($criteria);
				$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

				SubsidieBijlagePeer::addSelectColumns($criteria);
				if (!isset($this->lastSubsidieBijlageCriteria) || !$this->lastSubsidieBijlageCriteria->equals($criteria)) {
					$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSubsidieBijlageCriteria = $criteria;
		return $this->collSubsidieBijlages;
	}

	/**
	 * Returns the number of related SubsidieBijlages.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of SubsidieBijlages
	 * @throws     PropelException
	 */
	public function countSubsidieBijlages($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSubsidieBijlagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

		return SubsidieBijlagePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SubsidieBijlage object to this object
	 * through the SubsidieBijlage foreign key attribute
	 *
	 * @param      SubsidieBijlage $l SubsidieBijlage
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSubsidieBijlage(SubsidieBijlage $l)
	{
		$this->collSubsidieBijlages[] = $l;
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related SubsidieBijlages from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return SubsidieBijlage[] SubsidieBijlages joined with SubsidieAanvraag
	 */
	public function getSubsidieBijlagesJoinSubsidieAanvraag(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSubsidieBijlagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubsidieBijlages === null) {
			if ($this->isNew()) {
				$this->collSubsidieBijlages = array();
			} else {

				$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

				$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelectJoinSubsidieAanvraag($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

			if (!isset($this->lastSubsidieBijlageCriteria) || !$this->lastSubsidieBijlageCriteria->equals($criteria)) {
				$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelectJoinSubsidieAanvraag($criteria, $con);
			}
		}
		$this->lastSubsidieBijlageCriteria = $criteria;

		return $this->collSubsidieBijlages;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related SubsidieBijlages from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return SubsidieBijlage[] SubsidieBijlages joined with OrganisatieTrainer
	 */
	public function getSubsidieBijlagesJoinOrganisatieTrainer(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSubsidieBijlagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubsidieBijlages === null) {
			if ($this->isNew()) {
				$this->collSubsidieBijlages = array();
			} else {

				$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

				$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelectJoinOrganisatieTrainer($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

			if (!isset($this->lastSubsidieBijlageCriteria) || !$this->lastSubsidieBijlageCriteria->equals($criteria)) {
				$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelectJoinOrganisatieTrainer($criteria, $con);
			}
		}
		$this->lastSubsidieBijlageCriteria = $criteria;

		return $this->collSubsidieBijlages;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related SubsidieBijlages from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return SubsidieBijlage[] SubsidieBijlages joined with SubsidieAanvraagPatrimonium
	 */
	public function getSubsidieBijlagesJoinSubsidieAanvraagPatrimonium(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSubsidieBijlagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubsidieBijlages === null) {
			if ($this->isNew()) {
				$this->collSubsidieBijlages = array();
			} else {

				$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

				$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelectJoinSubsidieAanvraagPatrimonium($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SubsidieBijlagePeer::NODE_ID, $this->getId());

			if (!isset($this->lastSubsidieBijlageCriteria) || !$this->lastSubsidieBijlageCriteria->equals($criteria)) {
				$this->collSubsidieBijlages = SubsidieBijlagePeer::doSelectJoinSubsidieAanvraagPatrimonium($criteria, $con);
			}
		}
		$this->lastSubsidieBijlageCriteria = $criteria;

		return $this->collSubsidieBijlages;
	}

	/**
	 * Temporary storage of collAccountAanvraags to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAccountAanvraags()
	{
		if ($this->collAccountAanvraags === null) {
			$this->collAccountAanvraags = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     AccountAanvraag[] AccountAanvraags
	 */
	public function getAccountAanvraags($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
			   $this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				AccountAanvraagPeer::addSelectColumns($criteria);
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				AccountAanvraagPeer::addSelectColumns($criteria);
				if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
					$this->collAccountAanvraags = AccountAanvraagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;
		return $this->collAccountAanvraags;
	}

	/**
	 * Returns the number of related AccountAanvraags.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of AccountAanvraags
	 * @throws     PropelException
	 */
	public function countAccountAanvraags($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

		return AccountAanvraagPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AccountAanvraag object to this object
	 * through the AccountAanvraag foreign key attribute
	 *
	 * @param      AccountAanvraag $l AccountAanvraag
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAccountAanvraag(AccountAanvraag $l)
	{
		$this->collAccountAanvraags[] = $l;
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with BedrijfRelatedByBedrijfId
	 */
	public function getAccountAanvraagsJoinBedrijfRelatedByBedrijfId(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinBedrijfRelatedByBedrijfId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinBedrijfRelatedByBedrijfId($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with LandRelatedByOrganisatieLandId
	 */
	public function getAccountAanvraagsJoinLandRelatedByOrganisatieLandId(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinLandRelatedByOrganisatieLandId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinLandRelatedByOrganisatieLandId($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with OrganisatieContactFunctie
	 */
	public function getAccountAanvraagsJoinOrganisatieContactFunctie(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinOrganisatieContactFunctie($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinOrganisatieContactFunctie($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with LandRelatedByNationaliteit
	 */
	public function getAccountAanvraagsJoinLandRelatedByNationaliteit(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinLandRelatedByNationaliteit($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinLandRelatedByNationaliteit($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with LandRelatedByLandId
	 */
	public function getAccountAanvraagsJoinLandRelatedByLandId(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinLandRelatedByLandId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinLandRelatedByLandId($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with Organisatie
	 */
	public function getAccountAanvraagsJoinOrganisatie(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinOrganisatie($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinOrganisatie($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with Persoon
	 */
	public function getAccountAanvraagsJoinPersoon(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinPersoon($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinPersoon($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with BedrijfRelatedByVerwerktDoorBedrijfId
	 */
	public function getAccountAanvraagsJoinBedrijfRelatedByVerwerktDoorBedrijfId(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinBedrijfRelatedByVerwerktDoorBedrijfId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinBedrijfRelatedByVerwerktDoorBedrijfId($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with BedrijfRelatedByBronBedrijfId
	 */
	public function getAccountAanvraagsJoinBedrijfRelatedByBronBedrijfId(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinBedrijfRelatedByBronBedrijfId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinBedrijfRelatedByBronBedrijfId($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with AccountRelatedByCreatedBy
	 */
	public function getAccountAanvraagsJoinAccountRelatedByCreatedBy(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinAccountRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinAccountRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related AccountAanvraags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return AccountAanvraag[] AccountAanvraags joined with AccountRelatedByUpdatedBy
	 */
	public function getAccountAanvraagsJoinAccountRelatedByUpdatedBy(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAccountAanvraagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccountAanvraags === null) {
			if ($this->isNew()) {
				$this->collAccountAanvraags = array();
			} else {

				$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinAccountRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountAanvraagPeer::BEWIJSSTUK_NODE_ID, $this->getId());

			if (!isset($this->lastAccountAanvraagCriteria) || !$this->lastAccountAanvraagCriteria->equals($criteria)) {
				$this->collAccountAanvraags = AccountAanvraagPeer::doSelectJoinAccountRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastAccountAanvraagCriteria = $criteria;

		return $this->collAccountAanvraags;
	}

	/**
	 * Temporary storage of collMateriaalCategories to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMateriaalCategories()
	{
		if ($this->collMateriaalCategories === null) {
			$this->collMateriaalCategories = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related MateriaalCategories from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     MateriaalCategorie[] MateriaalCategories
	 */
	public function getMateriaalCategories($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMateriaalCategoriePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMateriaalCategories === null) {
			if ($this->isNew()) {
			   $this->collMateriaalCategories = array();
			} else {

				$criteria->add(MateriaalCategoriePeer::AFBEELDING_NODE_ID, $this->getId());

				MateriaalCategoriePeer::addSelectColumns($criteria);
				$this->collMateriaalCategories = MateriaalCategoriePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MateriaalCategoriePeer::AFBEELDING_NODE_ID, $this->getId());

				MateriaalCategoriePeer::addSelectColumns($criteria);
				if (!isset($this->lastMateriaalCategorieCriteria) || !$this->lastMateriaalCategorieCriteria->equals($criteria)) {
					$this->collMateriaalCategories = MateriaalCategoriePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMateriaalCategorieCriteria = $criteria;
		return $this->collMateriaalCategories;
	}

	/**
	 * Returns the number of related MateriaalCategories.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of MateriaalCategories
	 * @throws     PropelException
	 */
	public function countMateriaalCategories($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMateriaalCategoriePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MateriaalCategoriePeer::AFBEELDING_NODE_ID, $this->getId());

		return MateriaalCategoriePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MateriaalCategorie object to this object
	 * through the MateriaalCategorie foreign key attribute
	 *
	 * @param      MateriaalCategorie $l MateriaalCategorie
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMateriaalCategorie(MateriaalCategorie $l)
	{
		$this->collMateriaalCategories[] = $l;
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related MateriaalCategories from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return MateriaalCategorie[] MateriaalCategories joined with MateriaalCategorieRelatedByParentId
	 */
	public function getMateriaalCategoriesJoinMateriaalCategorieRelatedByParentId(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMateriaalCategoriePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMateriaalCategories === null) {
			if ($this->isNew()) {
				$this->collMateriaalCategories = array();
			} else {

				$criteria->add(MateriaalCategoriePeer::AFBEELDING_NODE_ID, $this->getId());

				$this->collMateriaalCategories = MateriaalCategoriePeer::doSelectJoinMateriaalCategorieRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MateriaalCategoriePeer::AFBEELDING_NODE_ID, $this->getId());

			if (!isset($this->lastMateriaalCategorieCriteria) || !$this->lastMateriaalCategorieCriteria->equals($criteria)) {
				$this->collMateriaalCategories = MateriaalCategoriePeer::doSelectJoinMateriaalCategorieRelatedByParentId($criteria, $con);
			}
		}
		$this->lastMateriaalCategorieCriteria = $criteria;

		return $this->collMateriaalCategories;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related MateriaalCategories from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return MateriaalCategorie[] MateriaalCategories joined with Bedrijf
	 */
	public function getMateriaalCategoriesJoinBedrijf(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMateriaalCategoriePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMateriaalCategories === null) {
			if ($this->isNew()) {
				$this->collMateriaalCategories = array();
			} else {

				$criteria->add(MateriaalCategoriePeer::AFBEELDING_NODE_ID, $this->getId());

				$this->collMateriaalCategories = MateriaalCategoriePeer::doSelectJoinBedrijf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MateriaalCategoriePeer::AFBEELDING_NODE_ID, $this->getId());

			if (!isset($this->lastMateriaalCategorieCriteria) || !$this->lastMateriaalCategorieCriteria->equals($criteria)) {
				$this->collMateriaalCategories = MateriaalCategoriePeer::doSelectJoinBedrijf($criteria, $con);
			}
		}
		$this->lastMateriaalCategorieCriteria = $criteria;

		return $this->collMateriaalCategories;
	}

	/**
	 * Temporary storage of collRoutess to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRoutess()
	{
		if ($this->collRoutess === null) {
			$this->collRoutess = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related Routess from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     Routes[] Routess
	 */
	public function getRoutess($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoutesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoutess === null) {
			if ($this->isNew()) {
			   $this->collRoutess = array();
			} else {

				$criteria->add(RoutesPeer::DMS_NODE_ID, $this->getId());

				RoutesPeer::addSelectColumns($criteria);
				$this->collRoutess = RoutesPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RoutesPeer::DMS_NODE_ID, $this->getId());

				RoutesPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoutesCriteria) || !$this->lastRoutesCriteria->equals($criteria)) {
					$this->collRoutess = RoutesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoutesCriteria = $criteria;
		return $this->collRoutess;
	}

	/**
	 * Returns the number of related Routess.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of Routess
	 * @throws     PropelException
	 */
	public function countRoutess($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoutesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RoutesPeer::DMS_NODE_ID, $this->getId());

		return RoutesPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Routes object to this object
	 * through the Routes foreign key attribute
	 *
	 * @param      Routes $l Routes
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRoutes(Routes $l)
	{
		$this->collRoutess[] = $l;
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related Routess from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return Routes[] Routess joined with Activiteit
	 */
	public function getRoutessJoinActiviteit(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoutesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoutess === null) {
			if ($this->isNew()) {
				$this->collRoutess = array();
			} else {

				$criteria->add(RoutesPeer::DMS_NODE_ID, $this->getId());

				$this->collRoutess = RoutesPeer::doSelectJoinActiviteit($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RoutesPeer::DMS_NODE_ID, $this->getId());

			if (!isset($this->lastRoutesCriteria) || !$this->lastRoutesCriteria->equals($criteria)) {
				$this->collRoutess = RoutesPeer::doSelectJoinActiviteit($criteria, $con);
			}
		}
		$this->lastRoutesCriteria = $criteria;

		return $this->collRoutess;
	}

	/**
	 * Temporary storage of collTegoedbons to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTegoedbons()
	{
		if ($this->collTegoedbons === null) {
			$this->collTegoedbons = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related Tegoedbons from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     Tegoedbon[] Tegoedbons
	 */
	public function getTegoedbons($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTegoedbonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTegoedbons === null) {
			if ($this->isNew()) {
			   $this->collTegoedbons = array();
			} else {

				$criteria->add(TegoedbonPeer::VERANTWOORDINGSDOCUMENT_ID, $this->getId());

				TegoedbonPeer::addSelectColumns($criteria);
				$this->collTegoedbons = TegoedbonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TegoedbonPeer::VERANTWOORDINGSDOCUMENT_ID, $this->getId());

				TegoedbonPeer::addSelectColumns($criteria);
				if (!isset($this->lastTegoedbonCriteria) || !$this->lastTegoedbonCriteria->equals($criteria)) {
					$this->collTegoedbons = TegoedbonPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTegoedbonCriteria = $criteria;
		return $this->collTegoedbons;
	}

	/**
	 * Returns the number of related Tegoedbons.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of Tegoedbons
	 * @throws     PropelException
	 */
	public function countTegoedbons($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTegoedbonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TegoedbonPeer::VERANTWOORDINGSDOCUMENT_ID, $this->getId());

		return TegoedbonPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Tegoedbon object to this object
	 * through the Tegoedbon foreign key attribute
	 *
	 * @param      Tegoedbon $l Tegoedbon
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTegoedbon(Tegoedbon $l)
	{
		$this->collTegoedbons[] = $l;
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related Tegoedbons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return Tegoedbon[] Tegoedbons joined with Persoon
	 */
	public function getTegoedbonsJoinPersoon(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTegoedbonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTegoedbons === null) {
			if ($this->isNew()) {
				$this->collTegoedbons = array();
			} else {

				$criteria->add(TegoedbonPeer::VERANTWOORDINGSDOCUMENT_ID, $this->getId());

				$this->collTegoedbons = TegoedbonPeer::doSelectJoinPersoon($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TegoedbonPeer::VERANTWOORDINGSDOCUMENT_ID, $this->getId());

			if (!isset($this->lastTegoedbonCriteria) || !$this->lastTegoedbonCriteria->equals($criteria)) {
				$this->collTegoedbons = TegoedbonPeer::doSelectJoinPersoon($criteria, $con);
			}
		}
		$this->lastTegoedbonCriteria = $criteria;

		return $this->collTegoedbons;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related Tegoedbons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return Tegoedbon[] Tegoedbons joined with LedenActiviteitInschrijving
	 */
	public function getTegoedbonsJoinLedenActiviteitInschrijving(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTegoedbonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTegoedbons === null) {
			if ($this->isNew()) {
				$this->collTegoedbons = array();
			} else {

				$criteria->add(TegoedbonPeer::VERANTWOORDINGSDOCUMENT_ID, $this->getId());

				$this->collTegoedbons = TegoedbonPeer::doSelectJoinLedenActiviteitInschrijving($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TegoedbonPeer::VERANTWOORDINGSDOCUMENT_ID, $this->getId());

			if (!isset($this->lastTegoedbonCriteria) || !$this->lastTegoedbonCriteria->equals($criteria)) {
				$this->collTegoedbons = TegoedbonPeer::doSelectJoinLedenActiviteitInschrijving($criteria, $con);
			}
		}
		$this->lastTegoedbonCriteria = $criteria;

		return $this->collTegoedbons;
	}

	/**
	 * Temporary storage of collSportsubsidieBestelbonUitbetalings to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSportsubsidieBestelbonUitbetalings()
	{
		if ($this->collSportsubsidieBestelbonUitbetalings === null) {
			$this->collSportsubsidieBestelbonUitbetalings = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related SportsubsidieBestelbonUitbetalings from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     SportsubsidieBestelbonUitbetaling[] SportsubsidieBestelbonUitbetalings
	 */
	public function getSportsubsidieBestelbonUitbetalings($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSportsubsidieBestelbonUitbetalingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSportsubsidieBestelbonUitbetalings === null) {
			if ($this->isNew()) {
			   $this->collSportsubsidieBestelbonUitbetalings = array();
			} else {

				$criteria->add(SportsubsidieBestelbonUitbetalingPeer::BIJLAGE_ID, $this->getId());

				SportsubsidieBestelbonUitbetalingPeer::addSelectColumns($criteria);
				$this->collSportsubsidieBestelbonUitbetalings = SportsubsidieBestelbonUitbetalingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SportsubsidieBestelbonUitbetalingPeer::BIJLAGE_ID, $this->getId());

				SportsubsidieBestelbonUitbetalingPeer::addSelectColumns($criteria);
				if (!isset($this->lastSportsubsidieBestelbonUitbetalingCriteria) || !$this->lastSportsubsidieBestelbonUitbetalingCriteria->equals($criteria)) {
					$this->collSportsubsidieBestelbonUitbetalings = SportsubsidieBestelbonUitbetalingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSportsubsidieBestelbonUitbetalingCriteria = $criteria;
		return $this->collSportsubsidieBestelbonUitbetalings;
	}

	/**
	 * Returns the number of related SportsubsidieBestelbonUitbetalings.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of SportsubsidieBestelbonUitbetalings
	 * @throws     PropelException
	 */
	public function countSportsubsidieBestelbonUitbetalings($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSportsubsidieBestelbonUitbetalingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SportsubsidieBestelbonUitbetalingPeer::BIJLAGE_ID, $this->getId());

		return SportsubsidieBestelbonUitbetalingPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SportsubsidieBestelbonUitbetaling object to this object
	 * through the SportsubsidieBestelbonUitbetaling foreign key attribute
	 *
	 * @param      SportsubsidieBestelbonUitbetaling $l SportsubsidieBestelbonUitbetaling
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSportsubsidieBestelbonUitbetaling(SportsubsidieBestelbonUitbetaling $l)
	{
		$this->collSportsubsidieBestelbonUitbetalings[] = $l;
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related SportsubsidieBestelbonUitbetalings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return SportsubsidieBestelbonUitbetaling[] SportsubsidieBestelbonUitbetalings joined with SportsubsidieBestelbon
	 */
	public function getSportsubsidieBestelbonUitbetalingsJoinSportsubsidieBestelbon(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSportsubsidieBestelbonUitbetalingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSportsubsidieBestelbonUitbetalings === null) {
			if ($this->isNew()) {
				$this->collSportsubsidieBestelbonUitbetalings = array();
			} else {

				$criteria->add(SportsubsidieBestelbonUitbetalingPeer::BIJLAGE_ID, $this->getId());

				$this->collSportsubsidieBestelbonUitbetalings = SportsubsidieBestelbonUitbetalingPeer::doSelectJoinSportsubsidieBestelbon($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SportsubsidieBestelbonUitbetalingPeer::BIJLAGE_ID, $this->getId());

			if (!isset($this->lastSportsubsidieBestelbonUitbetalingCriteria) || !$this->lastSportsubsidieBestelbonUitbetalingCriteria->equals($criteria)) {
				$this->collSportsubsidieBestelbonUitbetalings = SportsubsidieBestelbonUitbetalingPeer::doSelectJoinSportsubsidieBestelbon($criteria, $con);
			}
		}
		$this->lastSportsubsidieBestelbonUitbetalingCriteria = $criteria;

		return $this->collSportsubsidieBestelbonUitbetalings;
	}

	/**
	 * Temporary storage of collDmsNodesRelatedByParentId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDmsNodesRelatedByParentId()
	{
		if ($this->collDmsNodesRelatedByParentId === null) {
			$this->collDmsNodesRelatedByParentId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related DmsNodesRelatedByParentId from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     DmsNode[] DmsNodesRelatedByParentId
	 */
	public function getDmsNodesRelatedByParentId($criteria = null, $con = null)
	{
		// include the Peer class
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related DmsNodesRelatedByParentId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of DmsNodesRelatedByParentId
	 * @throws     PropelException
	 */
	public function countDmsNodesRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
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

	/**
	 * Method called to associate a DmsNode object to this object
	 * through the DmsNode foreign key attribute
	 *
	 * @param      DmsNode $l DmsNode
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDmsNodeRelatedByParentId(DmsNode $l)
	{
		$this->collDmsNodesRelatedByParentId[] = $l;
		$l->setDmsNodeRelatedByParentId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related DmsNodesRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return DmsNode[] DmsNodesRelatedByParentId joined with DmsStore
	 */
	public function getDmsNodesRelatedByParentIdJoinDmsStore(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DmsNodePeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDmsNodeRelatedByParentIdCriteria) || !$this->lastDmsNodeRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDmsNodesRelatedByParentId = DmsNodePeer::doSelectJoinDmsStore($criteria, $con);
			}
		}
		$this->lastDmsNodeRelatedByParentIdCriteria = $criteria;

		return $this->collDmsNodesRelatedByParentId;
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
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related DmsNodePropertys from storage.
	 * If this DmsNode is new, it will return
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

				$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

				DmsNodePropertyPeer::addSelectColumns($criteria);
				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

		$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

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
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related DmsNodePropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return DmsNodeProperty[] DmsNodePropertys joined with DmsPropertyType
	 */
	public function getDmsNodePropertysJoinDmsPropertyType(Criteria $criteria = null, Connection $con = null)
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

				$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelectJoinDmsPropertyType($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DmsNodePropertyPeer::NODE_ID, $this->getId());

			if (!isset($this->lastDmsNodePropertyCriteria) || !$this->lastDmsNodePropertyCriteria->equals($criteria)) {
				$this->collDmsNodePropertys = DmsNodePropertyPeer::doSelectJoinDmsPropertyType($criteria, $con);
			}
		}
		$this->lastDmsNodePropertyCriteria = $criteria;

		return $this->collDmsNodePropertys;
	}

	/**
	 * Temporary storage of collDmsNodeAspects to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDmsNodeAspects()
	{
		if ($this->collDmsNodeAspects === null) {
			$this->collDmsNodeAspects = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related DmsNodeAspects from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     DmsNodeAspect[] DmsNodeAspects
	 */
	public function getDmsNodeAspects($criteria = null, $con = null)
	{
		// include the Peer class
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related DmsNodeAspects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of DmsNodeAspects
	 * @throws     PropelException
	 */
	public function countDmsNodeAspects($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
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

	/**
	 * Method called to associate a DmsNodeAspect object to this object
	 * through the DmsNodeAspect foreign key attribute
	 *
	 * @param      DmsNodeAspect $l DmsNodeAspect
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDmsNodeAspect(DmsNodeAspect $l)
	{
		$this->collDmsNodeAspects[] = $l;
		$l->setDmsNode($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode is new, it will return
	 * an empty collection; or if this DmsNode has previously
	 * been saved, it will retrieve related DmsNodeAspects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in DmsNode.
	 *
	 * @param Criteria     $criteria
	 * @param Connection   $con
	 * @return DmsNodeAspect[] DmsNodeAspects joined with DmsAspect
	 */
	public function getDmsNodeAspectsJoinDmsAspect(Criteria $criteria = null, Connection $con = null)
	{
		// include the Peer class
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DmsNodeAspectPeer::NODE_ID, $this->getId());

			if (!isset($this->lastDmsNodeAspectCriteria) || !$this->lastDmsNodeAspectCriteria->equals($criteria)) {
				$this->collDmsNodeAspects = DmsNodeAspectPeer::doSelectJoinDmsAspect($criteria, $con);
			}
		}
		$this->lastDmsNodeAspectCriteria = $criteria;

		return $this->collDmsNodeAspects;
	}

	/**
	 * Temporary storage of collDmsObjectNodeRefs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDmsObjectNodeRefs()
	{
		if ($this->collDmsObjectNodeRefs === null) {
			$this->collDmsObjectNodeRefs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this DmsNode has previously
	 * been saved, it will retrieve related DmsObjectNodeRefs from storage.
	 * If this DmsNode is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 * @return     DmsObjectNodeRef[] DmsObjectNodeRefs
	 */
	public function getDmsObjectNodeRefs($criteria = null, $con = null)
	{
		// include the Peer class
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related DmsObjectNodeRefs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @return     int The number of DmsObjectNodeRefs
	 * @throws     PropelException
	 */
	public function countDmsObjectNodeRefs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
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

	/**
	 * Method called to associate a DmsObjectNodeRef object to this object
	 * through the DmsObjectNodeRef foreign key attribute
	 *
	 * @param      DmsObjectNodeRef $l DmsObjectNodeRef
	 * @return     void
	 * @throws     PropelException
	 */
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


} // BaseDmsNode
