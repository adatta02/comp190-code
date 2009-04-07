<?php
error_reporting(E_ALL);
include_once "../../config/ProjectConfiguration.class.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
$sfContext = sfContext::createInstance($configuration);
$sfContext->dispatch();

$jm = new Jm2Transform();
$jm->transformPhotographers();
$jm->transformJobsProjects();
$jm->transformProjects();
$jm->transformJobs();

class Jm2Transform{
  
	private $projectKeys;
	private $jobKeys;
	private $photogKeys;
  private $jobProjectKeys;
  	
	public function transformJobsProjects(){
		$this->jobProjectKeys = array();
		
		$arr = sfYaml::load("jobs_projects.yml");
		
		foreach($arr as $i){
			$this->jobProjectKeys[$i["job_id"]] = $i["project_id"];
		}
		
	}
	
	public function transformPhotographers(){
		$this->photogKeys = array();
		$arr = sfYaml::load("photogs.yml");
		
		$total = count($arr);
		$count = 1;
		
		foreach($arr as $i){
			$user = new sfGuardUser();
			$user->setUsername($i["email"]);
			$user->setPassword("admin");
			$user->setAlgorithm("sha1");
      $user->save();
			
      $profile = new sfGuardUserProfile();
      $profile->setUserId($user->getId());
      $profile->setUserTypeId(3);
      $profile->save();
      
      $ph = new Photographer();
      $ph->setUserId($profile->getId());
      $ph->setName($i["name"]);
      $ph->setPhone($i["phone"]);
      $ph->setEmail($i["email"]);
      $ph->setAffiliation($i["affiliation"]);
      $ph->save();
      
      echo $count . "/" . $total . "\n";
      $count += 1;
		
		  $this->photogKeys[$i["photog_id"]] = $ph->getId();
		}
		
	}
	
  public function transformProjects(){
  	
  	$this->projectKeys = array();
  	
    $fileData = file_get_contents("projects.yml");
    $arr = sfYaml::load($fileData);

    foreach($arr as $i){
    	
    	$p = new Project();
    	$p->setName($i["desc"]);
    	
    	if($i["active"]){
    		$p->setStatusId(2);
    	}else{
    		$p->setStatusId(7);
    	}
    	
    	$p->save();
    	
    	$this->projectKeys[$i["id"]] = $p->getId();
    }
  }
  
  public function transformJobs(){
  	
  	$statusHash = array();
  	$statusObjects = StatusPeer::doSelect(new Criteria());
  	
  	foreach($statusObjects as $s){
  		$statusHash[$s->getState()] = $s->getId();
  	}
  	
  	$this->jobKeys = array();
  	$dom = DOMDocument::load("jobs.xml");
  	$jobs = $dom->getElementsByTagName("jobs");
  	
  	$total = $jobs->length;
  	$count = 1;
  	
  	foreach($jobs as $job){

  	  echo $count . "/" . $total . "\n";	
  		
  		$j = new Job();
  		$del = new Delivery();
  		
  		$jid = 1;
  		$startTime = "";
  		$endTime = "";
  		$notes = "";
  		$photog = 0;
  		$slug = "";
  		
  		$childNodes = $job->childNodes;
  		
  		foreach($childNodes as $child){
  			switch( $child->nodeName ){
  				case "id"; $jid = $child->textContent; break;
  				case "shoot_name": $j->setEvent($child->textContent); break;
  				case "shoot_date": $j->setDate($child->textContent); break;
  				case "shoot_startT": $startTime = $child->textContent; break;
  				case "shoot_endT": $endTime = $child->textContent; break;
  				case "shoot_duedate": $j->setDueDate($child->textContent); break;
  				case "submitted_at": $j->setCreatedAt($child->textContent); break;
  				case "requester_address": $j->setStreet($child->textContent); break;
  				case "requester_campus":  $j->setCity($child->textContent); break;
  				case "requester_name": $j->setContactName($child->textContent); break;
  				case "requester_email": $j->setContactEmail($child->textContent); break;
  				case "requester_phone": $j->setContactPhone($child->textContent); break;
  				case "internal_notes": $notes .= $child->textContent . "<br/>"; break;
  				case "billing_notes": $notes .= $child->textContent . "<br/>"; break;
  				case "estimate": $j->setEstimate($child->textContent); break;
  				case "billing_acctnum": $j->setAcctNum($child->textContent); break;
  				case "billing_deptid": $j->setDeptId($child->textContent); break;
  				case "billing_grantid": $j->setGrantId($child->textContent); break;
  				case "shoot_directions": $j->setOther($child->textContent); break;
  				case "status": $j->setStatusId($statusHash[$child->textContent]); break;
  				case "photog_id": $photog = $child->textContent; break;
  				case "delivery_pubname": $del->setPubName($child->textContent); break;
  				case "delivery_pubtype": $del->setPubType($child->textContent); break;
  				case "delivery_other": $del->setOther($child->textContent); break;
  				case "delivery_format": break;
  				case "delivery_color": $del->setColor($child->textContent); break;
  				case "delivery_format": $del->setFormat($child->textContent); break;
  				case "delivery_size": $del->setSize($child->textContent); break;
  				case "delivery_method": $del->setMethod($child->textContent); break;
  				case "delivery_special": $del->setInstructions($child->textContent); break;
  				case "slug": $slug = $child->textContent; break;
  				case "#text":
  				  default: break;
  			}
  		}
  		
  	  if($j->getCity() == "Boston"){
  	   $j->setZip("02101");
      }else{
       $j->setZip("02155");
      }
  		
      $j->setNotes($notes);
  		$j->setState("Massachusetts");
  		$j->setEndTime($j->getDate() . " " . $endTime);
  		$j->setStartTime($j->getDate() . " " . $startTime);
  		$j->addTag($slug);
      
  		if(isset($this->jobProjectKeys[$jid])){
  		  $j->setProjectId($this->projectKeys[$this->jobProjectKeys[$jid]]);
  		}
  		
  		try{
  		  $j->save();
  		}catch(Exception $ex){
  			echo $ex->getMessage();
  			$j->setProjectId(NULL);
  			$j->save();
  		}
  		
  		$this->jobKeys[$jid] = $j->getId();
  		
  	  if($photog){
        $jp = new JobPhotographer();
        $jp->setPhotographerId( $this->photogKeys[$photog] );
        $jp->setJobId($j->getId());
        try{ $jp->save(); } catch(Exception $ex){ echo $ex->getMessage(); }
      }
  		
  		$del->setJobId($j->getId());
  		$del->save();
  		
  		// add the requester as a client
  		$c = new Criteria();
  		$c->add(sfGuardUserPeer::USERNAME, $j->getContactEmail());
  		if(ClientPeer::doCount($c) == 0){
  			$user = new sfGuardUser();
  			$user->setUsername($j->getContactEmail());
  			$user->setPassword("admin");
  			$user->save();
  			
  			$userProfile = new sfGuardUserProfile();
  			$userProfile->setUserId($user->getId());
  			$userProfile->setUserTypeId(sfConfig::get("app_user_type_client"));
  			$userProfile->save();
  			
  			$clientProfile = new Client();
  			$clientProfile->setUserId($userProfile->getId());
  			$clientProfile->setName($j->getContactName());
  			$clientProfile->setEmail($j->getContactEmail());
  			$clientProfile->setPhone($j->getContactPhone());
  			$clientProfile->save();
  			
  			$jobClient = new JobClient();
  			$jobClient->setClientId($clientProfile->getId());
  			$jobClient->setJobId($j->getId());
  			$jobClient->save();
  			
  		}
  		
  	  $count += 1;
  	}
  	
  }
  
}


?>