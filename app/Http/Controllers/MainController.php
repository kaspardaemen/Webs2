<?php namespace App\Http\Controllers;

use App\Models\Product;

class MainController extends Controller {



    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $page;

    public function __construct()
    {
        $this->page = 'home';
    }


    public function index()
    {

        $data = ['products' => $this->isFeatured(), 'page' => $this->page];

        return view('main', $data );

    }

    /*
    * NAVIGATIONS FUNCTIONS
    */
    public function login(){
        $this->navigate('login');   
    }
    public function home(){
        $this->navigate('home');
    }

    public function navigate($page){
        $this->page = $page;
        $data = ['page' => $this->page];
        return view('main', $data );
    }

    /*
     * DB FUNCTIONS
     */
    function isFeatured(){
        $result =  Product::Where('isfeatured','=', '1')->get();
        return $result;
    }

}
