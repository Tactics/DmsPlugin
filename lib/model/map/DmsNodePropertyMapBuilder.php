<?php



class DmsNodePropertyMapBuilder {

	
	const CLASS_NAME = 'plugins.ttDmsPlugin.lib.model.map.DmsNodePropertyMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('dms_node_property');
		$tMap->setPhpName('DmsNodeProperty');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignPrimaryKey('NODE_ID', 'NodeId', 'int' , CreoleTypes::INTEGER, 'dms_node', 'ID', true, null);

		$tMap->addForeignPrimaryKey('TYPE_ID', 'TypeId', 'int' , CreoleTypes::INTEGER, 'dms_property_type', 'ID', true, null);

		$tMap->addColumn('BOOLEAN_VALUE', 'BooleanValue', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INT_VALUE', 'IntValue', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('FLOAT_VALUE', 'FloatValue', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('STRING_VALUE', 'StringValue', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TEXT_VALUE', 'TextValue', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 