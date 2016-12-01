<?php
class Disk{
	private $_pfull;
	private $_available;
	private $_busy;
	private $_color;

	public function __construct($partition){
		$this->setPfull($partition);
		$this->setAvailable($partition);
		$this->setBusy($partition);
		$this->setColor();
	}

	//getters
	public function getPfull(){
		return $this->_pfull;
	}
	public function getAvailable(){
		return $this->_available;
	}
	public function getBusy(){
		return $this->_busy;
	}
	public function getColor(){
		return $this->_color;
	}

	//setters
	public function setPfull($partition){
		$this->_pfull=shell_exec('df -h | grep "'.$partition.'$" | awk \'{print $5;}\' | head -c -2 ');
	}

	public function setAvailable($partition){
		$this->_available=shell_exec('df -h | grep "'.$partition.'$" | awk \'{print $4;}\'');
	}

	public function setBusy($partition){
		$this->_busy=shell_exec('df -h | grep "'.$partition.'$" | awk \'{print $3;}\'');
	}

	public function setColor(){
		if($this->_pfull < 75){
		    $this->_color='success';
		}

		if($this->_pfull >= 75){
		    $this->_color='danger';
		}

		if($this->_pfull >= 90){
		    $this->_color='primary';
		}
	}

	//methods
	public function exist(){
		if ($this->_pfull != ''){
			return true;
		}
		return false;
	}
}