<?php

class Project extends BaseProject
{
  public function __toString(){
    return $this->getName();
  }
}
