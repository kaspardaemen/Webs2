<?php namespace App\Http\Controllers;

use App\Models\Product;

class MainController extends Controller {



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function index()
    {
       //
        $data = ['products' => $this->isFeatured()];
        return view('main', $data );


    }

    function isFeatured(){
        $result =  Product::Where('isfeatured','=', '1')->get();
        return $result;
    }

}
