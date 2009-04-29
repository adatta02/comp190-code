<?php


/**
 * This class adds structure of 'sf_guard_user_profile' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Apr 28 23:18:02 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class sfGuardUserProfileMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.sfGuardUserProfileMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(sfGuardUserProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(sfGuardUserProfilePeer::TABLE_NAME);
		$tMap->setPhpName('sfGuardUserProfile');
		$tMap->setClassname('sfGuardUserProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_TYPE_ID', 'UserTypeId', 'INTEGER', 'user_type', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', false, 255);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 255);

		$tMap->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 255);

	} // doBuild()

} // sfGuardUserProfileMapBuilder
