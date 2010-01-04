<?php


abstract class BaseDmsNodePropertyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'dms_node_property';

	
	const CLASS_DEFAULT = 'plugins.ttDmsPlugin.lib.model.DmsNodeProperty';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'dms_node_property.ID';

	
	const NODE_ID = 'dms_node_property.NODE_ID';

	
	const TYPE_ID = 'dms_node_property.TYPE_ID';

	
	const BOOLEAN_VALUE = 'dms_node_property.BOOLEAN_VALUE';

	
	const INT_VALUE = 'dms_node_property.INT_VALUE';

	
	const FLOAT_VALUE = 'dms_node_property.FLOAT_VALUE';

	
	const STRING_VALUE = 'dms_node_property.STRING_VALUE';

	
	const TEXT_VALUE = 'dms_node_property.TEXT_VALUE';

	
	const CREATED_BY = 'dms_node_property.CREATED_BY';

	
	const UPDATED_BY = 'dms_node_property.UPDATED_BY';

	
	const CREATED_AT = 'dms_node_property.CREATED_AT';

	
	const UPDATED_AT = 'dms_node_property.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'NodeId', 'TypeId', 'BooleanValue', 'IntValue', 'FloatValue', 'StringValue', 'TextValue', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DmsNodePropertyPeer::ID, DmsNodePropertyPeer::NODE_ID, DmsNodePropertyPeer::TYPE_ID, DmsNodePropertyPeer::BOOLEAN_VALUE, DmsNodePropertyPeer::INT_VALUE, DmsNodePropertyPeer::FLOAT_VALUE, DmsNodePropertyPeer::STRING_VALUE, DmsNodePropertyPeer::TEXT_VALUE, DmsNodePropertyPeer::CREATED_BY, DmsNodePropertyPeer::UPDATED_BY, DmsNodePropertyPeer::CREATED_AT, DmsNodePropertyPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'node_id', 'type_id', 'boolean_value', 'int_value', 'float_value', 'string_value', 'text_value', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'NodeId' => 1, 'TypeId' => 2, 'BooleanValue' => 3, 'IntValue' => 4, 'FloatValue' => 5, 'StringValue' => 6, 'TextValue' => 7, 'CreatedBy' => 8, 'UpdatedBy' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (DmsNodePropertyPeer::ID => 0, DmsNodePropertyPeer::NODE_ID => 1, DmsNodePropertyPeer::TYPE_ID => 2, DmsNodePropertyPeer::BOOLEAN_VALUE => 3, DmsNodePropertyPeer::INT_VALUE => 4, DmsNodePropertyPeer::FLOAT_VALUE => 5, DmsNodePropertyPeer::STRING_VALUE => 6, DmsNodePropertyPeer::TEXT_VALUE => 7, DmsNodePropertyPeer::CREATED_BY => 8, DmsNodePropertyPeer::UPDATED_BY => 9, DmsNodePropertyPeer::CREATED_AT => 10, DmsNodePropertyPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'node_id' => 1, 'type_id' => 2, 'boolean_value' => 3, 'int_value' => 4, 'float_value' => 5, 'string_value' => 6, 'text_value' => 7, 'created_by' => 8, 'updated_by' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/ttDmsPlugin/lib/model/map/DmsNodePropertyMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsNodePropertyMapBuilder');
	}
	
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
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(DmsNodePropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DmsNodePropertyPeer::ID);

		$criteria->addSelectColumn(DmsNodePropertyPeer::NODE_ID);

		$criteria->addSelectColumn(DmsNodePropertyPeer::TYPE_ID);

		$criteria->addSelectColumn(DmsNodePropertyPeer::BOOLEAN_VALUE);

		$criteria->addSelectColumn(DmsNodePropertyPeer::INT_VALUE);

		$criteria->addSelectColumn(DmsNodePropertyPeer::FLOAT_VALUE);

		$criteria->addSelectColumn(DmsNodePropertyPeer::STRING_VALUE);

		$criteria->addSelectColumn(DmsNodePropertyPeer::TEXT_VALUE);

		$criteria->addSelectColumn(DmsNodePropertyPeer::CREATED_BY);

		$criteria->addSelectColumn(DmsNodePropertyPeer::UPDATED_BY);

		$criteria->addSelectColumn(DmsNodePropertyPeer::CREATED_AT);

		$criteria->addSelectColumn(DmsNodePropertyPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(dms_node_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dms_node_property.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
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
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DmsNodePropertyPeer::populateObjects(DmsNodePropertyPeer::doSelectRS($criteria, $con));
	}
	
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

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DmsNodePropertyPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDmsPropertyType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDmsNode(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDmsPropertyType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePropertyPeer::addSelectColumns($c);
		$startcol = (DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DmsPropertyTypePeer::addSelectColumns($c);

		$c->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsPropertyTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDmsPropertyType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDmsNodeProperty($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDmsNode(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePropertyPeer::addSelectColumns($c);
		$startcol = (DmsNodePropertyPeer::NUM_COLUMNS - DmsNodePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DmsNodePeer::addSelectColumns($c);

		$c->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsNodePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDmsNode(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDmsNodeProperty($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

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
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

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


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DmsPropertyTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsPropertyType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsNodeProperty($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDmsNodePropertys();
				$obj2->addDmsNodeProperty($obj1);
			}


					
			$omClass = DmsNodePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDmsNode(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDmsNodeProperty($obj1); 					break;
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


	
	public static function doCountJoinAllExceptDmsPropertyType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDmsNode(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePropertyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePropertyPeer::TYPE_ID, DmsPropertyTypePeer::ID);

		$rs = DmsNodePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptDmsPropertyType(Criteria $c, $con = null)
	{
		$c = clone $c;

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

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsNodePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsNode(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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


	
	public static function doSelectJoinAllExceptDmsNode(Criteria $c, $con = null)
	{
		$c = clone $c;

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

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsPropertyTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsPropertyType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return DmsNodePropertyPeer::CLASS_DEFAULT;
	}

	
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
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DmsNodePropertyPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
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
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(DmsNodePropertyPeer::ID);
			$selectCriteria->add(DmsNodePropertyPeer::ID, $criteria->remove(DmsNodePropertyPeer::ID), $comparison);

			$comparison = $criteria->getComparison(DmsNodePropertyPeer::NODE_ID);
			$selectCriteria->add(DmsNodePropertyPeer::NODE_ID, $criteria->remove(DmsNodePropertyPeer::NODE_ID), $comparison);

			$comparison = $criteria->getComparison(DmsNodePropertyPeer::TYPE_ID);
			$selectCriteria->add(DmsNodePropertyPeer::TYPE_ID, $criteria->remove(DmsNodePropertyPeer::TYPE_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDmsNodePropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsNodePropertyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(DmsNodePropertyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(DmsNodePropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DmsNodeProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
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

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(DmsNodeProperty $obj, $cols = null)
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

		$res =  BasePeer::doValidate(DmsNodePropertyPeer::DATABASE_NAME, DmsNodePropertyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DmsNodePropertyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
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
} 
if (Propel::isInit()) {
			try {
		BaseDmsNodePropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/ttDmsPlugin/lib/model/map/DmsNodePropertyMapBuilder.php';
	Propel::registerMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsNodePropertyMapBuilder');
}
