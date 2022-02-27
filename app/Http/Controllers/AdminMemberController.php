<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;

class AdminMemberController extends Controller
{
    public function index(){
        $value = member::all();
        return view('admin.member.index',compact('value'));
    }
}
