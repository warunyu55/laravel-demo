<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\typeProduct;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $value = Product::where('status','1')->get();
        $count = count($value);
        $type = typeProduct::all();
        return view('shop',compact('type','value','count'));
    }

    public function category($name){
        $value = Product::join('type_products','products.type_name','=','type_products.id')
        ->where('type_products.type_name',$name)
        ->where('products.status','1')->get(['*','products.id AS id']);
        $count = count($value);
        $type = typeProduct::all();
        return view('shop',compact('type','value','count'));
    }

    public function product($id){
        $value = Product::find($id);
        return view('product',compact('value'));
    }

    public function search(Request $request){
        $value = Product::where('productname','like','%'.$request->search.'%')->where('status','1')->get();
        $count = count($value);
        $type = typeProduct::all();
        return view('shop',compact('type','value','count'));
    }

}
