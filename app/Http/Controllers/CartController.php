<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Memberaddress;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function index(){
        $value = Cart::join('products','carts.product_id','=','products.id')
        ->join('members','carts.member_id','=','members.id')
        ->where('carts.member_id','=',session('id'))
        ->get(['*','carts.id AS c_id','products.id AS p_id']);
        // dd(session('id'));
        $sum = Cart::where('member_id',session('id'))->groupBy('member_id')->sum('c_total');
        $count = count($value);
        return view('cart',compact('value','count','sum'));
    }
    public function add(Request $request){
        $product = Product::find($request->product_id);
        $check = Cart::where('product_id',$request->product_id)->where('member_id',session('id'))->get();
        if($check->isEmpty()){
            $total = $request->amount * $product->price;
            Cart::create([
                'product_id'=>$request->product_id,
                'c_amount'=>$request->amount,
                'c_total'=>$total,
                'member_id'=>session('id')
            ]);
            return redirect()->back()->with('success','เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว');
        }else{
            return redirect()->back()->with('fail','มีรายการนี้อยู่ในตะกร้าแล้ว');
        }
    }
    public function delete($id){
        Cart::find($id)->forceDelete();
        return redirect()->back();
    }
    public function checkout(Request $request){
        for($i=0;count($request->cart_id) > $i ;$i++){
            $product_id[$i] = $request->o_product_id[$i];
            $amount[$i] = $request->o_amount[$i];
            $stock[$i] = Product::where('id',$product_id[$i])->get(['amount']);
            if($amount[$i] > $stock[$i][0]->amount){
                return redirect()->back()->with('fail','เกิดข้อผิดพลาด');
            }
        }
        $address = Memberaddress::where('a_member_id',session('id'))->where('a_status',1)->get();
        if($address->isEmpty()){
            return redirect()->back()->with('fail','กรุณาเพิ่มที่อยู่ของคุณ');
        }else{
            foreach($address as $row_address){
                $address_id = $row_address->id;
            }
        }
        $product_id = $request->o_product_id;
        $o_amount = $request->o_amount;
        Order::create([
            'o_total'=>$request->o_total,
            'o_member_id'=>$request->o_member_id,
            'o_address_id'=>$address_id,
            'o_status'=>0,
            'o_product_id'=>json_encode($product_id),
            'o_amount'=>json_encode($o_amount)
        ]);
        for($i=0;count($request->cart_id) > $i ;$i++){
            $data_amount = Product::find($product_id[$i]);
            $cut_stock = $data_amount->amount - $o_amount[$i];
            Product::where('id',$product_id[$i])->update([
                'amount'=>$cut_stock
            ]);
            Cart::find($request->cart_id[$i])->forceDelete();
        };
        return redirect()->route('order');
    }
}
