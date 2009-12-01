<?php


/**
 * This class adds structure of 'photographer' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Dec  1 12:05:16 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class PhotographerMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PhotographerMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PhotographerPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PhotographerPeer::TABLE_NAME);
		$tMap->setPhpName('Photographer');
		$tMap->setClassname('Photographer');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user_profile', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 64);

		$tMap->addColumn('PHONE', 'Phone', 'VARCHAR', false, 45);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', false, 64);

		$tMap->addColumn('AFFILIATION', 'Affiliation', 'VARCHAR', false, 64);

		$tMap->addColumn('WEBSITE', 'Website', 'VARCHAR', false, 64);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('BILLING_ADDRESS', 'BillingAddress', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SLUG', 'Slug', 'VARCHAR', false, 255);

	} // doBuild()

} // PhotographerMapBuilder
