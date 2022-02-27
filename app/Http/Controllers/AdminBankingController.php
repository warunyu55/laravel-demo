<?php

namespace App\Http\Controllers;

use App\Models\Banking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBankingController extends Controller
{
    //
    public function index(){
        $value = Banking::all();
        return view('admin.banking.index',compact('value'));
    }

    public function addform(){
        return view('admin.banking.addform');
    }

    public function add(Request $request){
        $request->validate([
            'bank_picture' => 'mimes:jpg,png,jpeg',
            'bank_name'=>'max:255|unique:bankings',
            'account_name'=>'max:255',
            'account_number'=>'max:13'
        ],[
            'bank_picture.mimes'=>'กรุณาใส่รูปภาพที่มีนามสกุลเป็น .jpg , .png , .jpeg',
            'bank_name.max'=>'กรุณาระบุตัวอักษรไม่เกิน 255 ตัวอักษร',
            'bank_name.unique'=>'มีชื่อธนาคารนี้อยู่แล้ว',
            'account_name.max'=>'กรุณาระบุตัวอักษรไม่เกิน 255 ตัวอักษร',
            'account_number.max'=>'กรุณาระบุตัวอักษรไม่เกิน 13 ตัวอักษร'
        ]);
        $image = $request->file('bank_picture');
        $n_gen = hexdec(uniqid());
        $image_ext = $image->getClientOriginalExtension();
        $new_name = $n_gen.'.'.$image_ext;
        $upload_location = 'image/banking/';
        $fullname = $upload_location.$new_name;
        $image->move($upload_location,$new_name);
        Banking::create([
            'bank_picture'=>$fullname,
            'bank_name'=>$request->bank_name,
            'account_name'=>$request->account_name,
            'account_number'=>$request->account_number
        ]);
        return redirect()->back()->with(['success'=>'เพิ่มบัญชีธนาคารเรียบร้อยแล้ว','location'=>'/admin/banking']);
    }

    public function editform($id){
        $value = Banking::find($id);
        return view('admin.banking.editform',compact('value'));
    }

    public function update(Request $request){
        $request->validate([
            'bank_picture' => 'mimes:jpg,png,jpeg',
            'bank_name'=>['max:255',Rule::unique('bankings')->ignore($request->id)],
            'account_name'=>'max:255',
            'account_number'=>'max:13'
        ],[
            'bank_picture.mimes'=>'กรุณาใส่รูปภาพที่มีนามสกุลเป็น .jpg , .png , .jpeg',
            'bank_name.max'=>'กรุณาระบุตัวอักษรไม่เกิน 255 ตัวอักษร',
            'bank_name.unique'=>'มีชื่อธนาคารนี้อยู่แล้ว',
            'account_name.max'=>'กรุณาระบุตัวอักษรไม่เกิน 255 ตัวอักษร',
            'account_number.max'=>'กรุณาระบุตัวอักษรไม่เกิน 13 ตัวอักษร'
        ]);
        $fullname = $request->old_picture;
        if(!empty($request->bank_picture)){
            $image = $request->file('bank_picture');
            $n_gen = hexdec(uniqid());
            $image_ext = $image->getClientOriginalExtension();
            $new_name = $n_gen.'.'.$image_ext;
            $upload_location = 'image/banking/';
            $fullname = $upload_location.$new_name;
            $image->move($upload_location,$new_name); 
            unlink($request->old_picture);
        }
        Banking::where('id',$request->id)->update([
            'bank_picture'=>$fullname,
            'bank_name'=>$request->bank_name,
            'account_name'=>$request->account_name,
            'account_number'=>$request->account_number
        ]);
        return redirect()->back()->with(['success'=>'อัปเดตบัญชีธนาคารเรียบร้อยแล้ว','location'=>'/admin/banking']);
    }
    public function delete($id){
        $value = Banking::find($id);
        $image = $value->bank_picture;
        unlink($image);
        $value->forceDelete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }
}
