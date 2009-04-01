<?php


/**
 * This class adds structure of 'sf_tag' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Mon Mar 30 11:54:39 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model.map
 */
class TagMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model.map.TagMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TagPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TagPeer::TABLE_NAME);
		$tMap->setPhpName('Tag');
		$tMap->setClassname('Tag');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'ID', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 100);

		$tMap->addColumn('IS_TRIPLE', 'IsTriple', 'BOOLEAN', false, null);

		$tMap->addColumn('TRIPLE_NAMESPACE', 'TripleNamespace', 'VARCHAR', false, 100);

		$tMap->addColumn('TRIPLE_KEY', 'TripleKey', 'VARCHAR', false, 100);

		$tMap->addColumn('TRIPLE_VALUE', 'TripleValue', 'VARCHAR', false, 100);

	} // doBuild()

} // TagMapBuilder
