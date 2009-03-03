<?php

class Publication extends BasePublication
{
	public function __toString(){
		return $this->getName();
	}
}
