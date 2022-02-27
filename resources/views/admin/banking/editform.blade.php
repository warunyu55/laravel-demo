@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <form action="{{route('update-banking-db')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$value->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group my-3">
                            <label>รูปธนาคาร</label>
                            <img src="{{asset($value->bank_picture)}}" id="blah" class="cover my-3 mx-auto">
                            <input type="hidden" name="old_picture" value="{{$value->bank_picture}}">
                            <input type="file" class="form-control" id="imgInp" name="bank_picture">
                        </div>
                        @error('bank_picture')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>ชื่อธนาคาร</label>
                            <input type="text" class="form-control" name="bank_name" required placeholder="กรอกชื่อธนาคาร" value="{{$value->bank_name}}">
                        </div>
                        @error('bank_name')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>ชื่อบัญชี</label>
                            <input type="text" class="form-control" name="account_name" required placeholder="กรอกชื่อบัญชี" value="{{$value->account_name}}">
                        </div>
                        @error('account_name')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>เลขบัญชี</label>
                            <input type="text" pattern="[0-9]{3}[\-][0-9]{1}[\-][0-9]{5}[\-][0-9]{1}" class="form-control" maxlength="13"  name="account_number" required placeholder="กรอกเลขบัญชี" value="{{$value->account_number}}">
                            <span class="text-xs text-danger">***รูปแบบ xxx-x-xxxxx-x***</span>
                        </div>
                        @error('account_number')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="text-center my-3">
                            <button class="btn btn-success" type="submit">ยืนยัน</button>
                            <button class="btn btn-danger" type="reset">ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
<script>sweetslocation("{{session('success')}}","{{session('location')}}")</script>
@endif
@endsection
