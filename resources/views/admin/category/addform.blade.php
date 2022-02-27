@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <form action="{{route('add-category-db')}}" method="post">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="form-group my-3">
                            <label>ชื่อประเภทสินค้า</label>
                            <input type="text" class="form-control" name="type_name" required placeholder="กรอกชื่อประเภทสินค้า">
                        </div>
                        @error('type_name')
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
