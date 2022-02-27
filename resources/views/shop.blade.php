@extends('layouts.default')
@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-12 col-md-2 my-2">
        <h4 class="text-center"><b>หมวดหมู่สินค้า</b></h4>
        <hr>
            <div class="d-flex flex-column ">
                    <ul class="nav flex-column">
                    @foreach($type as $type_row)
                        <li class="nav-item">
                            <a href="/shop/{{$type_row->type_name}}" class="nav-link text-dark" style="text-decoration:none">{{$type_row->type_name}}</a>
                        </li>
                        <hr class="text-muted">
                    @endforeach
                    </ul>
            </div>
        </div>
        <div class="col-12 col-md-10 my-2">
            <div class="text-muted float-end">
                <p>สินค้าทั้งหมด {{$count}} รายการ</p>
            </div>
            <h4><b>Shopping</b></h4>
            <hr>
            @if($value->isNotEmpty())
            <div class="row">
            @foreach ($value as $row)
            <div class="col-6 col-md-3 my-2">
                <a href="/shop/product/{{$row->id}}">
                    <img src="{{asset($row->picture)}}" class="cover mx-auto">
                </a>
                <div class="text-center my-2">
                    <p class="text-dot" style="width: 100%;">{{$row->productname}}</p>
                    <p>฿{{number_format($row->price)}}</p>
                </div>
            </div>
            @endforeach
            </div>
            @else
                <div class="my-5">
                    <h4 class="text-center"><b>ไม่พบรายการสินค้าที่ค้นหา</b></h4>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection