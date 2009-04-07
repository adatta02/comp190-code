<?php

class JobClientPeer extends BaseJobClientPeer
{
	public static function getJobsByClientId($clientId){
		$c = new Criteria();
		$c->add(self::CLIENT_ID, $clientId);
		
		$obj = self::doSelect($c);
		$ids = array();
		foreach($obj as $j){
			$ids[] = $j->getJobId();
		}
		
		return $ids;
	}
}
