<?php

class Page {
	
	private $layout, $theme, $controller, $view;
	
	public function __construct($controller, $view)
	{
		$this->layout = "default";	
		$this->theme = "default";
		$this->controller =  $controller;	
		$this->view = $view;	
		$this->validate();
	}
	
	public function getLayout()
	{
		return $this->layout;
	}
	
	public function setLayout($name)
	{
		$this->layout = $name;	
	}
	
	public function getTheme()
	{
		return $this->theme;
	}
	
	public function setTheme($name)
	{
		$this->theme = $name;	
	}
	
	public function getController()
	{
		return $this->controller;
	}
	
	public function getView()
	{
		return $this->view;
	}

	public function getTitle()
	{
		global $settings, $data;
		return str_replace("[subtitle]", $data["title"], $settings['title']);
	}
	
	public function part($part)
	{
		global $page, $data, $validator;
		switch($part)
		{
			case "view":
				return require("mvc/view/".$this->controller."/".$this->view.".php");
			default:
				return require("mvc/view/_shared/partials/".$part.".php");
		}
	}
	
	public function display()
	{	
		global $page, $data, $validator;
		return require_once("mvc/view/_shared/".$this->layout.".php");
	}
	
	public function setError()
	{		
		$this->controller = "Home";	
		$this->view = "Error404";	
	}
	
	public function validate()
	{
		if (file_exists("mvc/controller/".$this->controller."Controller.php"))
		{
			if (file_exists("mvc/view/".$this->controller."/".$this->view.".php"))
			{
				return true;
			}
		}
		$this->setError();
		return false;
	}
	
}

?>