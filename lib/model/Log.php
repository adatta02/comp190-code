<?php

class Log extends BaseLog
{

	 public function save(PropelPDO $con = null)
  {
  	$this->setSfGuardUserProfileId( 1 );
  	parent::save( $con );
  }
	
}
