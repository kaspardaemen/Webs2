<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model {

    public $timestamps = false;

    protected $table = 'product';

    public static function featured(){
        return  DB::table('product')->where('isfeatured','=','1')->get();
    }
}
