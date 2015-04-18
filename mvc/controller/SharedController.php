<?php
class SharedController 
{

	public function __construct()
	{
		$menuModel = new MenuModel();
		$GLOBALS['mainmenu'] = $menuModel->getMainMenu();
	}

}

?>