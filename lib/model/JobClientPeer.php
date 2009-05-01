<?php

class JobClientPeer extends BaseJobClientPeer
{
	
	private static $clientJobIdCache = array();
	
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
	
	public static function isOwner($jobId, $userId){
		
		$c = new Criteria();
		$c->add(ClientPeer::USER_ID, $userId);
		$client = ClientPeer::doSelectOne($c);
		
		if(is_null($client)){
			return false;
		}
		$cid = $client->getId();
		
		if(!array_key_exists($cid, self::$clientJobIdCache)){
			self::$clientJobIdCache[$cid] = array();
			self::$clientJobIdCache[$cid] = self::getJobsByClientId($cid);
		}
		
		return in_array($jobId, self::$clientJobIdCache[$cid]);
	}
}
