<?php

class Validation {
	
	private $messages;
	
	public function __construct()
	{
		$this->messages = array();
	}
	
	public function setMessage($key, $value)
	{
		$this->messages[$key] = $value;
	}
	
	public function displayFor($key)
	{
		if(isset($this->messages[$key]))
		{
			return $this->messages[$key];
		}
		return "";
	}
	
	public function isValid()
	{
		if(empty($this->messages))
		{
			return true;
		}
		return false;
	}
	
	
}


?>
