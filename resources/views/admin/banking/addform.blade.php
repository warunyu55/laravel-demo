@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <form action="{{route('add-banking-db')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group my-3">
                            <label>รูปธนาคาร</label>
                            <img src="{{asset('/image/default/default.jpg')}}" id="blah" class="cover my-3 mx-auto">
                            <input type="file" class="form-control" id="imgInp" name="bank_picture" required>
                        </div>
                        @error('bank_picture')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>ชื่อธนาคาร</label>
                            <input type="text" class="form-control" name="bank_name" required placeholder="กรอกชื่อธนาคาร">
                        </div>
                        @error('bank_name')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>ชื่อบัญชี</label>
                            <input type="text" class="form-control" name="account_name" required placeholder="กรอกชื่อบัญชี">
                        </div>
                        @error('account_name')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>เลขบัญชี</label>
                            <input type="text" pattern="[0-9]{3}[\-][0-9]{1}[\-][0-9]{5}[\-][0-9]{1}" class="form-control" maxlength="13"  name="account_number" required placeholder="กรอกเลขบัญชี">
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
<script>
imgInp.onchange = evt => {
const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}
</script>
@endsection
