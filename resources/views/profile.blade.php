@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
       @include('sidebarprofile')
        <div class="col-md-10 col-12 my-2">
            <div class="card">
                <div class="card-header"><h4 class="text-center"><b>ข้อมูลบัญชีผู้ใช้</b></h4></div>
                <div class="card-body">
                    <form action="/profile/update" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label>ชื่อ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="firstname" value="{{$value->firstname}}" required>
                                </div>
                                @error('firstname')
                                    <span class="text-danger text-xs">{{$message}}</span>
                                @enderror
                                <div class="form-group my-2">
                                    <label>โทรศัพท์ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" value="0{{$value->phone}}" minlength="10" maxlength="10" required>
                                </div>
                                @error('phone')
                                    <span class="text-danger text-xs">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label>นามสกุล <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="lastname" value="{{$value->lastname}}" required>
                                </div>
                                @error('lastname')
                                    <span class="text-danger text-xs">{{$message}}</span>
                                @enderror
                                <div class="form-group my-2">
                                    <label>อีเมล <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{$value->email}}" required>
                                </div>
                                @error('email')
                                    <span class="text-danger text-xs">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="btn btn-dark col-12 col-md-3" type="submit">ตกลง</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
<script>sweets("{{session('success')}}")</script>
@endif
@endsection