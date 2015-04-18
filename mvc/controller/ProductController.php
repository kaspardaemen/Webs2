<?php
class ProductController 
{
    private $model;
    
    public function __construct() 
    {        
        $this->model = new ProductModel();           
    }
    
    public function Index()
    {	
	$data["title"] = "Producten";
			
	return $data;
    }
    
    public function Add()
    {
        $data["title"] = "Product Toevoegen";
        
        return $data;
    }
    
    public function Add_Post()
    {
        $data = $this->Add();
        
        return $data;
    }
    
}

