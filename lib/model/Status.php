<?php

class Status extends BaseStatus
{
	public function __toString(){
		return $this->getState();
	}
}
