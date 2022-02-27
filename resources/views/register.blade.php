@extends('layouts.default')
@section('content')

<div class="container page-padding">
    <div class="card mt-3">
        <div class="card-body px-5">
        <h2 class="text-center"><b>สมัครสมาชิก</b></h2>
        <p class="text-center">หากเป็นสมาชิกแล้ว <a href="{{route('login')}}" class="text-dark"><b>เข้าสู่ระบบ</b></a></p>
            <form action="{{route('add-register')}}" method="post">
                @csrf
                <div class="form-group my-3">
                    <label>ชื่อ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="firstname" placeholder="กรุณากรอกชื่อ" required>
                    @error('firstname')
                    <span class="text-danger text-xs">{{$message}} </span>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label>นามสกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="lastname" placeholder="กรุณากรอกนามสกุล" required>
                    @error('lastname')
                    <span class="text-danger text-xs">{{$message}} </span>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label>โทรศัพท์ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="กรุณากรอกโทรศัพท์" required >
                    @error('phone')
                    <span class="text-danger text-xs">{{$message}} </span>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label>อีเมล <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="กรุณากรอกอีเมล" required>
                    @error('email')
                    <span class="text-danger text-xs">{{$message}} </span>
                    @enderror
                </div>                
                <div class="form-group my-3">
                    <label>รหัสผ่าน <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
                    @error('password')
                    <span class="text-danger text-xs">{{$message}} </span>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label>ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="confirm-password" placeholder="กรุณากรอกยืนยันรหัสผ่าน" required>
                    @error('confirm-password')
                    <span class="text-danger text-xs">{{$message}} </span>
                    @enderror
                </div>
                <div class="text-center my-3">
                    <button class="btn btn-dark">สมัครสมาชิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
    <script>sweetslocation("{{session('success')}}","{{session('location')}}")</script>
@endif
@endsection