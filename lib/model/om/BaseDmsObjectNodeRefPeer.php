<?php


abstract class BaseDmsObjectNodeRefPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'dms_object_node_ref';

	
	const CLASS_DEFAULT = 'plugins.ttDmsPlugin.lib.model.DmsObjectNodeRef';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'dms_object_node_ref.ID';

	
	const NODE_ID = 'dms_object_node_ref.NODE_ID';

	
	const OBJECT_CLASS = 'dms_object_node_ref.OBJECT_CLASS';

	
	const OBJECT_ID = 'dms_object_node_ref.OBJECT_ID';

	
	const CREATED_BY = 'dms_object_node_ref.CREATED_BY';

	
	const UPDATED_BY = 'dms_object_node_ref.UPDATED_BY';

	
	const CREATED_AT = 'dms_object_node_ref.CREATED_AT';

	
	const UPDATED_AT = 'dms_object_node_ref.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'NodeId', 'ObjectClass', 'ObjectId', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DmsObjectNodeRefPeer::ID, DmsObjectNodeRefPeer::NODE_ID, DmsObjectNodeRefPeer::OBJECT_CLASS, DmsObjectNodeRefPeer::OBJECT_ID, DmsObjectNodeRefPeer::CREATED_BY, DmsObjectNodeRefPeer::UPDATED_BY, DmsObjectNodeRefPeer::CREATED_AT, DmsObjectNodeRefPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'node_id', 'object_class', 'object_id', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'NodeId' => 1, 'ObjectClass' => 2, 'ObjectId' => 3, 'CreatedBy' => 4, 'UpdatedBy' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (DmsObjectNodeRefPeer::ID => 0, DmsObjectNodeRefPeer::NODE_ID => 1, DmsObjectNodeRefPeer::OBJECT_CLASS => 2, DmsObjectNodeRefPeer::OBJECT_ID => 3, DmsObjectNodeRefPeer::CREATED_BY => 4, DmsObjectNodeRefPeer::UPDATED_BY => 5, DmsObjectNodeRefPeer::CREATED_AT => 6, DmsObjectNodeRefPeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'node_id' => 1, 'object_class' => 2, 'object_id' => 3, 'created_by' => 4, 'updated_by' => 5, 'created_at' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/ttDmsPlugin/lib/model/map/DmsObjectNodeRefMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsObjectNodeRefMapBuilder');
	}
	
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
		return str_replace(DmsObjectNodeRefPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::ID);

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::NODE_ID);

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::OBJECT_CLASS);

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::OBJECT_ID);

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::CREATED_BY);

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::UPDATED_BY);

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::CREATED_AT);

		$criteria->addSelectColumn(DmsObjectNodeRefPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(dms_object_node_ref.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dms_object_node_ref.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsObjectNodeRefPeer::doSelectRS($criteria, $con);
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
		$objects = DmsObjectNodeRefPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DmsObjectNodeRefPeer::populateObjects(DmsObjectNodeRefPeer::doSelectRS($criteria, $con));
	}
	
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

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DmsObjectNodeRefPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDmsNode(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsObjectNodeRefPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDmsNode(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsObjectNodeRefPeer::addSelectColumns($c);
		$startcol = (DmsObjectNodeRefPeer::NUM_COLUMNS - DmsObjectNodeRefPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DmsNodePeer::addSelectColumns($c);

		$c->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsObjectNodeRefPeer::getOMClass();

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
										$temp_obj2->addDmsObjectNodeRef($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDmsObjectNodeRefs();
				$obj2->addDmsObjectNodeRef($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsObjectNodeRefPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID);

		$rs = DmsObjectNodeRefPeer::doSelectRS($criteria, $con);
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

		DmsObjectNodeRefPeer::addSelectColumns($c);
		$startcol2 = (DmsObjectNodeRefPeer::NUM_COLUMNS - DmsObjectNodeRefPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsNodePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DmsNodePeer::NUM_COLUMNS;

		$c->addJoin(DmsObjectNodeRefPeer::NODE_ID, DmsNodePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsObjectNodeRefPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DmsNodePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsNode(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsObjectNodeRef($obj1); 					break;
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

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return DmsObjectNodeRefPeer::CLASS_DEFAULT;
	}

	
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
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DmsObjectNodeRefPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
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
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(DmsObjectNodeRefPeer::ID);
			$selectCriteria->add(DmsObjectNodeRefPeer::ID, $criteria->remove(DmsObjectNodeRefPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDmsObjectNodeRefPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsObjectNodeRefPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(DmsObjectNodeRefPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DmsObjectNodeRefPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DmsObjectNodeRef) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DmsObjectNodeRefPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DmsObjectNodeRef $obj, $cols = null)
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

		$res =  BasePeer::doValidate(DmsObjectNodeRefPeer::DATABASE_NAME, DmsObjectNodeRefPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DmsObjectNodeRefPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
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

} 
if (Propel::isInit()) {
			try {
		BaseDmsObjectNodeRefPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/ttDmsPlugin/lib/model/map/DmsObjectNodeRefMapBuilder.php';
	Propel::registerMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsObjectNodeRefMapBuilder');
}
