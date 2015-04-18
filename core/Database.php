<?php

class Database extends PDO 
{
    public function __construct($config)
    {
	parent::__construct('mysql:host='.$config["db_host"].';dbname='.$config["db_name"].';port='.$config["db_port"], $config["db_user"], $config["db_pass"]);
	$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }	
}
