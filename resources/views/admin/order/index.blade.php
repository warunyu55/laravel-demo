@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="table-responsive ">
                <table class="table table-primary table-striped p-2 datatable align-middle" >
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>รหัสการสั่งซื้อ</th>
                            <th>ยอดสั่งซื้อสินค้า</th>
                            <th>สถานะ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach($value as $row)
                        <tr>
                            <td><?=$i++?></td>
                            <td>{{$row->o_id}}</td>
                            <td>฿{{number_format($row->o_total)}}</td>
                            <td>
                                @if($row->o_status == 0)
                                    <b class="text-secondary">รอชำระเงิน</b>
                                @elseif($row->o_status == 1)
                                    <b class="text-warning">ตรวจสอบการชำระเงิน</b>
                                @elseif($row->o_status == 2)
                                    <b class="text-success">สำเร็จ</b>
                                @else
                                    <b class="text-danger">ยกเลิก</b>
                                @endif
                            </td>
                            <td><a href="/admin/order/view/{{$row->o_id}}" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> ดูข้อมูล</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
