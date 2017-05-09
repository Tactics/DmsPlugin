<?php

/**
 * Base static class for performing query and update operations on the 'dms_node_property' table.
 *
 * 
 *
 * @package    plugins.ttDmsPlugin.lib.model.om
 */
abstract class BaseDmsNodePropertyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'dms_node_property';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'plugins.ttDmsPlugin.lib.model.DmsNodeProperty';

	/** The total number of columns. */
	const NUM_COLUMNS = 12;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'dms_node_property.ID';

	/** the column name for the NODE_ID field */
	const NODE_ID = 'dms_node_property.NODE_ID';

	/** the column name for the TYPE_ID field */
	const TYPE_ID = 'dms_node_property.TYPE_ID';

	/** the column name for the BOOLEAN_VALUE field */
	const BOOLEAN_VALUE = 'dms_node_property.BOOLEAN_VALUE';

	/** the column name for the INT_VALUE field */
	const INT_VALUE = 'dms_node_property.INT_VALUE';

	/** the column name for the FLOAT_VALUE field */
	const FLOAT_VALUE = 'dms_node_property.FLOAT_VALUE';

	/** the column name for the STRING_VALUE field */
	const STRING_VALUE = 'dms_node_property.STRING_VALUE';

	/** the column name for the TEXT_VALUE field */
	const TEXT_VALUE = 'dms_node_property.TEXT_VALUE';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'dms_node_property.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'dms_node_property.UPDATED_BY';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'dms_node_property.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'dms_node_property.UPDATED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'NodeId', 'TypeId', 'BooleanValue', 'IntValue', 'FloatValue', 'StringValue', 'TextValue', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DmsNodePropertyPeer::ID, DmsNodePropertyPeer::NODE_ID, DmsNodePropertyPeer::TYPE_ID, DmsNodePropertyPeer::BOOLEAN_VALUE, DmsNodePropertyPeer::INT_VALUE, DmsNodePropertyPeer::FLOAT_VALUE, DmsNodePropertyPeer::STRING_VALUE, DmsNodePropertyPeer::TEXT_VALUE, DmsNodePropertyPeer::CREATED_BY, DmsNodePropertyPeer::UPDATED_BY, DmsNodePropertyPeer::CREATED_AT, DmsNodePropertyPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'node_id', 'type_id', 'boolean_value', 'int_value', 'float_value', 'string_value', 'text_value', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'NodeId' => 1, 'TypeId' => 2, 'BooleanValue' => 3, 'IntValue' => 4, 'FloatValue' => 5, 'StringValue' => 6, 'TextValue' => 7, 'CreatedBy' => 8, 'UpdatedBy' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (DmsNodePropertyPeer::ID => 0, DmsNodePropertyPeer::NODE_ID => 1, DmsNodePropertyPeer::TYPE_ID => 2, DmsNodePropertyPeer::BOOLEAN_VALUE => 3, DmsNodePropertyPeer::INT_VALUE => 4, DmsNodePropertyPeer::FLOAT_VALUE => 5, DmsNodePropertyPeer::STRING_VALUE => 6, DmsNodePropertyPeer::TEXT_VALUE => 7, DmsNodePropertyPeer::CREATED_BY => 8, DmsNodePropertyPeer::UPDATED_BY => 9, DmsNodePropertyPeer::CREATED_AT => 10, DmsNodePropertyPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'node_id' => 1, 'type_id' => 2, 'boolean_value' => 3, 'int_value' => 4, 'float_value' => 5, 'string_value' => 6, 'text_value' => 7, 'created_by' => 8, 'updated_by' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'plugins/ttDmsPlugin/lib/model/map/DmsNodePropertyMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsNodePropertyMapBuilder');
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
			$map = DmsNodePropertyPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. DmsNodePropertyPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(DmsNodePropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
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
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::ID)
		  : DmsNodePropertyPeer::ID;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::NODE_ID)
		  : DmsNodePropertyPeer::NODE_ID;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::TYPE_ID)
		  : DmsNodePropertyPeer::TYPE_ID;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::BOOLEAN_VALUE)
		  : DmsNodePropertyPeer::BOOLEAN_VALUE;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::INT_VALUE)
		  : DmsNodePropertyPeer::INT_VALUE;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::FLOAT_VALUE)
		  : DmsNodePropertyPeer::FLOAT_VALUE;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::STRING_VALUE)
		  : DmsNodePropertyPeer::STRING_VALUE;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::TEXT_VALUE)
		  : DmsNodePropertyPeer::TEXT_VALUE;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::CREATED_BY)
		  : DmsNodePropertyPeer::CREATED_BY;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::UPDATED_BY)
		  : DmsNodePropertyPeer::UPDATED_BY;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::CREATED_AT)
		  : DmsNodePropertyPeer::CREATED_AT;
		$criteria->addSelectColumn($columnToSelect);

		$columnToSelect = $alias
		  ? DmsNodePropertyPeer::alias($alias, DmsNodePropertyPeer::UPDATED_AT)
		  : DmsNodePropertyPeer::UPDATED_AT;
		$criteria->addSelectColumn($columnToSelect);

	}

	const COUNT = 'COUNT(dms_node_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dms_node_property.ID)';

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
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
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
	 * @return     DmsNodeProperty
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DmsNodePropertyPeer::doSelect($critcopy, $con);
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
	 * @return     DmsNodeProperty[] Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DmsNodePropertyPeer::populateObjects(DmsNodePropertyPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseDmsNodePropertyPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDmsNodePropertyPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DmsNodePropertyPeer::addSelectColumns($criteria);
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
	 * @return     DmsNodeProperty[]
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = DmsNodePropertyPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			/** @var DmsNodeProperty $obj */
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related DmsPropertyType table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinDmsPropertyType(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of DmsNodeProperty objects pre-filled with their DmsPropertyType objects.
	 *
	 * @param      Criteria $c
	 * @param      Connection $con
	 * @return     DmsNodeProperty[] array Array of DmsNodeProperty objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinDmsPropertyType(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePropertyPeer::addSelectColumns($c);
		$startcol = (DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsPropertyTypePeer::addSelectColumns($c);

		$c->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePropertyPeer::getOMClass();

			/** @var DmsNodeProperty $obj1 */
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsPropertyTypePeer::getOMClass();

			/** @var DmsPropertyType $obj2 */
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			/** @var DmsNodeProperty $temp_obj1 */
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDmsPropertyType(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDmsNodeProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of DmsNodeProperty objects pre-filled with their DmsNode objects.
	 *
	 * @param      Criteria $c
	 * @param      Connection $con
	 * @return     DmsNodeProperty[] array Array of DmsNodeProperty objects.
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

		DmsNodePropertyPeer::addSelectColumns($c);
		$startcol = (DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsNodePeer::addSelectColumns($c);

		$c->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePropertyPeer::getOMClass();

			/** @var DmsNodeProperty $obj1 */
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsNodePeer::getOMClass();

			/** @var DmsNode $obj2 */
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			/** @var DmsNodeProperty $temp_obj1 */
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDmsNode(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDmsNodeProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1); //CHECKME
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
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);

		$criteria->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of DmsNodeProperty objects pre-filled with all related objects.
	 *
	 * @param      Criteria $c
	 * @param      Connection $con
	 * @return     DmsNodeProperty[] array Array of DmsNodeProperty objects.
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

		DmsNodePropertyPeer::addSelectColumns($c);
		$startcol2 = (DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsPropertyTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DmsPropertyTypePeer::NUM_COLUMNS;

		DmsNodePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DmsNodePeer::NUM_COLUMNS;

		$c->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);

		$c->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePropertyPeer::getOMClass();

            /** @var DmsNodeProperty $obj1 */
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined DmsPropertyType rows
	
			$omClass = DmsPropertyTypePeer::getOMClass();

            /** @var DmsPropertyType $obj2 */
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
			    /** @var DmsNodeProperty $temp_obj1 */
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsPropertyType(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsNodeProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1);
			}


				// Add objects for joined DmsNode rows
	
			$omClass = DmsNodePeer::getOMClass();

            /** @var DmsNode $obj3 */
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
			    /** @var DmsNodeProperty $temp_obj1 */
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDmsNode(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDmsNodeProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initDmsNodePropertys();
				$obj3->addDmsNodeProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related DmsPropertyType table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptDmsPropertyType(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related DmsNode table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptDmsNode(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of DmsNodeProperty objects pre-filled with all related objects except DmsPropertyType.
	 *
	 * @param      Criteria $c
	 * @param      Connection $con
	 * @return     array Array of DmsNodeProperty objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptDmsPropertyType(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePropertyPeer::addSelectColumns($c);
		$startcol2 = (DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsNodePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DmsNodePeer::NUM_COLUMNS;

		$c->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePropertyPeer::getOMClass();

			/** @var DmsNodeProperty $obj1 */
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsNodePeer::getOMClass();

            /** @var DmsNode $obj2 */
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
			    /** @var DmsNodeProperty $temp_obj1 */
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsNode(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsNodeProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of DmsNodeProperty objects pre-filled with all related objects except DmsNode.
	 *
	 * @param      Criteria $c
	 * @param      Connection $con
	 * @return     array Array of DmsNodeProperty objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptDmsNode(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePropertyPeer::addSelectColumns($c);
		$startcol2 = (DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsPropertyTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DmsPropertyTypePeer::NUM_COLUMNS;

		$c->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePropertyPeer::getOMClass();

			/** @var DmsNodeProperty $obj1 */
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsPropertyTypePeer::getOMClass();

            /** @var DmsPropertyType $obj2 */
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
			    /** @var DmsNodeProperty $temp_obj1 */
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsPropertyType(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsNodeProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1);
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
		return DmsNodePropertyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a DmsNodeProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or DmsNodeProperty object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodePropertyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsNodePropertyPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from DmsNodeProperty object
		}

		$criteria->remove(DmsNodePropertyPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseDmsNodePropertyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsNodePropertyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a DmsNodeProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or DmsNodeProperty object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodePropertyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsNodePropertyPeer', $values, $con);
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

			$comparison = $criteria->getComparison(DmsNodePropertyPeer::ID);
			$selectCriteria->add(DmsNodePropertyPeer::ID, $criteria->remove(DmsNodePropertyPeer::ID), $comparison);

			$comparison = $criteria->getComparison(DmsNodePropertyPeer::NODE_ID);
			$selectCriteria->add(DmsNodePropertyPeer::NODE_ID, $criteria->remove(DmsNodePropertyPeer::NODE_ID), $comparison);

			$comparison = $criteria->getComparison(DmsNodePropertyPeer::TYPE_ID);
			$selectCriteria->add(DmsNodePropertyPeer::TYPE_ID, $criteria->remove(DmsNodePropertyPeer::TYPE_ID), $comparison);

		} else { // $values is DmsNodeProperty object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDmsNodePropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsNodePropertyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the dms_node_property table.
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
			$affectedRows += BasePeer::doDeleteAll(DmsNodePropertyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a DmsNodeProperty or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or DmsNodeProperty object or primary key or array of primary keys
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
			$con = Propel::getConnection(DmsNodePropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof DmsNodeProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if(count($values) == count($values, COUNT_RECURSIVE))
			{
				// array is not multi-dimensional
				$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
				$vals[2][] = $value[2];
			}

			$criteria->add(DmsNodePropertyPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(DmsNodePropertyPeer::NODE_ID, $vals[1], Criteria::IN);
			$criteria->add(DmsNodePropertyPeer::TYPE_ID, $vals[2], Criteria::IN);
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
	 * Validates all modified columns of given DmsNodeProperty object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      BaseDmsNodeProperty $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(BaseDmsNodeProperty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DmsNodePropertyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DmsNodePropertyPeer::TABLE_NAME);

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

		return BasePeer::doValidate(DmsNodePropertyPeer::DATABASE_NAME, DmsNodePropertyPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $id
	   @param int $node_id
	   @param int $type_id
	   
	 * @param      Connection $con
	 * @return     DmsNodeProperty
	 */
	public static function retrieveByPK( $id, $node_id, $type_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(DmsNodePropertyPeer::ID, $id);
		$criteria->add(DmsNodePropertyPeer::NODE_ID, $node_id);
		$criteria->add(DmsNodePropertyPeer::TYPE_ID, $type_id);
		$v = DmsNodePropertyPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseDmsNodePropertyPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseDmsNodePropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'plugins/ttDmsPlugin/lib/model/map/DmsNodePropertyMapBuilder.php';
	Propel::registerMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsNodePropertyMapBuilder');
}
