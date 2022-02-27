@extends('layouts.default')
@section('content')

<div class="container-fluid">
<div class="my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-muted text-xs"><a href="/" class="breadcrumb-a">หน้าหลัก</a></li>
            <li class="breadcrumb-item text-muted text-xs"><a href="{{route('shop')}}" class="breadcrumb-a">ร้านค้า</a></li>
            <li class="breadcrumb-item text-muted text-xs">{{$value->productname}}</li>
        </ol>
    </nav>
</div>
    <div class="row">
        <div class="col-12 col-md-8">
            <img src="{{asset($value->picture)}}" class="col-12 col-md-8 mx-auto p-5" style="object-fit: cover">
        </div>
        <div class="col-12 col-md-4">
            <div class="mt-5">
                <h4>{{$value->productname}}</h4>
                @if($value->amount != 0)
                    <p class="float-end text-success">มีสินค้าในคลัง</p>
                @else
                    <p class="float-end text-danger">สินค้าหมด</p>
                @endif
                <b>฿{{number_format($value->price)}}</b>
            </div>
            <hr class="text-muted">
            <form method="post" action="{{route('add-cart')}}">
                @csrf
                <input type="hidden" name="product_id" value="{{$value->id}}">
                <div class=" mb-2">
                    <label>จำนวน</label>
                    <input type="number" class="form-control" min="0" max="{{$value->amount}}" name="amount" value="1">
                </div>
                <br>
                @if($value->amount != 0)
                    @if(session('email') != '')
                    <button type="submit" class="btn btn-dark col-12">เพิ่มในตะกร้า</button>
                    @else
                    <a href="{{route('login')}}" class="btn btn-dark col-12">กรุณาเข้าสู่ระบบ</a>
                    @endif
                @else
                    <button class="btn btn-dark col-12" disabled>สินค้าหมด</button>
                @endif
            </form>
            <hr class="text-muted">
            <h6><b>ข้อมูลสินค้า</b></h6>
            <p>{{$value->description}}</p>
        </div>
    </div>
</div>
@if(session('success'))
<script>sweets("{{session('success')}}")</script>
@endif
@if(session('fail'))
<script>sweetsfail("{{session('fail')}}")</script>
@endif
@endsection