<?php

/**
 * Base static class for performing query and update operations on the 'dms_property_type' table.
 *
 * 
 *
 * @package    plugins.ttDmsPlugin.lib.model.om
 */
abstract class BaseDmsPropertyTypePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'dms_property_type';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'plugins.ttDmsPlugin.lib.model.DmsPropertyType';

	/** The total number of columns. */
	const NUM_COLUMNS = 9;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'dms_property_type.ID';

	/** the column name for the NAME field */
	const NAME = 'dms_property_type.NAME';

	/** the column name for the SYSTEM_NAME field */
	const SYSTEM_NAME = 'dms_property_type.SYSTEM_NAME';

	/** the column name for the DATA_TYPE field */
	const DATA_TYPE = 'dms_property_type.DATA_TYPE';

	/** the column name for the OPTIONS field */
	const OPTIONS = 'dms_property_type.OPTIONS';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'dms_property_type.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'dms_property_type.UPDATED_BY';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'dms_property_type.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'dms_property_type.UPDATED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'SystemName', 'DataType', 'Options', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DmsPropertyTypePeer::ID, DmsPropertyTypePeer::NAME, DmsPropertyTypePeer::SYSTEM_NAME, DmsPropertyTypePeer::DATA_TYPE, DmsPropertyTypePeer::OPTIONS, DmsPropertyTypePeer::CREATED_BY, DmsPropertyTypePeer::UPDATED_BY, DmsPropertyTypePeer::CREATED_AT, DmsPropertyTypePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'system_name', 'data_type', 'options', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'SystemName' => 2, 'DataType' => 3, 'Options' => 4, 'CreatedBy' => 5, 'UpdatedBy' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (DmsPropertyTypePeer::ID => 0, DmsPropertyTypePeer::NAME => 1, DmsPropertyTypePeer::SYSTEM_NAME => 2, DmsPropertyTypePeer::DATA_TYPE => 3, DmsPropertyTypePeer::OPTIONS => 4, DmsPropertyTypePeer::CREATED_BY => 5, DmsPropertyTypePeer::UPDATED_BY => 6, DmsPropertyTypePeer::CREATED_AT => 7, DmsPropertyTypePeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'system_name' => 2, 'data_type' => 3, 'options' => 4, 'created_by' => 5, 'updated_by' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'plugins/ttDmsPlugin/lib/model/map/DmsPropertyTypeMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsPropertyTypeMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DmsPropertyTypePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed[string] A list of field names
	 * @throws     PropelException
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. DmsPropertyTypePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(DmsPropertyTypePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string $alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::ID)
		  : DmsPropertyTypePeer::ID;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::NAME)
		  : DmsPropertyTypePeer::NAME;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::SYSTEM_NAME)
		  : DmsPropertyTypePeer::SYSTEM_NAME;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::DATA_TYPE)
		  : DmsPropertyTypePeer::DATA_TYPE;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::OPTIONS)
		  : DmsPropertyTypePeer::OPTIONS;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::CREATED_BY)
		  : DmsPropertyTypePeer::CREATED_BY;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::UPDATED_BY)
		  : DmsPropertyTypePeer::UPDATED_BY;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::CREATED_AT)
		  : DmsPropertyTypePeer::CREATED_AT;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsPropertyTypePeer::alias($alias, DmsPropertyTypePeer::UPDATED_AT)
		  : DmsPropertyTypePeer::UPDATED_AT;
		$criteria->addSelectColumn($columnToSelect);

	}

	const COUNT = 'COUNT(dms_property_type.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dms_property_type.ID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsPropertyTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsPropertyTypePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsPropertyTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     DmsPropertyType
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DmsPropertyTypePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     DmsPropertyType[] Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DmsPropertyTypePeer::populateObjects(DmsPropertyTypePeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsPropertyTypePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDmsPropertyTypePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DmsPropertyTypePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @param      Resultset $rs
	 * @return     DmsPropertyType[]
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = DmsPropertyTypePeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			/** @var DmsPropertyType $obj */
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return DmsPropertyTypePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a DmsPropertyType or Criteria object.
	 *
	 * @param      mixed $values Criteria or DmsPropertyType object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsPropertyTypePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsPropertyTypePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from DmsPropertyType object
		}

		$criteria->remove(DmsPropertyTypePeer::ID); // remove pkey col since this table uses auto-increment


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseDmsPropertyTypePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsPropertyTypePeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a DmsPropertyType or Criteria object.
	 *
	 * @param      mixed $values Criteria or DmsPropertyType object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsPropertyTypePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsPropertyTypePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(DmsPropertyTypePeer::ID);
			$selectCriteria->add(DmsPropertyTypePeer::ID, $criteria->remove(DmsPropertyTypePeer::ID), $comparison);

		} else { // $values is DmsPropertyType object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDmsPropertyTypePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsPropertyTypePeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the dms_property_type table.
	 *
	 * @param      Connection $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(DmsPropertyTypePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a DmsPropertyType or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or DmsPropertyType object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(DmsPropertyTypePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof DmsPropertyType) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DmsPropertyTypePeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given DmsPropertyType object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      BaseDmsPropertyType $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(BaseDmsPropertyType $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DmsPropertyTypePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DmsPropertyTypePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(DmsPropertyTypePeer::DATABASE_NAME, DmsPropertyTypePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     DmsPropertyType
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(DmsPropertyTypePeer::DATABASE_NAME);

		$criteria->add(DmsPropertyTypePeer::ID, $pk);


		$v = DmsPropertyTypePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @return     DmsPropertyType[]
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(DmsPropertyTypePeer::ID, $pks, Criteria::IN);
			$objs = DmsPropertyTypePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseDmsPropertyTypePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseDmsPropertyTypePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'plugins/ttDmsPlugin/lib/model/map/DmsPropertyTypeMapBuilder.php';
	Propel::registerMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsPropertyTypeMapBuilder');
}
