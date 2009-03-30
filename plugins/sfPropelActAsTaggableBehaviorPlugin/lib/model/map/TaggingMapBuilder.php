<?php


/**
 * This class adds structure of 'sf_tagging' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Thu Mar 26 16:09:55 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model.map
 */
class TaggingMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model.map.TaggingMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TaggingPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TaggingPeer::TABLE_NAME);
		$tMap->setPhpName('Tagging');
		$tMap->setClassname('Tagging');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'ID', 'INTEGER', true, null);

		$tMap->addForeignKey('TAG_ID', 'TagId', 'INTEGER', 'sf_tag', 'ID', true, null);

		$tMap->addColumn('TAGGABLE_MODEL', 'TaggableModel', 'VARCHAR', false, 30);

		$tMap->addColumn('TAGGABLE_ID', 'TaggableId', 'INTEGER', false, null);

	} // doBuild()

} // TaggingMapBuilder
