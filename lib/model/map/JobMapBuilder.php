<?php


/**
 * This class adds structure of 'job' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Dec  1 12:05:15 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class JobMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.JobMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(JobPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(JobPeer::TABLE_NAME);
		$tMap->setPhpName('Job');
		$tMap->setClassname('Job');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('PROJECT_ID', 'ProjectId', 'INTEGER', 'project', 'ID', false, null);

		$tMap->addForeignKey('PUBLICATION_ID', 'PublicationId', 'INTEGER', 'publication', 'ID', false, null);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'INTEGER', 'status', 'ID', false, null);

		$tMap->addColumn('EVENT', 'Event', 'VARCHAR', false, 64);

		$tMap->addColumn('DATE', 'Date', 'DATE', false, null);

		$tMap->addColumn('START_TIME', 'StartTime', 'TIME', false, null);

		$tMap->addColumn('END_TIME', 'EndTime', 'TIME', false, null);

		$tMap->addColumn('DUE_DATE', 'DueDate', 'TIMESTAMP', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('STREET', 'Street', 'VARCHAR', false, 64);

		$tMap->addColumn('CITY', 'City', 'VARCHAR', false, 64);

		$tMap->addColumn('STATE', 'State', 'VARCHAR', false, 64);

		$tMap->addColumn('ZIP', 'Zip', 'VARCHAR', false, 8);

		$tMap->addColumn('CONTACT_NAME', 'ContactName', 'VARCHAR', false, 45);

		$tMap->addColumn('CONTACT_EMAIL', 'ContactEmail', 'VARCHAR', false, 64);

		$tMap->addColumn('CONTACT_PHONE', 'ContactPhone', 'VARCHAR', false, 45);

		$tMap->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ESTIMATE', 'Estimate', 'INTEGER', false, null);

		$tMap->addColumn('ACCT_NUM', 'AcctNum', 'VARCHAR', false, 32);

		$tMap->addColumn('DEPT_ID', 'DeptId', 'VARCHAR', false, 32);

		$tMap->addColumn('GRANT_ID', 'GrantId', 'VARCHAR', false, 32);

		$tMap->addColumn('OTHER', 'Other', 'VARCHAR', false, 255);

		$tMap->addColumn('QUES1', 'Ques1', 'LONGVARCHAR', false, null);

		$tMap->addColumn('QUES2', 'Ques2', 'LONGVARCHAR', false, null);

		$tMap->addColumn('QUES3', 'Ques3', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SLUG', 'Slug', 'VARCHAR', false, 255);

		$tMap->addColumn('PHOTO_TYPE', 'PhotoType', 'VARCHAR', false, 255);

		$tMap->addColumn('PROCESSING', 'Processing', 'VARCHAR', false, 255);

		$tMap->addColumn('G_CAL_ID', 'GCalId', 'VARCHAR', false, 255);

		$tMap->addColumn('G_CAL_ID_CUSTOM', 'GCalIdCustom', 'VARCHAR', false, 255);

		$tMap->addColumn('G_CAL_ID_CUSTOM_URL', 'GCalIdCustomUrl', 'VARCHAR', false, 255);

	} // doBuild()

} // JobMapBuilder
