<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function index(){
        $value = Order::leftJoin('members','orders.o_member_id','=','members.id')->get(['*','orders.id AS o_id']);
        return view('admin.order.index',compact('value'));
    }

    public function view($id){
        $value = Order::leftJoin('members','orders.o_member_id','=','members.id')->
        leftJoin('memberaddresses','members.id','=','memberaddresses.a_member_id')->
        leftJoin('thailand_province','memberaddresses.tambon_id','=','thailand_province.id')->
        leftJoin('bankings','orders.o_bank_id','=','bankings.id')->
        where('orders.id',$id)->where('a_status',1)->get(['*','orders.id AS o_id','orders.created_at AS date']);
        foreach($value as $row){
            $data = $row;
        }
        $p_id = json_decode($data->o_product_id);
        $amount = json_decode($data->o_amount);
        for($i=0;count($p_id)>$i;$i++){
            $product[] = Product::find($p_id[$i]);
        }
        return view('admin.order.view',compact('data','product','amount'));
    }

    public function confirm($id){
        Order::where('id',$id)->update([
            'o_status' =>2
        ]);
        return redirect()->back()->with(['success'=>'ยืนยันการชำระเงินเรียบร้อยแล้ว','location'=>'/admin/order']);
    }

    public function cancel($id){
        $data = Order::find($id);
        $product = json_decode($data->o_product_id);
        $amount = json_decode($data->o_amount);
        for($i=0;count($product)>$i;$i++){
            $stock = Product::find($product[$i]);
            $return = $amount[$i]+$stock->amount;
            Product::where('id',$product[$i])->update([
                'amount'=>$return
            ]);
        }
        Order::where('id',$id)->update([
            'o_status' =>3
        ]);
        return redirect()->back()->with(['success'=>'ยกเลิกรายการนี้เรียบร้อยแล้ว','location'=>'/admin/order']);
    }
    
    public function delete($id){
        Order::find($id)->forceDelete();
        return redirect()->route('admin_order');
    }
}
