<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function check(Request $request){
        $request->validate([
            'email'=>'max:255',
            'password'=>'max:255'
        ],[
            'email.max' => 'ใส่ตัวอักษรไม่เกิน 255 ตัว',
            'password' => 'ใส่ตัวอักษรไม่เกิน 255 ตัว'
        ]);

        foreach(member::all() as $member){
            if($request->email == $member->email){
                if(Hash::check($request->password,$member->password)){
                    session(['email'=>$request->email,'type'=>'member','id'=>$member->id]);
                   return redirect()->back()->with(['success'=>'เข้าสู่ระบบเรียบร้อยแล้ว','location'=>'/']);
                }
            }
        }
        return redirect()->back()->with('notice','อีเมลหรือรหัสผ่านไม่ถูกต้อง');
    }
    public function logout(){
        session()->forget((['email','type','id']));
        return redirect()->route('login');
    }
}
