<?php

/**
 * tag actions.
 *
 * @package    projectmanager
 * @subpackage tag
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class tagActions extends PMActions 
{
	
  public function executeList(sfWebRequest $request)
  {
  	$this->tag = $this->getRoute()->getObject();
    $ids = TaggingPeer::getJobIdsByTag($this->tag);
    $c = new Criteria();
    $c->add(JobPeer::ID, $ids, Criteria::IN);
    
    $this->getPager($c, array("route" => "job_listby_tag", 
                              "slugOn" => "slug", 
                              "slug" => $this->tag->getSlug()));
  }

  public function executeAutocomplete(sfWebRequest $request){
    $this->renderText(json_encode(TaggingPeer::getNamesForAutocomplete($request->getParameter("q"))));
    return sfView::NONE;
  }
  
}
