<?php

class Photographer extends BasePhotographer
{
   public function __toString(){
   	  return $this->getName();
   }

}
