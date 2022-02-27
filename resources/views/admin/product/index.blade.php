@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="text-right my-3 mx-5">
        <a href="{{route('add-product')}}" class="btn btn-success"><i class="fas fa-plus"></i> เพิ่มรายการสินค้า</a>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <form>
            @csrf
            </form>
            <div class="table-responsive ">
                <table class="table table-primary table-striped p-2 datatable align-middle">
                    <thead>
                        <tr class="text-center">
                            <th>#ID</th>
                            <th>รูปสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>สถานะ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                        @foreach($value as $row)
                        <tr class="text-center">
                            <td><?=$i++?></td>
                            <td class="col-2"><img src="{{asset($row->picture)}}" style="object-fit: cover;height:120px;min-width:120px" class="mx-auto w-100"></td>
                            <td><p class="text-dot" style="width:150px">{{$row->productname}}</p></td>
                            <td>{{number_format($row->price)}}</td>
                            <td>{{$row->amount}}</td>
                            <td>
                                <div class="form-check form-switch">
                                <input class="form-check-input" value="{{$row->id}}" type="checkbox" id="flexSwitchCheckDefault" <?=$row->status == 1 ?'checked':''?>>
                                </div>
                            </td>
                            <td class="">
                                <a href="/admin/product/editproduct/{{$row->id}}" class="btn btn-warning col-12 col-lg-5"><i class="fas fa-edit"></i> Edit</a>
                                <a href="/admin/product/delete/{{$row->id}}" onclick="return confirm('ยืนยันการลบข้อมูล {{$row->productname}} ใช่หรือไม่ ?')" class="btn btn-danger col-12 col-lg-6"><i class="fas fa-eraser"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$('input[type="checkbox"]').on('click',function(){
    var id = $(this).val()
    if ($(this).is(':checked')){
        var status = 1
    }else{
        var status = 0
    }
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
    url : "{{ route('status')}}",
    data: {id:id,status:status},
    type:'POST',
    success:function(note){
        sweetslocation(note[0],note[1])
    }
    });
});
</script>
@if(session('success'))
<script>sweets("{{session('success')}}")</script>
@endif
@endsection
