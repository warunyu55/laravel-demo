<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\member;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function add(Request $request){
        $request->validate([
            'firstname'=>'max:255',
            'lastname'=>'max:255',
            'phone'=>'regex:/(0)[0-9]{9}/|numeric',
            'email'=>'max:255|unique:members',
            'password'=> 'max:255',
            'confirm-password'=>'same:password'
        ],[
            'firstname.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'lastname.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'phone.regex'=>'กรุณาระบุเบอร์โทรศัพท์ให้ถูกต้อง',
            'phone.numeric'=>'กรุณาระบุเป็นตัวเลข',
            'email.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'email.unique'=>'email นี้มีผู้ใช้งานแล้ว',
            'password.max'=>'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'confirm-password.same'=>'รหัสผ่านไม่ตรงกันกรุณากรอใหม่'
        ]);
        member::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return redirect()->route('register')->with(['success'=>'สมัครสมาชิกเรียบร้อยแล้ว','location'=>'/login']);
    }
}
