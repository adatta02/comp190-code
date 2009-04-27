<?php

/**
 * project actions.
 *
 * @package    projectmanager
 * @subpackage project
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class jobActions extends PMActions {
	
	private function reloadByClient($clientId) {
		$c = new Criteria ( );
		$this->routeObject = ClientPeer::retrieveByPK ( $clientId );
		
		$ids = JobClientPeer::getJobsByClientId ( $this->routeObject->getId () );
		$c->add ( JobPeer::ID, $ids, Criteria::IN );
		
		$this->route = "client_view_jobs";
		$this->propelType = "slug";
		$this->renderStatus = true;
		$this->viewingCaption = " jobs owned by " . $this->routeObject->getName ();
		
		return $c;
	}
	
	private function reloadByPhotographer($photographerId) {
		$c = new Criteria ( );
		$this->routeObject = PhotographerPeer::retrieveByPK ( $photographerId );
		
		$ids = JobPhotographerPeer::getJobsByPhotographerId ( $photographerId );
		$c->add ( JobPeer::ID, $ids, Criteria::IN );
		
		$this->route = "photographer_view_jobs";
		$this->propelType = "slug";
		$this->renderStatus = true;
		$this->viewingCaption = " jobs for " . $this->routeObject->getName ();
		
		return $c;
	}
	
	private function reloadByTag($tagId) {
		
		$c = new Criteria ( );
		$this->routeObject = TagPeer::retrieveByPK ( $tagId );
		
		$ids = TaggingPeer::getJobIdsByTag ( $this->routeObject );
		$c->add ( JobPeer::ID, $ids, Criteria::IN );
		
		$this->route = "job_listby_tag";
		$this->propelType = "name";
		$this->renderStatus = true;
		$this->viewingCaption = " taggings for " . $this->routeObject->__toString ();
		
		return $c;
	}
	
	private function reloadByState($stateId) {
		$c = new Criteria ( );
		$c->add ( JobPeer::STATUS_ID, $stateId );
		
		$this->routeObject = StatusPeer::retrieveByPK ( $stateId );
		$this->route = "job_list_by";
		$this->propelType = "state";
		$this->renderStatus = false;
		$this->viewingCaption = $this->routeObject->__toString ();
		
		return $c;
	}
	
	private function reloadByProject($projectId) {
		
		$c = new Criteria ( );
		$c->add ( JobPeer::PROJECT_ID, $projectId );
		
		$this->routeObject = ProjectPeer::retrieveByPK ( $projectId );
		$this->route = "project_view";
		$this->propelType = "project";
		$this->renderStatus = true;
		$this->viewingCaption = " project " . $this->routeObject->__toString ();
		
		return $c;
	}
	
	private function reloadBySearch($searchQuery) {
		
		$c = new Criteria ( );
		$ids = JobPeer::executeSearch ( $searchQuery );
		$c->add ( JobPeer::ID, $ids, Criteria::IN );
		
		$this->routeObject = $searchQuery;
		$this->route = "job_search";
		$this->propelType = "search-box";
		$this->renderStatus = true;
		$this->viewingCaption = " results for " . $this->routeObject->__toString ();
		
		return $c;
	}
	
	private function reloadByAdvancedSearch($params) {
		
		parse_str ( $params, $obj );
		
		$arr = array ();
		$obj = $obj ["advancedsearch"];
		
		$page = $obj ["page"];
		$arr ["jobStatus"] = $obj ["status_id"];
		$arr ["dueDateStart"] = $this->getFormattedDate ( $obj ["due_date_start"] );
		$arr ["dueDateEnd"] = $this->getFormattedDate ( $obj ["due_date_end"] );
		$arr ["shootDateStart"] = $this->getFormattedDate ( $obj ["shoot_date_start"] );
		$arr ["shootDateEnd"] = $this->getFormattedDate ( $obj ["shoot_date_end"] );
		$arr ["clientId"] = $obj ["client_id"];
		$arr ["photographerId"] = $obj ["photo_id"];
		$arr ["sortOn"] = $obj ["sort"];
		$arr ["sortDirection"] = $obj ["sort_direction"];
		
		$c = $this->createAdvancedSearchCriteria ( $arr );
		$pager = new sfPropelPager ( "Job", sfConfig::get ( "app_items_per_page" ) );
		$pager->setCriteria ( $c );
		$pager->setPage ( $page );
		$pager->setPeerMethod ( "doSelectJoinAll" );
		$pager->init ();
		$results = $pager->getResults ();
		sfPropelActAsTaggableBehavior::preloadTags ( $results );
		
		$this->renderPartial ( "search/advancedRender", array ("pager" => $pager ) );
		
		return sfView::NONE;
	}
	
	private function createCriteria($stateId = null, $routeArray = null) {
		
		if (is_null ( $stateId )) {
			$obj = json_decode ( $this->getRequest ()->getParameter ( "obj" ), true );
			$reloadFunction = $obj ["reloadFunction"];
			$reloadParam = $obj ["reloadParam"];
			
			if (! method_exists ( $this, $reloadFunction )) {
				$this->forward404 ( "Fatal Application Error!" );
			}
		
		} else {
			$reloadFunction = "reloadByState";
			$reloadParam = $stateId;
		}
		
		$c = $this->$reloadFunction ( $reloadParam );
		
		if ($c != sfView::NONE) {
			$this->getPager ( $c, $routeArray );
		} else {
			return sfView::NONE;
		}
	}
	
	public function executeEdit(sfWebRequest $request) {
		
		$job = JobPeer::retrieveByPK ( $request->getParameter ( "job_id" ) );
		$updating = $request->getParameter ( "form" );
		
		switch ($updating) {
			case "basic" :
				$form = new BasicInfoJobForm ( $job );
				$this->bindAndValidateForm ( $form, $request );
				$this->renderPartial ( "basicInfo", array ("job" => $job, "basicInfoForm" => $form ) );
				break;
			case "shoot" :
				$form = new ShootInfoJobForm ( $job );
				$this->bindAndValidateForm ( $form, $request );
				$job = JobPeer::retrieveByPK ( $request->getParameter ( "job_id" ) );
				$this->renderPartial ( "shootInfo", array ("job" => $job, "form" => $form ) );
				break;
			case "photography" :
				$form = new PhotographyInfoJobForm ( $job );
				$this->bindAndValidateForm ( $form, $request );
				$this->renderPartial ( "photographyInfo", array ("job" => $job, "form" => $form ) );
				break;
			case "billing" :
				$form = new BillingInfoJobForm ( $job );
				$this->bindAndValidateForm ( $form, $request );
				$this->renderPartial ( "billingInfo", array ("job" => $job, "form" => $form ) );
				break;
			
			case "internal" :
				$newVal = $request->getParameter ( "internal-edit" );
				$job->setNotes ( $newVal );
				$job->save ();
				$this->renderPartial ( "internalNotes", array ("job" => $job ) );
				break;
			default :
				break;
		}
		
		return sfView::NONE;
	}
	
	public function executeViewNotes(sfWebRequest $request) {
		$this->job = $this->getRoute ()->getObject ();
		
		$c = new Criteria ( );
		$c->add ( JobNotesPeer::JOB_ID, $this->job->getId () );
		$c->addDescendingOrderByColumn ( JobNotesPeer::ID );
		
		$this->pager = new sfPropelPager ( "JobNotes", sfConfig::get ( "app_items_per_page" ) );
		$this->pager->setCriteria ( $c );
		$this->pager->setPage ( $this->page );
		$this->pager->setPeerMethod ( "doSelectJoinAll" );
		$this->pager->init ();
	}
	
	public function executeDiffNotes(sfWebRequest $request) {
		
		$jobNoteDiff = JobNotesPeer::retrieveByPK ( $request->getParameter ( "noteDiffId" ) );
		$this->renderText ( $jobNoteDiff->getNotes () );
		
		return sfView::NONE;
	}
	
	public function executeViewHistory(sfWebRequest $request) {
		$this->job = $this->getRoute ()->getObject ();
		$this->getEditHistory ( $request->getParameter ( "page" ) );
		
		$this->renderPartial ( "logRender", array ("pager" => $this->logPager ) );
		return sfView::NONE;
	}
	
	public function executeEmail(sfWebRequest $request) {
		
		$to = "ckatz2009@gmail.com";
		$from = "From: alissalcooper@gmail.com";
		$subject = "Test2";
		$body = "Testing email";
		
		$sent = mail ( $to, $subject, $body, $from );
	
	}
	
	private function getEditHistory($page = 1) {
		$c = new Criteria ( );
		$c->add ( LogPeer::PROPEL_CLASS, "Job" );
		$c->add ( LogPeer::PROPEL_ID, $this->job->getId () );
		$c->addDescendingOrderByColumn ( LogPeer::WHEN );
		
		$this->logPager = new sfPropelPager ( "Log", sfConfig::get ( "app_items_per_page" ) );
		$this->logPager->setCriteria ( $c );
		$this->logPager->setPage ( 1 );
		$this->logPager->setPeerMethod ( "doSelectJoinAll" );
		$this->logPager->init ();
	}
	
	public function executeShow(sfWebRequest $request) {
		
		$this->job = $this->getRoute ()->getObject ();
		$this->basicInfoForm = new BasicInfoJobForm ( $this->job );
		$this->shootInfoForm = new ShootInfoJobForm ( $this->job );
		$this->photographyInfoForm = new PhotographyInfoJobForm ( $this->job );
		$this->billingInfoForm = new BillingInfoJobForm ( $this->job );
		
		$this->getEditHistory ( 1 );
	}
	
	private function bindAndValidateForm($form, $request) {
		$form->bind ( $request->getParameter ( $form->getName () ), $request->getFiles ( $form->getName () ) );
		if ($form->isValid ()) {
			$form->save ();
			return true;
		}
		return false;
	}
	
	public function executeInvoice(sfWebRequest $request) {
		sfLoader::loadHelpers ( array ("Asset", "Tag" ) );
		
		$job = $this->getRoute ()->getObject ();
		$pdf = new HTML2FPDF ( );
		
		$img = "<img src='http://photo.tufts.edu/images/tufts_logo_226x78.jpg'></a>";
		$date = date ( "F d, Y" );
		$jobId = $job->getId ();
		$publicationName = ($job->getPublicationId () ? $job->getPublication ()->getName () : "");
		$jobDate = ($job->getDate () ? $job->getDate ( "F d, Y" ) : "");
		$total = $job->getEstimate () + $job->getProcessing ();
		$clients = "";
		$photographers = "";
		
		foreach ( $job->getClients () as $i ) {
			$clients .= $i->getName () . "<br />";
			$clients .= $i->getDepartment () . "<br />";
			$clients .= $i->getAddress () . "<br />";
		
		}
		
		foreach ( $job->getPhotographers () as $i ) {
			$photographers .= $i->getName () . ", " . $i->getAffiliation () . "<br><br>";
		}
		
		$invoiceHTML = <<<EOF
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		  <head><title></title></head>
		  <body>
      <div style="width:600px;height:800px;">
        <p style="margin-left:50px; float: left;">
        {$img}
        </p>
        <p align="right" style="padding-right:50px;margin-top:-30px;font-family:arial;">
          <b>University Relations</b>
          <br><br>
          University Photography
       </p>  
      <div style="padding-left:20px;">
        <p>($date)</p>
        <p><b>INVOICE #{$jobId}</b></p>
        <p><b>Client (Bill to)</b></p>
        {$clients}
        <p><b>Job</b></p>
        <p>Job #{$jobId}<br>
           {$job->getEvent()}<br>  
           {$publicationName}<br>
        </p>
        <p>{$jobDate}<br>
          {$job->getStartTime()} - {$job->getEndTime()}<br>
          {$job->getPrettyAddress()}
        </p>
        <p><b>Charges</b></p>
        <p>{$photographers}</p>
        <p>
          Shoot Fee: \${$job->getEstimate()}<br>
          Processing: \${$job->getProcessing()}<br>
        </p>
        <b>TOTAL: \${$total}</b></div> 
  <div style="margin-top:75px;margin-left:10px;">
    <p style="font-family:arial; color:#cccccc;">
      80 George Street, Medford, MA 02155 | TEL: 617.627.3549 | FAX: 617.627.3549
    </p>
 </div>
</div>
</body>
</html>
EOF;
		
		// $this->renderText($invoiceHTML);
		$pdf->AddPage ();
		$pdf->WriteHTML ( $invoiceHTML );
		$pdf->Output ( "", "I" );
		
		return sfView::NONE;
	}
	
	public function executeAddPhotographer(sfWebRequest $request) {
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		$job = JobPeer::retrieveByPK ( $obj ["viewingJobId"] );
		$photographer = PhotographerPeer::retrieveByPK ( $obj ["photographerId"] );
		
		if (! is_null ( $job ) && ! is_null ( $photographer )) {
			$res = $job->addPhotographer ( $photographer );
		}
		
		$this->renderPartial ( "photographerList", array ("job" => $job ) );
		return sfView::NONE;
	}
	
	public function executeRemovePhotographer(sfWebRequest $request) {
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		$job = JobPeer::retrieveByPK ( $obj ["viewingJobId"] );
		$photographer = PhotographerPeer::retrieveByPK ( $obj ["photographerId"] );
		
		if (! is_null ( $job ) && ! is_null ( $photographer )) {
			$job->removePhotographer ( $photographer );
		}
		
		$this->renderPartial ( "photographerList", array ("job" => $job ) );
		return sfView::NONE;
	}
	
	public function executeAddClient(sfWebRequest $request) {
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		$client = ClientPeer::retrieveByPK ( $obj ["clientId"] );
		$job = JobPeer::retrieveByPK ( $obj ["viewingJobId"] );
		
		if (! is_null ( $client ) && ! is_null ( $job )) {
			$res = $job->addClient ( $client );
		}
		
		$this->renderPartial ( "clientList", array ("job" => $job ) );
		return sfView::NONE;
	}
	
	public function executeRemoveClient(sfWebRequest $request) {
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		$client = ClientPeer::retrieveByPK ( $obj ["clientId"] );
		$job = JobPeer::retrieveByPK ( $obj ["viewingJobId"] );
		
		if (! is_null ( $client ) && ! is_null ( $job )) {
			$job->removeClient ( $client );
		}
		
		$this->renderPartial ( "clientList", array ("job" => $job ) );
		return sfView::NONE;
	}
	
	public function executeAddProject(sfWebRequest $request) {
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		$jobs = $obj ["jobs"];
		
		$addProjectId = $obj ["addProjectId"];
		$projectName = $obj ["projectName"];
		$createNew = $obj ["createNew"];
		$removeFromProject = $obj ["removeFromProject"];
		
		if (! $removeFromProject) {
			
			if ($createNew) {
				$project = new Project ( );
				$project->setName ( $projectName );
				$project->save ();
			} else {
				$project = ProjectPeer::retrieveByPK ( $addProjectId );
			}
			
			$projectId = $project->getId ();
		
		} else {
			$projectId = null;
		}
		
		if ($removeFromProject || ! is_null ( $projectId )) {
			JobPeer::setJobProjectIds ( $jobs, $projectId );
		}
		
		$this->setTemplate ( "reload" );
		if ($this->createCriteria () == sfView::NONE)
			return sfView::NONE;
	}
	
	public function executeMove(sfWebRequest $request) {
		
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		$jobs = $obj ["jobs"];
		$toState = $obj ["state"];
		
		if ($toState < 1)
			return;
		
		JobPeer::setJobStateIds ( $jobs, $toState );
		
		$this->setTemplate ( "reload" );
		if ($this->createCriteria () == sfView::NONE)
			return sfView::NONE;
	}
	
	public function executeRemoveTag(sfWebRequest $request) {
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		
		$jobId = $obj ["jobId"];
		$tagVal = $obj ["tagVal"];
		$viewingJob = array_key_exists ( "viewingJob", $obj );
		
		$job = JobPeer::retrieveByPK ( $jobId );
		if (! is_null ( $job )) {
			$job->removeTag ( $tagVal );
			$job->save ();
		}
		
		if (! $viewingJob) {
			$this->setTemplate ( "reload" );
			if ($this->createCriteria () == sfView::NONE)
				return sfView::NONE;
		} else {
			$this->renderPartial ( "basicInfo", array ("job" => $job ) );
			return sfView::NONE;
		}
	
	}
	
	public function executeAddTag(sfWebRequest $request) {
		$obj = json_decode ( $request->getParameter ( "obj" ), true );
		
		$jobs = $obj ["jobs"];
		$tags = $obj ["tags"];
		$viewingJob = array_key_exists ( "viewingJob", $obj );
		
		$c = new Criteria ( );
		$c->add ( JobPeer::ID, $jobs, Criteria::IN );
		$jobs = JobPeer::doSelect ( $c );
		
		foreach ( $jobs as $j ) {
			$j->addTag ( $tags );
			$j->save ();
		}
		
		if (! $viewingJob) {
			$this->setTemplate ( "reload" );
			if ($this->createCriteria () == sfView::NONE)
				return sfView::NONE;
		} else {
			$job = $jobs [0];
			$this->renderPartial ( "basicInfo", array ("job" => $job ) );
			return sfView::NONE;
		}
	}
	
	/**
	 * The default landing for project manager.
	 * Lists all the active jobs.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeList(sfWebRequest $request) {
		
		if (! method_exists ( $this->getRoute (), "getObject" )) {
			$c = new Criteria ( );
			$c->add ( StatusPeer::ID, sfConfig::get ( "app_project_list_default_view", 1 ) );
			$showType = StatusPeer::doSelectOne ( $c );
		} else {
			$showType = $this->getRoute ()->getObject ();
		}
		
		$this->routeObject = $showType;
		$this->createCriteria ( $showType->getId (), array ("route" => "job_list_by", "slugOn" => "state", "slug" => $this->routeObject ) );
	}
	
	/**
	 * Executes the create action. 
	 * Displays a form to the user or deals with the save.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeCreate(sfWebRequest $request) {
		
		$this->isAdmin = $this->getUser ()->hasCredential ( "admin" );
		$this->form = new RequestJobForm ( );
		
		if ($request->isMethod ( "POST" )) {
			$this->processForm ( $request, $this->form );
		} else {
			
			if ($this->getUser ()->hasCredential ( "client" )) {
				$c = new Criteria ( );
				$c->add ( ClientPeer::USER_ID, $this->getUser ()->getProfile ()->getUserId () );
				$profile = ClientPeer::doSelectOne ( $c );
				
				if (! is_null ( $profile )) {
					$this->form->setDefault ( "name", $profile->getName () );
					$this->form->setDefault ( "department", $profile->getDepartment () );
					$this->form->setDefault ( "address", $profile->getAddress () );
					$this->form->setDefault ( "email", $profile->getEmail () );
					$this->form->setDefault ( "phone", $profile->getPhone () );
					$this->form->setDefault ( "clientId", $profile->getId () );
				}
			
			}
		
		}
	
	}
	
	/**
	 * Deals with processing and saving the form.
	 *
	 * @param sfWebRequest $request
	 * @param sfForm $form
	 */
	private function processForm(sfWebRequest $request, sfForm $form) {
		$form->bind ( $request->getParameter ( $form->getName () ), 
		              $request->getFiles ( $form->getName () ) );
		
		if ($form->isValid ()) {
			$form->save ();
			
			if ($this->getUser ()->hasCredential ( "admin" )) {
				$this->redirect ( "@job_list" );
			} else {
			  $this->redirect ( "@job_success" );
			}
			
		}
		
	}
	
	/**
	 * Present the user with a confirmation page. 
	 * Send an email maybe?
	 *
	 * @param sfWebRequest $request
	 */
	public function executeSuccess(sfWebRequest $request) {
		// if this user is a admin or client show a layout otherwise dont
		if (! $this->getUser ()->isAdminOrClient ())
			$this->setLayout ( "nomenu" );
	}
	
	public function executeAutocomplete(sfWebRequest $request) {
		$q = $request->getParameter ( "q" );
		$this->renderText ( json_encode ( JobPeer::getJobsForAutocomplete ( $q ) ) );
		return sfView::NONE;
	}

}
