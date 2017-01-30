<?php


/**
 * This class adds structure of 'dms_node_property' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.ttDmsPlugin.lib.model.map
 */
class DmsNodePropertyMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.ttDmsPlugin.lib.model.map.DmsNodePropertyMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
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

	} // doBuild()

} // DmsNodePropertyMapBuilder
