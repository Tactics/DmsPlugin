<?php


abstract class BaseDmsNodePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'dms_node';

	
	const CLASS_DEFAULT = 'plugins.ttDmsPlugin.lib.model.DmsNode';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'dms_node.ID';

	
	const STORE_ID = 'dms_node.STORE_ID';

	
	const PARENT_ID = 'dms_node.PARENT_ID';

	
	const IS_FOLDER = 'dms_node.IS_FOLDER';

	
	const NAME = 'dms_node.NAME';

	
	const DISK_NAME = 'dms_node.DISK_NAME';

	
	const CREATED_BY = 'dms_node.CREATED_BY';

	
	const UPDATED_BY = 'dms_node.UPDATED_BY';

	
	const CREATED_AT = 'dms_node.CREATED_AT';

	
	const UPDATED_AT = 'dms_node.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'StoreId', 'ParentId', 'IsFolder', 'Name', 'DiskName', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DmsNodePeer::ID, DmsNodePeer::STORE_ID, DmsNodePeer::PARENT_ID, DmsNodePeer::IS_FOLDER, DmsNodePeer::NAME, DmsNodePeer::DISK_NAME, DmsNodePeer::CREATED_BY, DmsNodePeer::UPDATED_BY, DmsNodePeer::CREATED_AT, DmsNodePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'store_id', 'parent_id', 'is_folder', 'name', 'disk_name', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'StoreId' => 1, 'ParentId' => 2, 'IsFolder' => 3, 'Name' => 4, 'DiskName' => 5, 'CreatedBy' => 6, 'UpdatedBy' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (DmsNodePeer::ID => 0, DmsNodePeer::STORE_ID => 1, DmsNodePeer::PARENT_ID => 2, DmsNodePeer::IS_FOLDER => 3, DmsNodePeer::NAME => 4, DmsNodePeer::DISK_NAME => 5, DmsNodePeer::CREATED_BY => 6, DmsNodePeer::UPDATED_BY => 7, DmsNodePeer::CREATED_AT => 8, DmsNodePeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'store_id' => 1, 'parent_id' => 2, 'is_folder' => 3, 'name' => 4, 'disk_name' => 5, 'created_by' => 6, 'updated_by' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/ttDmsPlugin/lib/model/map/DmsNodeMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsNodeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DmsNodePeer::getTableMap();
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
		return str_replace(DmsNodePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DmsNodePeer::ID);

		$criteria->addSelectColumn(DmsNodePeer::STORE_ID);

		$criteria->addSelectColumn(DmsNodePeer::PARENT_ID);

		$criteria->addSelectColumn(DmsNodePeer::IS_FOLDER);

		$criteria->addSelectColumn(DmsNodePeer::NAME);

		$criteria->addSelectColumn(DmsNodePeer::DISK_NAME);

		$criteria->addSelectColumn(DmsNodePeer::CREATED_BY);

		$criteria->addSelectColumn(DmsNodePeer::UPDATED_BY);

		$criteria->addSelectColumn(DmsNodePeer::CREATED_AT);

		$criteria->addSelectColumn(DmsNodePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(dms_node.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dms_node.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsNodePeer::doSelectRS($criteria, $con);
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
		$objects = DmsNodePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DmsNodePeer::populateObjects(DmsNodePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDmsNodePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DmsNodePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DmsNodePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDmsStore(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePeer::STORE_ID, DmsStorePeer::ID);

		$rs = DmsNodePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDmsStore(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePeer::addSelectColumns($c);
		$startcol = (DmsNodePeer::NUM_COLUMNS - DmsNodePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DmsStorePeer::addSelectColumns($c);

		$c->addJoin(DmsNodePeer::STORE_ID, DmsStorePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsStorePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDmsStore(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDmsNode($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDmsNodes();
				$obj2->addDmsNode($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePeer::STORE_ID, DmsStorePeer::ID);

		$rs = DmsNodePeer::doSelectRS($criteria, $con);
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

		DmsNodePeer::addSelectColumns($c);
		$startcol2 = (DmsNodePeer::NUM_COLUMNS - DmsNodePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsStorePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DmsStorePeer::NUM_COLUMNS;

		$c->addJoin(DmsNodePeer::STORE_ID, DmsStorePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DmsStorePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsStore(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsNode($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDmsNodes();
				$obj2->addDmsNode($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptDmsStore(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsNodePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDmsNodeRelatedByParentId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsNodePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsNodePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DmsNodePeer::STORE_ID, DmsStorePeer::ID);

		$rs = DmsNodePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptDmsStore(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePeer::addSelectColumns($c);
		$startcol2 = (DmsNodePeer::NUM_COLUMNS - DmsNodePeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDmsNodeRelatedByParentId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DmsNodePeer::addSelectColumns($c);
		$startcol2 = (DmsNodePeer::NUM_COLUMNS - DmsNodePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DmsStorePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DmsStorePeer::NUM_COLUMNS;

		$c->addJoin(DmsNodePeer::STORE_ID, DmsStorePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DmsNodePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DmsStorePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDmsStore(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDmsNode($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDmsNodes();
				$obj2->addDmsNode($obj1);
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
		return DmsNodePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsNodePeer', $values, $con);
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

		$criteria->remove(DmsNodePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseDmsNodePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsNodePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDmsNodePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDmsNodePeer', $values, $con);
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
			$comparison = $criteria->getComparison(DmsNodePeer::ID);
			$selectCriteria->add(DmsNodePeer::ID, $criteria->remove(DmsNodePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDmsNodePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsNodePeer', $values, $con, $ret);
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
			$affectedRows += DmsNodePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(DmsNodePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DmsNodePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DmsNode) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DmsNodePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += DmsNodePeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = DmsNodePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'plugins/ttDmsPlugin/lib/model/DmsObjectNodeRef.php';

						$c = new Criteria();
			
			$c->add(DmsObjectNodeRefPeer::NODE_ID, $obj->getId());
			$affectedRows += DmsObjectNodeRefPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(DmsNode $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DmsNodePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DmsNodePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DmsNodePeer::DATABASE_NAME, DmsNodePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DmsNodePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DmsNodePeer::DATABASE_NAME);

		$criteria->add(DmsNodePeer::ID, $pk);


		$v = DmsNodePeer::doSelect($criteria, $con);

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
			$criteria->add(DmsNodePeer::ID, $pks, Criteria::IN);
			$objs = DmsNodePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDmsNodePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/ttDmsPlugin/lib/model/map/DmsNodeMapBuilder.php';
	Propel::registerMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsNodeMapBuilder');
}
