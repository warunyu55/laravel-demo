@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
       @include('sidebarprofile')
       <div class="col-md-10 col-12 my-2">
                <div class="card">
                    <div class="card-header"><h4 class="text-center"><b>เปลี่ยนรหัสผ่าน</b></h4></div>
                    <div class="card-body">
                        <form action="/profile/password/update" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$value->id}}">
                            <div class="form-group my-2">
                                <label>รหัสผ่านเดิม <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="o_password"  required>
                            </div>
                            @error('o_password')
                                <span class="text-danger text-xs">{{$message}}</span>
                            @enderror
                            <div class="form-group my-2">
                                <label>รหัสผ่านใหม่ <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="n_password"  required>
                            </div>
                            @error('n_password')
                                <span class="text-danger text-xs">{{$message}}</span>
                            @enderror
                            <div class="form-group my-2">
                                <label>ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="c_password"  required>
                            </div>
                            @error('c_password')
                                <span class="text-danger text-xs">{{$message}}</span>
                            @enderror
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