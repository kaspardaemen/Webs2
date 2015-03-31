<?php namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller 
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            //$data = ['products' => $this->isFeatured()]; 

            //return view('home', $data);
	}
        
        public function home()
        {
           $data = ['products' => $this->isFeatured()]; 

            return view('home', $data);
        }
        
        /*
        * DB FUNCTIONS
        */
        function isFeatured(){
            $result =  Product::Where('isfeatured','=', '1')->get();
            return $result;
        }

}
