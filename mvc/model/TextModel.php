<?php

class TextModel {
		
	public function getHomeText()
	{
		global $db;
	
		$sql = "SELECT text 
			FROM text
			WHERE title = 'Wijkraad Home'
			LIMIT 1";
	
		$query = $db->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function getTextById($id)
	{
		global $db;
	
		$sql = "SELECT text
			FROM text
			WHERE id = $id";
	
		$query = $db->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
}
?>