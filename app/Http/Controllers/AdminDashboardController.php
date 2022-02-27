<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(){
        $c_product = count(Product::all());
        $c_member = count(member::all());
        $c_order = count(Order::all());
        $date = Carbon::now();
        $jan = count(Order::whereMonth('created_at','1')->whereYear('created_at',$date->year)->get());
        $feb = count(Order::whereMonth('created_at','2')->whereYear('created_at',$date->year)->get());
        $march = count(Order::whereMonth('created_at','3')->whereYear('created_at',$date->year)->get());
        $april = count(Order::whereMonth('created_at','4')->whereYear('created_at',$date->year)->get());
        $may = count(Order::whereMonth('created_at','5')->whereYear('created_at',$date->year)->get());
        $jun = count(Order::whereMonth('created_at','6')->whereYear('created_at',$date->year)->get());
        $july = count(Order::whereMonth('created_at','7')->whereYear('created_at',$date->year)->get());
        $aug = count(Order::whereMonth('created_at','8')->whereYear('created_at',$date->year)->get());
        $sep = count(Order::whereMonth('created_at','9')->whereYear('created_at',$date->year)->get());
        $oct = count(Order::whereMonth('created_at','10')->whereYear('created_at',$date->year)->get());
        $nov = count(Order::whereMonth('created_at','11')->whereYear('created_at',$date->year)->get());
        $dec = count(Order::whereMonth('created_at','12')->whereYear('created_at',$date->year)->get());
        return view('admin.dashboard',compact('c_product','c_member','c_order','jan','feb','march','april','may','jun','july','aug','sep','oct','nov','dec'));
    }
}
