<?php

class Url {
	
	private $controller, $view;
	private static $urlTable, $path, $parts;

	public function __construct()
	{
		$this->parse();
	}
	
	public function getController()
	{
		return $this->controller;
	}
	
	public function getView()
	{
		return $this->view;	
	}

	public static function getRoot()
	{
		global $settings;
		$protocol = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		return $protocol . $_SERVER["HTTP_HOST"] . $settings['path'];
	}
			
	public static function currentUrl()
	{
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;	
	}

	public static function currentPath()
	{
		return self::$path;
	}

	public static function getPart($index)
	{
		return self::$parts[$index];
	}

	public static function create($path, $controller, $view, $parameters = array())
	{
		global $db;

		if(!self::getByPath($path)) {

			$parameter = "";
			foreach($parameters as $key=>$value)
			{
				$parameter .= ",".$key.":".$value;
			}

			$sql = "INSERT INTO url (path, controller, view, parameter)
					VALUES (:Path, :Controller, :View, :Parameter)";

			$query = $db->prepare($sql);
			$query->bindParam(':Path', $path, PDO::PARAM_STR);
			$query->bindParam(':Controller', $controller, PDO::PARAM_STR);
			$query->bindParam(':View', $view, PDO::PARAM_STR);
			$query->bindParam(':Parameter', substr($parameter,1), PDO::PARAM_STR);
			$query->execute();
			return true;
		}
		return false;
	}
	
	public static function build($controller, $view, $parameters = array())
	{
		global $settings;

		// build db url
		/*
		$table = self::getUrlTable();

		foreach($table as $row)
		{
			if($row["controller"] != $controller || $row["view"] != $view)
			{
				continue;
			}


		}*/

		// build local url
		if(count($parameters) < 1)
		{
			if($controller == "Home" && $view == "Index")
			{
				return $settings['path']."/";
			}
			if($view == "Index")
			{
				return $settings['path']."/" . $controller;
			}
			return $settings['path']."/" . $controller . "/" . $view;
		}	
		return $settings['path']."/" . $controller . "/" . $view . "/" . Url::getParameterPath($parameters);
	}
	
	private static function getParameterPath($parameters)
	{
		$count = 0;
		$path = "";
		foreach($parameters as $key => $value)
		{
			if($key == "id")
			{
				if(count($parameters) > 1)
				{
					$path = $value."/".$path;
				}
				else
				{
					$path = $value;	
				}
				continue;
			}
			if($count == 0)
			{
				$path .= "?".$key."=".$value;
				$count++;
				continue;
			}
			$path .= "&".$key."=".$value;
		}
		return $path;
	}

	private static function getUrlTable()
	{
		if(!isset(self::$urlTable))
		{
			global $db;
			$sql = "SELECT *
				FROM url";
			$query = $db->prepare($sql);
			$query->execute();
			self::$urlTable = $query->fetchAll();
		}
		return self::$urlTable;
	}

	private static function getByPath($path)
	{
		$table = self::getUrlTable();

		foreach($table as $row)
		{
			if($row["path"] == $path)
			{
				return $row;
			}
		}
		return false;
	}

	private function checkUrlTable($path)
	{
		$result = self::getByPath($path);
		if($result)
		{
			$this->controller = $result["controller"];
			$this->view = $result["view"];
			if(!empty($result["parameter"])) {
				$parameterSets = explode(",", $result["parameter"]);
				foreach ($parameterSets as $ps) {
					$psa = explode(":", $ps);
					$_GET[$psa[0]] = $psa[1];
				}
			}
			return true;
		}
		return false;
	}
	
	private function parse()
	{
		global $settings;
		$url = parse_url($this->currentUrl());
		$path = str_replace($settings['path'], "", $url['path']);
		self::$path = $path;
		self::$parts = explode("/", substr($path,1));

		// check if url exists in DB
		if($this->checkUrlTable($path))
		{
			return;
		}

		// check local url
		if($path == "/")
		{
			$this->controller = "Home";
			$this->view = "Index";
			return;
		}	
		if(count(self::$parts) == 1)
		{
			if(self::$parts[0] == "Home")
			{
				$this->setError();
				return;	
			}
			$this->controller = self::$parts[0];
			$this->view = "Index";
			return;
		}
		if(count(self::$parts) == 2)
		{
			if(self::$parts[1] == "Index")
			{
				$this->setError();
				return;	
			}
			$this->controller = self::$parts[0];
			$this->view = self::$parts[1];
			return;
		}
		if(count(self::$parts) == 3)
		{
			$this->controller = self::$parts[0];
			$this->view = self::$parts[1];
			$_GET['id'] = self::$parts[2];
			return;
		}
	}
	
	public function setError()
	{		
		$this->controller = "Home";	
		$this->view = "Error404";	
	}
	
}


?>