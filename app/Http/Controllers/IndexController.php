<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\typeProduct;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $value = Product::where('status','1')->orderBy('created_at','desc')->limit(4)->get();
        $type = typeProduct::all();
        return view('index',compact('value','type'));
    }
}
