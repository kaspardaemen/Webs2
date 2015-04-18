<?php

class MenuModel {

	private $menuTable;

	public function getMainMenu()
	{
		$table = $this->getAll();
		$parents = array();
		foreach($table as $row)
		{
			if(!isset($row["parent"]))
			{
				$row["children"] = $this->getChildren($row["id"]);
				$parents[] = $row;
			}
		}
		return $parents;
	}

	public function getChildren($parent)
	{
		$table = $this->getAll();

		$children = array();
		foreach ($table as $row) {
			if (isset($row["parent"])) {
				if($row["parent"] == $parent){
					$children[] = $row;
				}
			}
		}
		if(!empty($children))
		{
			return $children;
		}
		return null;
	}

	public function getSubMenus()
	{
		$table = $this->getAll();
		$subs = array();
		foreach($table as $row)
		{

			if(isset($row["parent"]))
			{
				$subs["".$row["parent"]] = $row;
			}
		}
		return $subs;
	}

	public function getAll()
	{
		if(!isset($this->menuTable)) {
			global $db;

			$sql = "SELECT a.*, b.*
					FROM menu AS a
					LEFT JOIN url AS b
					ON a.url = b.id
					ORDER BY a.parent ASC, a.order";

			$query = $db->prepare($sql);
			$query->execute();
			$this->menuTable = $query->fetchAll();
		}
		return $this->menuTable;
	}

}

?>