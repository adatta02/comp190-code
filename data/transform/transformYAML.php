<?php
error_reporting(E_ALL);
include_once "../../config/ProjectConfiguration.class.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
$sfContext = sfContext::createInstance($configuration);
$sfContext->dispatch();

$jm = new Jm2Transform();
$jm->transformPhotographers();
// $jm->transformProjects();
// $jm->transformJobs();

class Jm2Transform{
  
	private $projectKeys;
	private $jobKeys;
	private $photogKeys;
	
	public function transformPhotographers(){
		$this->photogKeys = array();
		$arr = sfYaml::load("photogs.yml");
		
		$total = count($arr);
		$count = 1;
		
		
		foreach($arr as $i){
			$user = new SfGuardUser();
			$user->setUsername($i["email"]);
			$user->setPassword("admin");
			$user->setAlgorithm("sha1");
      $user->save();
			
      $profile = new SfGuardUserProfile();
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
		
		  $this->photogKeys[$i["id"]] = $ph->getId();
		}
		
	}
	
  public function transformProjects(){
  	
  	$this->projectKeys = array();
  	
    $fileData = file_get_contents("projects.yml");
    $arr = sfYaml::load($fileData);

    foreach($arr as $i){
    	
    	$p = new Project();
    	$p->setName($i["name"]);
    	
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
  		$statusHash[$s->getStatus()] = $s->getId();
  	}
  	
  	$this->jobKeys = array();
  	$dom = DOMDocument::load("jobs.xml");
  	$jobs = $dom->getElementsByTagName("jobs");
  	
  	$total = $jobs->length;
  	$count = 1;
  	
  	foreach($jobs as $job){

  	  echo $count . "/" . $total . "\n";	
  		
  		$j = new Job();
  		$jid = 1;
  		$startTime = "";
  		$endTime = "";
  		$notes = "";
  		
  		$childNodes = $job->childNodes;
  		
  		foreach($childNodes as $child){
  			switch( $child->nodeName ){
  				case "id"; $jid = 1; break;
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
  		$j->save();
  		$this->jobKeys[$jid] = $j->getId();
  	
  	  $count += 1;
  	}
  	
  }
  
}


?>