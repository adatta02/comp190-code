<?php

/**
 * Base class that represents a row from the 'photographer_region' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Thu Apr 30 16:07:02 2009
 *
 * @package    lib.model.om
 */
abstract class BasePhotographerRegion extends BaseObject  implements Persistent {


  const PEER = 'PhotographerRegionPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PhotographerRegionPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the photographer_id field.
	 * @var        int
	 */
	protected $photographer_id;

	/**
	 * The value for the address field.
	 * @var        string
	 */
	protected $address;

	/**
	 * The value for the latitude field.
	 * @var        string
	 */
	protected $latitude;

	/**
	 * The value for the longitude field.
	 * @var        string
	 */
	protected $longitude;

	/**
	 * The value for the x field.
	 * @var        string
	 */
	protected $x;

	/**
	 * The value for the y field.
	 * @var        string
	 */
	protected $y;

	/**
	 * @var        Photographer
	 */
	protected $aPhotographer;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of BasePhotographerRegion object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [photographer_id] column value.
	 * 
	 * @return     int
	 */
	public function getPhotographerId()
	{
		return $this->photographer_id;
	}

	/**
	 * Get the [address] column value.
	 * 
	 * @return     string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Get the [latitude] column value.
	 * 
	 * @return     string
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 * Get the [longitude] column value.
	 * 
	 * @return     string
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}

	/**
	 * Get the [x] column value.
	 * 
	 * @return     string
	 */
	public function getX()
	{
		return $this->x;
	}

	/**
	 * Get the [y] column value.
	 * 
	 * @return     string
	 */
	public function getY()
	{
		return $this->y;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     PhotographerRegion The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PhotographerRegionPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [photographer_id] column.
	 * 
	 * @param      int $v new value
	 * @return     PhotographerRegion The current object (for fluent API support)
	 */
	public function setPhotographerId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->photographer_id !== $v) {
			$this->photographer_id = $v;
			$this->modifiedColumns[] = PhotographerRegionPeer::PHOTOGRAPHER_ID;
		}

		if ($this->aPhotographer !== null && $this->aPhotographer->getId() !== $v) {
			$this->aPhotographer = null;
		}

		return $this;
	} // setPhotographerId()

	/**
	 * Set the value of [address] column.
	 * 
	 * @param      string $v new value
	 * @return     PhotographerRegion The current object (for fluent API support)
	 */
	public function setAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = PhotographerRegionPeer::ADDRESS;
		}

		return $this;
	} // setAddress()

	/**
	 * Set the value of [latitude] column.
	 * 
	 * @param      string $v new value
	 * @return     PhotographerRegion The current object (for fluent API support)
	 */
	public function setLatitude($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->latitude !== $v) {
			$this->latitude = $v;
			$this->modifiedColumns[] = PhotographerRegionPeer::LATITUDE;
		}

		return $this;
	} // setLatitude()

	/**
	 * Set the value of [longitude] column.
	 * 
	 * @param      string $v new value
	 * @return     PhotographerRegion The current object (for fluent API support)
	 */
	public function setLongitude($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->longitude !== $v) {
			$this->longitude = $v;
			$this->modifiedColumns[] = PhotographerRegionPeer::LONGITUDE;
		}

		return $this;
	} // setLongitude()

	/**
	 * Set the value of [x] column.
	 * 
	 * @param      string $v new value
	 * @return     PhotographerRegion The current object (for fluent API support)
	 */
	public function setX($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->x !== $v) {
			$this->x = $v;
			$this->modifiedColumns[] = PhotographerRegionPeer::X;
		}

		return $this;
	} // setX()

	/**
	 * Set the value of [y] column.
	 * 
	 * @param      string $v new value
	 * @return     PhotographerRegion The current object (for fluent API support)
	 */
	public function setY($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->y !== $v) {
			$this->y = $v;
			$this->modifiedColumns[] = PhotographerRegionPeer::Y;
		}

		return $this;
	} // setY()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->photographer_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->address = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->latitude = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->longitude = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->x = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->y = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = PhotographerRegionPeer::NUM_COLUMNS - PhotographerRegionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PhotographerRegion object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aPhotographer !== null && $this->photographer_id !== $this->aPhotographer->getId()) {
			$this->aPhotographer = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PhotographerRegionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PhotographerRegionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aPhotographer = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePhotographerRegion:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PhotographerRegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PhotographerRegionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePhotographerRegion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePhotographerRegion:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PhotographerRegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePhotographerRegion:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PhotographerRegionPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aPhotographer !== null) {
				if ($this->aPhotographer->isModified() || $this->aPhotographer->isNew()) {
					$affectedRows += $this->aPhotographer->save($con);
				}
				$this->setPhotographer($this->aPhotographer);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = PhotographerRegionPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PhotographerRegionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PhotographerRegionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aPhotographer !== null) {
				if (!$this->aPhotographer->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPhotographer->getValidationFailures());
				}
			}


			if (($retval = PhotographerRegionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PhotographerRegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPhotographerId();
				break;
			case 2:
				return $this->getAddress();
				break;
			case 3:
				return $this->getLatitude();
				break;
			case 4:
				return $this->getLongitude();
				break;
			case 5:
				return $this->getX();
				break;
			case 6:
				return $this->getY();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PhotographerRegionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPhotographerId(),
			$keys[2] => $this->getAddress(),
			$keys[3] => $this->getLatitude(),
			$keys[4] => $this->getLongitude(),
			$keys[5] => $this->getX(),
			$keys[6] => $this->getY(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PhotographerRegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPhotographerId($value);
				break;
			case 2:
				$this->setAddress($value);
				break;
			case 3:
				$this->setLatitude($value);
				break;
			case 4:
				$this->setLongitude($value);
				break;
			case 5:
				$this->setX($value);
				break;
			case 6:
				$this->setY($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PhotographerRegionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPhotographerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAddress($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLatitude($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLongitude($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setX($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setY($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PhotographerRegionPeer::DATABASE_NAME);

		if ($this->isColumnModified(PhotographerRegionPeer::ID)) $criteria->add(PhotographerRegionPeer::ID, $this->id);
		if ($this->isColumnModified(PhotographerRegionPeer::PHOTOGRAPHER_ID)) $criteria->add(PhotographerRegionPeer::PHOTOGRAPHER_ID, $this->photographer_id);
		if ($this->isColumnModified(PhotographerRegionPeer::ADDRESS)) $criteria->add(PhotographerRegionPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(PhotographerRegionPeer::LATITUDE)) $criteria->add(PhotographerRegionPeer::LATITUDE, $this->latitude);
		if ($this->isColumnModified(PhotographerRegionPeer::LONGITUDE)) $criteria->add(PhotographerRegionPeer::LONGITUDE, $this->longitude);
		if ($this->isColumnModified(PhotographerRegionPeer::X)) $criteria->add(PhotographerRegionPeer::X, $this->x);
		if ($this->isColumnModified(PhotographerRegionPeer::Y)) $criteria->add(PhotographerRegionPeer::Y, $this->y);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PhotographerRegionPeer::DATABASE_NAME);

		$criteria->add(PhotographerRegionPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PhotographerRegion (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPhotographerId($this->photographer_id);

		$copyObj->setAddress($this->address);

		$copyObj->setLatitude($this->latitude);

		$copyObj->setLongitude($this->longitude);

		$copyObj->setX($this->x);

		$copyObj->setY($this->y);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     PhotographerRegion Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     PhotographerRegionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PhotographerRegionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Photographer object.
	 *
	 * @param      Photographer $v
	 * @return     PhotographerRegion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPhotographer(Photographer $v = null)
	{
		if ($v === null) {
			$this->setPhotographerId(NULL);
		} else {
			$this->setPhotographerId($v->getId());
		}

		$this->aPhotographer = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Photographer object, it will not be re-added.
		if ($v !== null) {
			$v->addPhotographerRegion($this);
		}

		return $this;
	}


	/**
	 * Get the associated Photographer object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Photographer The associated Photographer object.
	 * @throws     PropelException
	 */
	public function getPhotographer(PropelPDO $con = null)
	{
		if ($this->aPhotographer === null && ($this->photographer_id !== null)) {
			$c = new Criteria(PhotographerPeer::DATABASE_NAME);
			$c->add(PhotographerPeer::ID, $this->photographer_id);
			$this->aPhotographer = PhotographerPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aPhotographer->addPhotographerRegions($this);
			 */
		}
		return $this->aPhotographer;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aPhotographer = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePhotographerRegion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePhotographerRegion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasePhotographerRegion
