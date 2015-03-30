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
        return view('main', $this->navigate('login'));
    }
    public function home(){
        $this->navigate('home');
        return view('main', $this->navigate('login'));
    }

    public function navigate($page){
        $this->page = $page;
        return  $data = ['page' => $this->page];

    }

    /*
     * DB FUNCTIONS
     */
    function isFeatured(){
        $result =  Product::Where('isfeatured','=', '1')->get();
        return $result;
    }

}
