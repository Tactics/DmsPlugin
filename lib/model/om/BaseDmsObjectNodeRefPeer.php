<?php

/**
 * Base static class for performing query and update operations on the 'dms_object_node_ref' table.
 *
 * 
 *
 * @package    plugins.ttDmsPlugin.lib.model.om
 */
abstract class BaseDmsObjectNodeRefPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'dms_object_node_ref';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'plugins.ttDmsPlugin.lib.model.DmsObjectNodeRef';

	/** The total number of columns. */
	const NUM_COLUMNS = 8;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'dms_object_node_ref.ID';

	/** the column name for the NODE_ID field */
	const NODE_ID = 'dms_object_node_ref.NODE_ID';

	/** the column name for the OBJECT_CLASS field */
	const OBJECT_CLASS = 'dms_object_node_ref.OBJECT_CLASS';

	/** the column name for the OBJECT_ID field */
	const OBJECT_ID = 'dms_object_node_ref.OBJECT_ID';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'dms_object_node_ref.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'dms_object_node_ref.UPDATED_BY';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'dms_object_node_ref.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'dms_object_node_ref.UPDATED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'NodeId', 'ObjectClass', 'ObjectId', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DmsObjectNodeRefPeer::ID, DmsObjectNodeRefPeer::NODE_ID, DmsObjectNodeRefPeer::OBJECT_CLASS, DmsObjectNodeRefPeer::OBJECT_ID, DmsObjectNodeRefPeer::CREATED_BY, DmsObjectNodeRefPeer::UPDATED_BY, DmsObjectNodeRefPeer::CREATED_AT, DmsObjectNodeRefPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'node_id', 'object_class', 'object_id', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'NodeId' => 1, 'ObjectClass' => 2, 'ObjectId' => 3, 'CreatedBy' => 4, 'UpdatedBy' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (DmsObjectNodeRefPeer::ID => 0, DmsObjectNodeRefPeer::NODE_ID => 1, DmsObjectNodeRefPeer::OBJECT_CLASS => 2, DmsObjectNodeRefPeer::OBJECT_ID => 3, DmsObjectNodeRefPeer::CREATED_BY => 4, DmsObjectNodeRefPeer::UPDATED_BY => 5, DmsObjectNodeRefPeer::CREATED_AT => 6, DmsObjectNodeRefPeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'node_id' => 1, 'object_class' => 2, 'object_id' => 3, 'created_by' => 4, 'updated_by' => 5, 'created_at' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'plugins/ttDmsPlugin/lib/model/map/DmsObjectNodeRefMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsObjectNodeRefMapBuilder');
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
			$map = DmsObjectNodeRefPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. DmsObjectNodeRefPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(DmsObjectNodeRefPeer::TABLE_NAME.'.', $alias.'.', $column);
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
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::ID)
		  : DmsObjectNodeRefPeer::ID;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::NODE_ID)
		  : DmsObjectNodeRefPeer::NODE_ID;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::OBJECT_CLASS)
		  : DmsObjectNodeRefPeer::OBJECT_CLASS;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::OBJECT_ID)
		  : DmsObjectNodeRefPeer::OBJECT_ID;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::CREATED_BY)
		  : DmsObjectNodeRefPeer::CREATED_BY;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::UPDATED_BY)
		  : DmsObjectNodeRefPeer::UPDATED_BY;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::CREATED_AT)
		  : DmsObjectNodeRefPeer::CREATED_AT;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsObjectNodeRefPeer::alias($alias, DmsObjectNodeRefPeer::UPDATED_AT)
		  : DmsObjectNodeRefPeer::UPDATED_AT;
		$criteria->addSelectColumn($columnToSelect);

	}

	const COUNT = 'COUNT(dms_object_node_ref.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dms_object_node_ref.ID)';

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
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsObjectNodeRefPeer::doSelectRS($criteria, $con);
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
	 * @return     DmsObjectNodeRef
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DmsObjectNodeRefPeer::doSelect($critcopy, $con);
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
	 * @return     DmsObjectNodeRef[] Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DmsObjectNodeRefPeer::populateObjects(DmsObjectNodeRefPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseDmsObjectNodeRefPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDmsObjectNodeRefPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DmsObjectNodeRefPeer::addSelectColumns($criteria);
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
	 * @return     DmsObjectNodeRef[]
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = DmsObjectNodeRefPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			/** @var DmsObjectNodeRef $obj */
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related DmsNode table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinDmsNode(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsObjectNodeRefPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of DmsObjectNodeRef objects pre-filled with their DmsNode objects.
	 *
	 * @param      Criteria $c
	 * @param      Connection $con
	 * @return     DmsObjectNodeRef[] array Array of DmsObjectNodeRef objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinDmsNode(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsObjectNodeRefPeer::addSelectColumns($c);
		$startcol = (DmsObjectNodeRefPeer::NUM_COLUMNS - DmsObjectNodeRefPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsNodePeer::addSelectColumns($c);

		$c->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsObjectNodeRefPeer::getOMClass();

			/** @var DmsObjectNodeRef $obj1 */
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsNodePeer::getOMClass();

			/** @var DmsNode $obj2 */
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			/** @var DmsObjectNodeRef $temp_obj1 */
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDmsNode(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDmsObjectNodeRef($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDmsObjectNodeRefs();
				$obj2->addDmsObjectNodeRef($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsObjectNodeRefPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of DmsObjectNodeRef objects pre-filled with all related objects.
	 *
	 * @param      Criteria $c
	 * @param      Connection $con
	 * @return     DmsObjectNodeRef[] array Array of DmsObjectNodeRef objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsObjectNodeRefPeer::addSelectColumns($c);
		$startcol2 = (DmsObjectNodeRefPeer::NUM_COLUMNS - DmsObjectNodeRefPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsNodePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DmsNodePeer::NUM_COLUMNS;

		$c->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsObjectNodeRefPeer::getOMClass();

            /** @var DmsObjectNodeRef $obj1 */
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined DmsNode rows
	
			$omClass = DmsNodePeer::getOMClass();

            /** @var DmsNode $obj2 */
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
			    /** @var DmsObjectNodeRef $temp_obj1 */
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsNode(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsObjectNodeRef($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initDmsObjectNodeRefs();
				$obj2->addDmsObjectNodeRef($obj1);
			}

			$results[] = $obj1;
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
		return DmsObjectNodeRefPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a DmsObjectNodeRef or Criteria object.
	 *
	 * @param      mixed $values Criteria or DmsObjectNodeRef object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsObjectNodeRefPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsObjectNodeRefPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from DmsObjectNodeRef object
		}

		$criteria->remove(DmsObjectNodeRefPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseDmsObjectNodeRefPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsObjectNodeRefPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a DmsObjectNodeRef or Criteria object.
	 *
	 * @param      mixed $values Criteria or DmsObjectNodeRef object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsObjectNodeRefPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsObjectNodeRefPeer', $values, $con);
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

			$comparison = $criteria->getComparison(DmsObjectNodeRefPeer::ID);
			$selectCriteria->add(DmsObjectNodeRefPeer::ID, $criteria->remove(DmsObjectNodeRefPeer::ID), $comparison);

		} else { // $values is DmsObjectNodeRef object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDmsObjectNodeRefPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsObjectNodeRefPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the dms_object_node_ref table.
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
			$affectedRows += BasePeer::doDeleteAll(DmsObjectNodeRefPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a DmsObjectNodeRef or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or DmsObjectNodeRef object or primary key or array of primary keys
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
			$con = Propel::getConnection(DmsObjectNodeRefPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof DmsObjectNodeRef) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DmsObjectNodeRefPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given DmsObjectNodeRef object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      BaseDmsObjectNodeRef $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(BaseDmsObjectNodeRef $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DmsObjectNodeRefPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DmsObjectNodeRefPeer::TABLE_NAME);

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

		return BasePeer::doValidate(DmsObjectNodeRefPeer::DATABASE_NAME, DmsObjectNodeRefPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     DmsObjectNodeRef
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(DmsObjectNodeRefPeer::DATABASE_NAME);

		$criteria->add(DmsObjectNodeRefPeer::ID, $pk);


		$v = DmsObjectNodeRefPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @return     DmsObjectNodeRef[]
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
			$criteria->add(DmsObjectNodeRefPeer::ID, $pks, Criteria::IN);
			$objs = DmsObjectNodeRefPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseDmsObjectNodeRefPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseDmsObjectNodeRefPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'plugins/ttDmsPlugin/lib/model/map/DmsObjectNodeRefMapBuilder.php';
	Propel::registerMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsObjectNodeRefMapBuilder');
}
