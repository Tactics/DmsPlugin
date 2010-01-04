<?php



class DmsNodeAspectMapBuilder {

	
	const CLASS_NAME = 'plugins.ttDmsPlugin.lib.model.map.DmsNodeAspectMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('dms_node_aspect');
		$tMap->setPhpName('DmsNodeAspect');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('NODE_ID', 'NodeId', 'int', CreoleTypes::INTEGER, 'dms_node', 'ID', false, null);

		$tMap->addForeignKey('ASPECT_ID', 'AspectId', 'int', CreoleTypes::INTEGER, 'dms_aspect', 'ID', false, null);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 