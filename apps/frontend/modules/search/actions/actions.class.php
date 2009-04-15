<?php

/**
 * search actions.
 *
 * @package    projectmanager
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class searchActions extends PMActions 
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeJob(sfWebRequest $request)
  {
    $this->searchBox = $request->getParameter("search-box");
    $c = JobPeer::executeSearch($this->searchBox);
    
    $this->getPager($c, array("route" => "job_search", 
                              "slugOn" => "search-box", 
                              "slug" => $this->searchBox));
  }

  public function executeAdvanced(sfWebRequest $request)
  {
  	$this->form = new AdvancedSearchForm();
  	
  	if($request->isMethod("POST")){
      $this->form->bind($request->getParameter($this->form->getName()), 
      					$request->getFiles($this->form->getName()));
      					
     $dueDateStart = $request->getParameter($this->form->getName() . "[due_date_start]");
     $dueDateEnd = $request->getParameter($this->form->getName() . "[due_date_end]");
  	}
  	
  }
  
}
