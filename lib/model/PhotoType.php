<?php

class PhotoType extends BasePhotoType
{
   public function __toString(){
          return $this->getName();
   }    


}
