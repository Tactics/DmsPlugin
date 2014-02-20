<?php


abstract class BaseDmsPropertyTypePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'dms_property_type';

	
	const CLASS_DEFAULT = 'plugins.ttDmsPlugin.lib.model.DmsPropertyType';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'dms_property_type.ID';

	
	const NAME = 'dms_property_type.NAME';

	
	const SYSTEM_NAME = 'dms_property_type.SYSTEM_NAME';

	
	const DATA_TYPE = 'dms_property_type.DATA_TYPE';

	
	const OPTIONS = 'dms_property_type.OPTIONS';

	
	const CREATED_BY = 'dms_property_type.CREATED_BY';

	
	const UPDATED_BY = 'dms_property_type.UPDATED_BY';

	
	const CREATED_AT = 'dms_property_type.CREATED_AT';

	
	const UPDATED_AT = 'dms_property_type.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'SystemName', 'DataType', 'Options', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DmsPropertyTypePeer::ID, DmsPropertyTypePeer::NAME, DmsPropertyTypePeer::SYSTEM_NAME, DmsPropertyTypePeer::DATA_TYPE, DmsPropertyTypePeer::OPTIONS, DmsPropertyTypePeer::CREATED_BY, DmsPropertyTypePeer::UPDATED_BY, DmsPropertyTypePeer::CREATED_AT, DmsPropertyTypePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'system_name', 'data_type', 'options', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'SystemName' => 2, 'DataType' => 3, 'Options' => 4, 'CreatedBy' => 5, 'UpdatedBy' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (DmsPropertyTypePeer::ID => 0, DmsPropertyTypePeer::NAME => 1, DmsPropertyTypePeer::SYSTEM_NAME => 2, DmsPropertyTypePeer::DATA_TYPE => 3, DmsPropertyTypePeer::OPTIONS => 4, DmsPropertyTypePeer::CREATED_BY => 5, DmsPropertyTypePeer::UPDATED_BY => 6, DmsPropertyTypePeer::CREATED_AT => 7, DmsPropertyTypePeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'system_name' => 2, 'data_type' => 3, 'options' => 4, 'created_by' => 5, 'updated_by' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/ttDmsPlugin/lib/model/map/DmsPropertyTypeMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsPropertyTypeMapBuilder');
	}
	
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
		return str_replace(DmsPropertyTypePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DmsPropertyTypePeer::ID);

		$criteria->addSelectColumn(DmsPropertyTypePeer::NAME);

		$criteria->addSelectColumn(DmsPropertyTypePeer::SYSTEM_NAME);

		$criteria->addSelectColumn(DmsPropertyTypePeer::DATA_TYPE);

		$criteria->addSelectColumn(DmsPropertyTypePeer::OPTIONS);

		$criteria->addSelectColumn(DmsPropertyTypePeer::CREATED_BY);

		$criteria->addSelectColumn(DmsPropertyTypePeer::UPDATED_BY);

		$criteria->addSelectColumn(DmsPropertyTypePeer::CREATED_AT);

		$criteria->addSelectColumn(DmsPropertyTypePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(dms_property_type.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dms_property_type.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DmsPropertyTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DmsPropertyTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DmsPropertyTypePeer::doSelectRS($criteria, $con);
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
		$objects = DmsPropertyTypePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DmsPropertyTypePeer::populateObjects(DmsPropertyTypePeer::doSelectRS($criteria, $con));
	}
	
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

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DmsPropertyTypePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return DmsPropertyTypePeer::CLASS_DEFAULT;
	}

	
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
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DmsPropertyTypePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
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
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(DmsPropertyTypePeer::ID);
			$selectCriteria->add(DmsPropertyTypePeer::ID, $criteria->remove(DmsPropertyTypePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDmsPropertyTypePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDmsPropertyTypePeer', $values, $con, $ret);
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
			$affectedRows += DmsPropertyTypePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(DmsPropertyTypePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DmsPropertyTypePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DmsPropertyType) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DmsPropertyTypePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += DmsPropertyTypePeer::doOnDeleteCascade($criteria, $con);
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

				$objects = DmsPropertyTypePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'plugins/ttDmsPlugin/lib/model/DmsNodeProperty.php';

						$c = new Criteria();
			
			$c->add(DmsNodePropertyPeer::TYPE_ID, $obj->getId());
			$affectedRows += DmsNodePropertyPeer::doDelete($c, $con);

			include_once 'plugins/ttDmsPlugin/lib/model/DmsAspectPropertyType.php';

						$c = new Criteria();
			
			$c->add(DmsAspectPropertyTypePeer::TYPE_ID, $obj->getId());
			$affectedRows += DmsAspectPropertyTypePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(DmsPropertyType $obj, $cols = null)
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

		$res =  BasePeer::doValidate(DmsPropertyTypePeer::DATABASE_NAME, DmsPropertyTypePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DmsPropertyTypePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DmsPropertyTypePeer::DATABASE_NAME);

		$criteria->add(DmsPropertyTypePeer::ID, $pk);


		$v = DmsPropertyTypePeer::doSelect($criteria, $con);

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
			$criteria->add(DmsPropertyTypePeer::ID, $pks, Criteria::IN);
			$objs = DmsPropertyTypePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDmsPropertyTypePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/ttDmsPlugin/lib/model/map/DmsPropertyTypeMapBuilder.php';
	Propel::registerMapBuilder('plugins.ttDmsPlugin.lib.model.map.DmsPropertyTypeMapBuilder');
}
