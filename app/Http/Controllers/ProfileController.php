<?php

namespace App\Http\Controllers;

use App\Models\Banking;
use App\Models\member;
use App\Models\Memberaddress;
use App\Models\Order;
use App\Models\Product;
use App\Rules\Checkpassword;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index(){
        $value = member::find(session('id'));
        return view('profile',compact('value'));
    }

    public function update(Request $request){
        $request->validate([
            'firstname'=>'max:255',
            'lastname'=>'max:255',
            'phone'=>'max:10|regex:/(0)[0-9]{9}/|',
            'email'=>['max:255'
            ,Rule::unique('members')->ignore(session('id'))],
        ],[
            'firstname.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'lastname.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'phone.max'=>'ระบุเบอร์ไม่เกิน 10 ตัว',
            'phone.regex'=>'กรุณาระบุเบอร์โทรศัพท์ให้ถูกต้อง',
            'phone.numeric'=>'กรุณาระบุเป็นตัวเลข',
            'email.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'email.unique'=>'email นี้มีผู้ใช้งานแล้ว',
        ]);
        member::where('id',$request->id)
                ->update([
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname,
                    'phone'=>$request->phone,
                    'email'=>$request->email
                ]);
        return redirect()->back()->with('success','อัปเดตข้อมูลเรียบร้อยแล้ว');
    }

    public function index_address(){
        $value = Memberaddress::leftJoin('thailand_province','Memberaddresses.tambon_id','=','thailand_province.id')->where('a_member_id',session('id'))->get(['*','memberaddresses.id as a_id']);
        return view('address',compact('value'));
    }
    
    public function address_add(){
        $value = DB::table('thailand_province')->groupBy('ProvinceThai')->get();
        return view('address-add',compact('value'));
    }

    public function add(Request $request){
        $status = 0;
        if($request->a_status != NULL){
            $status = $request->a_status;
            $address = Memberaddress::where('a_member_id',session('id'))->get();
            for($i = 0;count($address)>$i;$i++){
                Memberaddress::where('id',$address[$i]->id)->update([
                    'a_status'=>0
                ]);
            }
        }
        Memberaddress::create([
            'a_member_id'=>session('id'),
            'a_address'=>$request->a_address,
            'tambon_id'=>$request->tambon_id,
            'province_id'=>$request->province_id,
            'district_id'=>$request->district_id,
            'a_status'=>$status
        ]);
        return redirect()->back()->with(['success'=>'เพิ่มที่อยู่เรียบร้อยแล้ว','location'=>'/profile/address']);
    }

    public function address_edit($id){
        $id = $id;
        $old = Memberaddress::leftJoin('thailand_province','memberaddresses.tambon_id','=','thailand_province.id')->find($id);
        $province = DB::table('thailand_province')->groupBy('ProvinceThai')->get();
        $district = DB::table('thailand_province')->where('ProvinceID',$old->province_id)->groupBy('DistrictThai')->get();
        $tambon = DB::table('thailand_province')->where('DistrictID',$old->district_id)->get();
        return view('address-edit',compact('province','old','district','tambon','id'));
    }

    public function address_update(Request $request){
        $status = 0;
        if($request->a_status != NULL){
            $status = $request->a_status;
            $address = Memberaddress::where('a_member_id',session('id'))->whereNotIn('id',[$request->address_id])->get();
            for($i=0;count($address)>$i;$i++){
                Memberaddress::where('id',$address[$i]->id)->update([
                    'a_status' => 0
                ]);
            }
        }
        Memberaddress::where('id',$request->address_id)->update([
            'a_address'=>$request->a_address,
            'tambon_id'=>$request->tambon_id,
            'province_id'=>$request->province_id,
            'district_id'=>$request->district_id,
            'a_status'=>$status
        ]);
        return redirect()->back()->with(['success'=>'อัปเดตข้อมูลที่อยู่เรียบร้อยแล้ว','location'=>'/profile/address']);
    }

    public function delete($id){
        Memberaddress::find($id)->forceDelete();
        return redirect()->back()->with('success','ลบข้อมูลที่อยู่เรียบร้อยแล้ว');
    }

    public function ajaxprovince(Request $request){
        $value = DB::table('thailand_province')->where('ProvinceID',$request->provinceID)->groupBy('DistrictThai')->get(['id'=>"DistrictID",'name'=>"DistrictThai"]);
        $raw = json_decode($value);
        echo "<option value=''>กรุณาเลือกเขต/อำเภอ</option>";
        for($i = 0 ; count($raw)> $i ; $i++){
            echo "<option value='".$raw[$i]->DistrictID."'>".$raw[$i]->DistrictThai."</option>\n";
        }
    }

    public function ajaxdistrict(Request $request){
        $value = DB::table('thailand_province')->where('ProvinceID',$request->provinceID)->where('DistrictID',$request->districtID)->get(['id'=>"id",'name'=>"TambonThai"]);
        $raw = json_decode($value);
        echo "<option value=''>กรุณาเลือกแขวง/ตำบล</option>";
        for($i = 0 ; count($raw)> $i ; $i++){
            echo "<option value='".$raw[$i]->id."'>".$raw[$i]->TambonThai."</option>\n";
        }
    }

    public function ajaxtambon(Request $request){
        $value = DB::table('thailand_province')->where('ProvinceID',$request->provinceID)->where('DistrictID',$request->districtID)->where('id',$request->tambonID)->get('PostCodeMain');
        $raw = json_decode($value);
        foreach($raw as $row){
            echo $row->PostCodeMain;
        }
    }

    public function index_password(){
        $value = member::find(session('id'));
        return view('password',compact('value'));
    }

    public function password(Request $request){
        $request->validate([
            'o_password'=>['max:255',new Checkpassword],
            'n_password'=>'max:255',
            'c_password'=>'max:255|same:n_password',
        ],[
            'o_password.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'n_password.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'c_password.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'c_password.same'=>'รหัสผ่านไม่ตรงกันกรุณากรอกใหม่',
        ]);
        member::where('id',$request->id)
        ->update([
            'password'=>Hash::make($request->n_password)
        ]);
        return redirect()->back()->with('success','เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
    }

    public function index_order(){
        $value = Order::where('o_member_id',session('id'))->get();
        $x=0;
        $data[][]= '';
        $amount[][] = '';
        foreach($value as $row){
            for($i=0;count(json_decode($row->o_product_id))>$i;$i++){
                $product[$i] = json_decode($row->o_product_id)[$i];
                $data[$x][$i] = Product::find($product[$i]);
                $amount[$x][$i] = json_decode($row->o_amount)[$i];
            }
            $x++;
        }
        return view('order',compact('value','data','amount'));
    }

    public function index_payment(){
        $value = Order::where('o_member_id',session('id'))->where('o_status',0)->get();
        $bank = Banking::all();
        return view('payment',compact('value','bank'));
    }

    public function ajaxpaid(Request $request){
        $value = Order::where('id',$request->id)->get();
        foreach($value as $n){
            $paid = $n->o_total;
        }
        return compact('paid');
    }

    public function payment(Request $request){
        $request->validate([
            'o_payment'=>'mimes:jpg,png,jpeg'
        ],[
            'o_payment.mimes'=>'กรุณาใส่รูปภาพที่มีนามสกุลเป็น .jpg , .png , .jpeg'
        ]);
        $image = $request->file('o_payment');
        $n_gen = hexdec(uniqid());
        $image_ext = $image->getClientOriginalExtension();
        $new_name = $n_gen.'.'.$image_ext;
        $upload_location = 'image/payment/';
        $image->move($upload_location,$new_name);
        $fullname = $upload_location.$new_name;
        Order::where('id',$request->order_id)->update([
            'o_bank_id'=>$request->banking_id,
            'o_status'=>1,
            'o_payment'=>$fullname
        ]);
        return redirect()->back()->with('success','แจ้งการชำระเงินเรียบร้อยแล้ว');
    }
}
