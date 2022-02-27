<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\typeProduct;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class AdminProductController extends Controller
{
    public function index(){
        $value = Product::all();
        return view('admin.product.index',compact('value'));
    }
    
    public function addform(){
        $type = typeProduct::all();
        return view('admin.product.addform',compact('type'));
    }

    public function add(Request $request){
        $request->validate([
            'picture'=>'mimes:jpg,png,jpeg',
            'productname'=>'max:255|unique:products',
            'price'=>'numeric',
            'amount'=>'numeric'
        ],[
            'picture.mimes'=>'กรุณาใส่รูปภาพที่มีนามสกุลเป็น .jpg , .png , .jpeg',
            'productname.max'=>'ระบุตัวอักษรไม่เกิน 255 ตัวอักษร',
            'productname.unique'=>'มีชื่อสินค้านี้อยู่แล้ว',
            'price.numeric'=>'กรุณาระบุเป็นตัวเลข',
            'amount.numeric'=>'กรุณาระบุเป็นตัวเลข'
        ]);
        $image = $request->file('picture');
        $n_gen = hexdec(uniqid());
        $image_ext = $image->getClientOriginalExtension();
        $new_name = $n_gen.".".$image_ext;
        $upload_location ='image/product/';
        $fullname = $upload_location.$new_name;
        $image->move($upload_location,$new_name);
        Product::create([
            'picture'=>$fullname,
            'productname'=>$request->productname,
            'description'=>$request->description,
            'price'=>$request->price,
            'amount'=>$request->amount,
            'type_name'=>$request->type_name,
            'status'=>0
        ]);
        return redirect()->back()->with(['success'=>'เพิ่มรายการสินค้าเรียบร้อยแล้ว','location'=>'/admin/product']);
    }

    public function status(Request $request){
        Product::where('id',$request->id)->update([
            'status' => $request->status, 
        ]);
        if($request->status == 1){
            $note = array("เปิดใช้งานรายการสินค้านี้แล้ว","/admin/product");
        }else{
            $note = array("ปิดใช้งานรายการสินค้านี้แล้ว","/admin/product");
        }
        return $note;
    }
    
    public function editform($id){
        $value = Product::find($id);
        $type = typeProduct::all();
        return view('admin.product.editform',compact('value','type'));
    }

    public function update(Request $request){
        $request->validate([ 
            'picture'=>'mimes:jpg,png,jpeg',
            'productname'=>['max:255',Rule::unique('products')->ignore($request->id)],
            'price'=>'numeric',
            'amount'=>'numeric'
        ],[
            'picture.mimes'=>'กรุณาใส่รูปภาพที่มีนามสกุลเป็น .jpg , .png , .jpeg',
            'productname.max'=>'ระบุตัวอักษรไม่เกิน 255 ตัวอักษร',
            'productname.unique'=>'มีชื่อสินค้านี้อยู่แล้ว',
            'price.numeric'=>'กรุณาระบุเป็นตัวเลข',
            'amount.numeric'=>'กรุณาระบุเป็นตัวเลข'
        ]);
        $fullname = $request->old_picture;
        if($request->picture != ''){
            $image = $request->file('picture');
            $n_gen = hexdec(uniqid());
            $image_ext = $image->getClientOriginalExtension();
            $new_name = $n_gen.'.'.$image_ext;
            $upload_location = 'image/product/';
            $fullname = $upload_location.$new_name;
            $image->move($upload_location,$new_name);
            unlink($request->old_picture);
        }
        Product::where('id',$request->id)->update([
            'picture'=>$fullname,
            'productname'=>$request->productname,
            'description'=>$request->description,
            'price'=>$request->price,
            'amount'=>$request->amount,
            'type_name'=>$request->type_name
        ]);
        return redirect()->back()->with(['success'=>'อัปเดตข้อมูลสินค้านี้เรียบร้อยแล้ว','location'=>'/admin/product']);
    }

    public function delete($id){
        $value = Product::find($id);
        $image = $value->picture;
        $value->forcedelete();
        unlink($image);
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }

}
