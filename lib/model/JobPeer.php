<?php

class JobPeer extends BaseJobPeer
{
	public static $LIST_VIEW_SORTABLE = array( JobPeer::ID => "Job Id", 
                                           JobPeer::DATE => "Date", 
                                           JobPeer::EVENT => "Event Name" );
}
