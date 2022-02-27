@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
       @include('sidebarprofile')
       <div class="col-md-10 col-12 my-2">
           <div class="card">
               <div class="card-header"><h4 class="text-center"><b>จัดการที่อยู่</b></h4></div>
               <div class="card-body">
                    <div class="text-end my-2">
                        <a href="{{route('add-address')}}" class="btn btn-outline-dark">เพิ่มที่อยู่</a>
                    </div>
                @if($value->isNotEmpty())
                   @foreach($value as $row)
                    <div class="card my-2">
                        <div class="card-body">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td class="text-muted text-sm">{{$row->a_address}}, {{$row->TambonThai}}, {{$row->DistrictThai}}, {{$row->ProvinceThai}}, {{$row->PostCodeMain}}</td>
                                        <td class="text-sm text-success"><?=$row->a_status == 0 ?'':'ใช้เป็นที่อยู่เริ่มต้นสำหรับจัดส่งสินค้า'?></td>
                                        <td class="text-right">
                                            <a href="/profile/address/editform/{{$row->a_id}}" class="btn-sm btn btn-warning mx-1 my-1">แก้ไข</a>
                                            <a href="/profile/address/delete/{{$row->a_id}}" class="btn-sm btn btn-danger mx-1 my-1" onclick="return confirm('ต้องการลบข้อมูลที่อยู่นี้ใช่หรือไม่ ? ')">ลบ</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach 
                @else
                <div class="my-5">
                    <h4 class="text-center"><b><u>กรุณาเพิ่มที่อยู่ของคุณ</u></b></h4>
                </div>
                @endif
               </div>
           </div>
       </div>
    </div>
</div>
@endsection