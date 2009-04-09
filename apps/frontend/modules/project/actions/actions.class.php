<?php

/**
 * project actions.
 *
 * @package    projectmanager
 * @subpackage project
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class projectActions extends PMActions
{
  
	public function executeAutocomplete(sfWebRequest $request){
		$q = $request->getParameter("q");
		$this->renderText(json_encode(ProjectPeer::getNamesForAutocomplete($q)));
		
		return sfView::NONE;
	}
	
	public function executeCreate(sfWebRequest $request){
		$name = $request->getParameter("name");
		
		if(strlen($name) > 1 && strlen($name) < 45){
		  $p = new Project();
		  $p->setName($name);
		  $p->save();
		}else{
			$this->forward404("The project name is to long!");
		}
		
		$this->executeList($request);
		$this->setLayout("list");
	}
	
	public function executeList(sfWebRequest $request){
		$this->page = $request->getParameter("page");
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn(ProjectPeer::NAME);
    $this->pager = new sfPropelPager ( "Project", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
	}
	
  public function executeView(sfWebRequest $request){
  	 
  	$this->project = $this->getRoute()->getObject();
  	$c = new Criteria();
  	$c->add(JobPeer::PROJECT_ID, $this->project->getId());
  	
  	$this->getPager($c, array("route" => "project_view", 
                              "slugOn" => "slug", 
                              "slug" => $this->project->getSlug()));
    
  }
  
}
