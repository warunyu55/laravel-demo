@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="mb-5">
            <div class="float-start">รายการสั่งซื้อ <b><u>#{{$data->o_id}}</u></b> 
                @if($data->o_status == 0)
                    <span class="text-secondary">(รอชำระเงิน)</span>
                @elseif($data->o_status == 1)
                    <span class="text-warning">(ตรวจสอบการชำระเงิน)</span>
                @elseif($data->o_status == 2)
                    <span class="text-success">(สำเร็จ)</span>
                @else
                    <span class="text-danger">(ยกเลิก)</span>
                @endif
            </div>
            <div class="float-end">วันที่ {{date('d/m/y',strtotime($data->date))}}</div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 my-2">
                    <div class="card">
                        <div class="card-header"><b>ข้อมูลผู้สั่งซื้อ</b></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="my-2">
                                        <label class="text-muted">ชื่อ - นามสกุล</label>
                                        <p>{{$data->firstname}}-{{$data->lastname}}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="my-2">
                                        <label class="text-muted">อีเมล</label>
                                        <p>{{$data->email}}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="my-2">
                                        <label class="text-muted">เบอร์โทรศัพท์</label>
                                        <p>0{{$data->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 my-2">
                    <div class="card">
                        <div class="card-header"><b>ที่อยู่สำหรับจัดส่งสินค้า</b></div>
                        <div class="card-body">
                            <div class="my-2">
                                <p>{{$data->a_address}}, {{$data->TambonThai}}, {{$data->DistrictThai}}, {{$data->ProvinceThai}}, {{$data->PostCodeMain}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header"><b>รายการสั่งซื้อสินค้า</b></div>
                <div class="card-body">
                    <table class="table text-center align-middle">
                        <?php $i =0 ;?>
                        @foreach($product as $row)
                        <tr>
                            <td><img src="{{asset($row->picture)}}" class="cover mx-auto"></td>
                            <td>{{$row->productname}}</td>
                            <td>{{$amount[$i]}}</td>
                            <td>{{$row->price}}</td>
                        </tr>
                        <?php $i++?>
                        @endforeach
                    </table>
                    <div class="text-right">
                        <label class="text-muted text-sm me-5">ยอดรวมสุทธิ</label>
                        <b>฿{{$data->o_total}}</b>
                    </div>
                </div>
            </div>
            @if($data->o_bank_id != NULL)
            <div class="card my-4">
                <div class="card-header"><b>รายละเอียดการชำระเงิน</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 my-2">
                        <h6><b>บัญชีธนาคาร</b></h6>
                            <img src="{{asset($data->bank_picture)}}" class="cover mx-auto">
                            <div class="text-center text-sm">
                                <div>{{$data->bank_name}}</div>
                                <div>{{$data->account_name}}</div>
                                <div>{{$data->account_number}}</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <h6><b>สลิปโอนเงิน</b></h6>
                            <img src="{{asset($data->o_payment)}}" class="mx-auto" style="object-fit: cover;height:250px">
                        </div>
                    </div>
                </div>
            </div>
                @if($data->o_status == 1)
                <div class="text-center my-4">
                    <a href="/admin/order/confirm/{{$data->o_id}}" class="btn btn-primary">ยืนยันการชำระเงิน</a>
                    <a href="/admin/order/cancel/{{$data->o_id}}" class="btn btn-danger">ยกเลิกรายการ</a>
                </div>
                @endif
            @endif
            @if($data->o_status == 0)
            <div class="text-center my-4">
                <a href="/admin/order/cancel/{{$data->o_id}}" class="btn btn-danger">ยกเลิกรายการ</a>
            </div>
            @elseif($data->o_status == 3)
            <div class="text-center my-4">
                <a href="/admin/order/delete/{{$data->o_id}}" class="btn btn-danger">ลบรายการ</a>
            </div>
            @endif
        </div>
    </div>
</div>
@if(session('success'))
<script>sweetslocation("{{session('success')}}","{{session('location')}}")</script>
@endif
@endsection