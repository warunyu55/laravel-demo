<?php

namespace App\Http\Controllers;

use App\Models\typeProduct;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
class AdminCategoryController extends Controller
{
    public function index(){
        $value = typeProduct::all();
        return view('admin.category.index',compact('value'));
    }
    public function addform(){
        return view('admin.category.addform');
    }

    public function add(Request $request){
        $request->validate([
            'type_name'=>'max:255|unique:type_products'
        ],[
            'type_name.max'=>"ใส่ตัวอักษรไม่เกิน 255 ตัว",
            'type_name.unique'=>"มีชื่อประเภทสินค้านี้อยู่แล้ว",
        ]);
        typeProduct::create([
            'type_name'=>$request->type_name
        ]);
        return redirect()->back()->with(['success'=>'เพิ่มข้อมูลประเภทสินค้าเรียบร้อยแล้ว','location'=>'/admin/category']);
    }
    
    public function editform($id){
        $value = typeProduct::find($id);
        return view('admin.category.editform',compact('value'));
    }

    public function update(Request $request){
        $request->validate([
            'type_name'=>['max:255',Rule::unique('type_products')->ignore($request->id)]
        ],[
            'type_name.max'=>"ใส่ตัวอักษรไม่เกิน 255 ตัว",
            'type_name.unique'=>"มีชื่อประเภทสินค้านี้อยู่แล้ว",
        ]);
        typeProduct::where('id',$request->id)->update([
            'type_name' => $request->type_name
        ]);
        return redirect()->back()->with(['success'=>'อัปเดตข้อมูลประเภทสินค้าเรียบร้อยแล้ว','location'=>'/admin/category']);
    }
    public function delete($id){
        typeProduct::find($id)->forceDelete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }
}
