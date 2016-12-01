<?php
class WelcomeMessage{
	private $_message;
	private $_name;
	private $_phrase;
	private $_hour;
	private $_hello;

	public function __construct(){
		$this->setMessage();
	}

	public function setHour(){
		$this->_hour=date('H');
	}

	public function setHello(){
		$this->setHour();

		if ($this->_hour > 21) {
			$this->_hello='Good night';
		}elseif($this->_hour > 18){
			$this->_hello="Good evening";
		}elseif($this->_hour > 13){
			$this->_hello="Good afternoon";
		}elseif($this->_hour > 10){
			$this->_hello="Hello";
		}else{
			$this->_hello="Good morning";
		}
	}

	public function setName(){
		$names=array("mother fucker", "son of a bitch", "dickhead", "bitch", "asshole", "bastard", "stupid", "idiot", "piece of shit", "my lord", "Master", "honey", "beautiful", "Mister", "baby", "sweetheart", "sexy", "prince charming", "angel of love", "movie star");
		$this->_name=$names[array_rand($names)];
	}

	public function setPhrase(){
		$phrases=array("I am happy to see you.","I dream of you tonight","you look hot !","you're cute.","go to hell !","I hate you !","I am jealous !");
		$this->_phrase=$phrases[array_rand($phrases)];
	}

	public function setMessage(){
		$this->setHello();
		$this->setName();
		$this->setPhrase();
		$this->_message=$this->_hello.' '.$this->_name.', '.$this->_phrase;
	}

	public function getMessage(){
		return $this->_message;
	}
}