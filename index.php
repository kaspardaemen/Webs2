<?php
	//session_start();
        
        # Start session
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], FALSE, TRUE);
        session_name("current_user");
        session_start();
        session_regenerate_id(true);

	# CONFIG	
	require_once("config.php");
		
	# LOAD CORE
	foreach(glob("core/*.php") as $filename)
	{
		require_once($filename);
	}
	
	# LOAD MODELS
	foreach(glob("mvc/model/*.php") as $filename)
	{
		require_once($filename);
	}
	
	# SETUP DB
	$db = new Database($settings);
	
	# PARSE URL
	$url = new Url();
	$controller = $url->getController();
	$view = $url->getView();
	
	# SETUP PAGE
	$validator = new Validation();
	$page = new Page($controller, $view);
	
	#LOAD CONTROLLER/VIEW
	require_once("mvc/controller/SharedController.php");
	require_once("mvc/controller/".$page->getController()."Controller.php");
	$test = new SharedController();

	$controllerFileName = $page->getController()."Controller";
	$controllerObject = new $controllerFileName();
	$view = $page->getView();
	$viewPostMethod = $view."_Post";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(method_exists($controllerObject, $viewPostMethod))
		{
			$data = $controllerObject->$viewPostMethod();
		}
		else
		{
			$data = $controllerObject->$view();	
		}
	}
	else
	{
		$data = $controllerObject->$view();
	}
	
	# BUILD PAGE
	$page->display();

?>
