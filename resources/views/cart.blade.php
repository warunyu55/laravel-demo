@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="my-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-muted text-xs"><a href="/" class="breadcrumb-a">หน้าหลัก</a></li>
                <li class="breadcrumb-item text-muted text-xs">ตะกร้าสินค้า</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        @if($value->isNotEmpty())
        <div class="col-12 col-md-8 my-5">
            <div class="mb-4">
                <p class="float-end text-muted">{{$count}} รายการ</p>
                <h4><b>สินค้าในตะกร้า</b></h4>
            </div>
            <table class="table align-middle" style="border-color:transparent;">
                <tbody>
                    @foreach($value as $row)
                    <tr>
                        <td><img src="{{asset($row->picture)}}" class="cover mx-auto"></td>
                        <td><b>{{$row->productname}}</b></td>
                        <td><b>฿{{number_format($row->price)}}</b></td>
                        <td><b><?=($row->amount < $row->c_amount)?'<span class="text-danger">สินค้าคงเหลือไม่เพียงพอ</span>':'จำนวน '.$row->c_amount.' ชิ้น'?></b></td>
                        <td><b>฿{{number_format($row->c_total)}}</b></td>
                        <td><a href="/cart/delete/{{$row->c_id}}" onclick="return confirm('ต้องการลบสินค้านี้ออกจากตะกร้าใช่หรือไม่ ?')" class="btn btn-outline-danger">ลบ</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 col-md-4 my-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('checkout')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="o_total" value="{{$sum}}">
                        <input type="hidden" name="o_member_id" value="{{session('id')}}"> 
                        @foreach($value as $row)
                        <input type="hidden" name="cart_id[]" value="{{$row->c_id}}">
                        <input type="hidden" name="o_product_id[]" value="{{$row->p_id}}">
                        <input type="hidden" name="o_amount[]" value="{{$row->c_amount}}">
                        <div class="my-2">
                            <p class="float-end">฿{{number_format($row->c_total)}}</p>
                            <p>{{$row->productname}}</p>
                        </div>
                        @endforeach
                        <hr>
                        <div class="my-4">
                        <h6 class="float-end"><b>฿{{number_format($sum)}}</b></h6>
                        <h6><b>ยอดรวมสุทธิ</b></h6>
                        </div>
                        <button type="submit" class="btn btn-dark col-12"><b>สั่งซื้อสินค้า</b></button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="d-flex justify-content-center" style="padding-top: 10rem;">
            <div class="text-center">
                <h4><b>ไม่มีสินค้าในตะกร้าของคุณ</b></h4>
                <p>กรุณาคลิกที่ปุ่มด้านล่างเพื่อเลือกซื้อสินค้า</p>
                <a href="{{route('shop')}}" class="btn btn-dark col-12">เลือกซื้อสินค้า</a>
            </div>
        </div>
        @endif
    </div>
</div>
@if(session('fail'))
<script>sweetsfail("{{session('fail')}}")</script>
@endif
@endsection