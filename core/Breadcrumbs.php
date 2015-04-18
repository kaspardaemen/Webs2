<?php

class Breadcrumbs 
{
    private static $breadcrumbs;

    public static function add($label, $url)
    {
	if(!isset(self::$breadcrumbs)) 
        {
            self::$breadcrumbs = array();
	}
	self::$breadcrumbs[] = array("label"=>$label, "url"=>$url);
    }

    public static function getAll()
    {
	return self::$breadcrumbs;
    }	
}