@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
       @include('sidebarprofile')
       <div class="col-md-10 col-12 my-2">
            <div class="card">
                <div class="card-header"><h4 class="text-center"><b>ประวัติการสั่งซื้อ</b></h4></div>
                <div class="card-body">
                @if($value->isNotEmpty())
                    @php
                    $r = 0;
                    @endphp
                    @foreach($value as $row)
                    <div class="container">
                        <div class="card my-2">
                            <div class="card-header">
                                <div class="float-start">รายการสั่งซื้อ <u><b>#{{$row->id}}</b></u> วันที่: {{date('d/m/Y',strtotime($row->created_at))}}</div>
                                <div class="float-end">
                                    @if($row->o_status == 0)
                                        <a href="{{route('payment')}}" class="btn btn-sm btn-secondary">ชำระเงิน</a>
                                    @elseif($row->o_status == 1)
                                        <a href="" class="btn btn-sm btn-warning">กำลังตรวจสอบ</a>
                                    @elseif($row->o_status == 2)
                                        <a href="" class="btn btn-sm btn-success">สำเร็จ</a>
                                    @else
                                        <a href="" class="btn btn-sm btn-danger">ยกเลิก</a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table align-middle text-center" style="border-color:transparent;">
                                    <th></th>
                                    <th>รายการสินค้า</th>
                                    <th>ราคา</th>
                                    <th>จำนวน</th>
                                    <th>ยอดรวม</th>
                                    <tbody>
                                    @php
                                    $n = 0;
                                    @endphp
                                        @foreach($data[$r] as $p_row)
                                        <tr>
                                            <td><img src="{{asset($p_row->picture)}}" class="cover mx-auto"></td>
                                            <td>{{$p_row->productname}}</td>
                                            <td>฿{{number_format($p_row->price)}}</td>
                                            <td>{{$amount[$r][$n]}}</td>
                                            <td>฿{{number_format($p_row->price*$amount[$r][$n])}}</td>
                                        </tr>
                                    @php
                                    $n++;
                                    @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <span class="text-muted text-sm me-5">ยอดรวมสุทธิ</span> 
                                    <span class=""><b>฿{{number_format($row->o_total)}}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $r++
                    @endphp
                    @endforeach
                    @else
                    <div class="my-5">
                        <h4 class="text-center"><b><u>ไม่พบประวัติการสั่งซื้อของคุณ</u></b></h4>
                    </div>
                    @endif()
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
<script>sweets()</script>
@endif
@endsection
