@extends('layouts.default')
@section('content')
<div class="container page-padding pt-5">
    <div class="card mt-3">
        <div class="card-body px-5">
            <h2 class="text-center"><b>เข้าสู่ระบบ</b></h2>
            <p class="text-center">ยังไม่ได้เป็นสมาชิก? <a href="{{route('register')}}" class="underline text-dark" ><b>สมัครสมาชิก</b></a> </p>
            <form action="{{route('c-login')}}" method="post">
                @csrf
                <div class="form-group my-3">
                    <label>อีเมล <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required placeholder="กรุณากรอกอีเมล">
                </div>
                <div class="form-group my-3">
                    <label>รหัสผ่าน <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" required placeholder="กรุณากรอกรหัสผ่าน">
                </div>
                @if(session('notice'))
                <span class="text-danger text-sm">{{session('notice')}}</span>
                @endif
                <div class="text-center my-3">
                    <button class="btn btn-dark">เข้าสู่ระบบ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
<script>sweetslocation("{{session('success')}}","{{session('location')}}")</script>
@endif
@endsection