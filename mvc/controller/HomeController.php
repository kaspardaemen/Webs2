<?php
class HomeController 
{
    public function Index()
    {	
        $textModel = new TextModel();
	$data["title"] = "Welkom";
	$data["homeText"] = $textModel->getHomeText()[0];
	return $data;
    }
	
    public function Error404()
    {
	$data["title"] = "Pagina niet gevonden";
	return $data;
    }
}