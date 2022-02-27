@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <form action="{{route('update-product-db')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$value->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                    <div class="form-group my-3">
                            <label>รูปสินค้า</label>
                            <img src="{{asset($value->picture)}}" id="blah" class="cover my-3 mx-auto" style="max-height: 200px;">
                            <input type="hidden" name="old_picture" value="{{$value->picture}}">
                            <input type="file" class="form-control" id="imgInp" name="picture">
                        </div>
                        @error('picture')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="productname" required placeholder="กรอกชื่อสินค้า" value="{{$value->productname}}">
                        </div>
                        @error('productname')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>รายละเอียด</label>
                            <textarea type="text" class="form-control" name="description" required placeholder="กรอกรายละเอียดสินค้า">{{$value->description}}</textarea>
                        </div>
                        @error('description')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>ราคา</label>
                            <input type="number" class="form-control" name="price" required placeholder="กรอกราคาสินค้า" value="{{$value->price}}">
                        </div>
                        @error('price')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>จำนวน</label>
                            <input type="number" class="form-control" name="amount" required placeholder="กรอกจำนวนสินค้า" value="{{$value->amount}}">
                        </div>
                        @error('amount')
                            <span class="text-danger text-sm">{{$message}}</span>
                        @enderror
                        <div class="form-group my-3">
                            <label>ประเภทสินค้า</label>
                            <select class="form-control" required name="type_name">
                                <option value="">กรุณาระบุประเภทสินค้า</option>
                                @foreach($type as $o_type)
                                    <option value="{{$o_type->id}}"<?=$value->type_name == $o_type->id?'selected':''?> >{{$o_type->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
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
