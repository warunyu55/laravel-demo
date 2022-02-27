@extends('admin.layouts.app')
@section('content')
<style>

</style>
<div class="container">
    @include('admin.breadcrumb')
    <div class="text-right my-3 mx-5">
        <a href="{{route('add-category')}}" class="btn btn-success"><i class="fas fa-plus"></i> เพิ่มประเภทสินค้า</a>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="table-responsive">
                <table class="table table-primary table-striped p-2 datatable align-middle">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>ประเภทสินค้า</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach($value as $row)
                        <tr>
                            <td><?=$i++?></td>
                            <td>{{$row->type_name}}</td>
                            <td>
                                <a href="/admin/category/editcategory/{{$row->id}}" class="btn btn-warning col-12 col-md-5"><i class="fas fa-edit"></i> Edit</a>
                                <a href="/admin/category/delete/{{$row->id}}" onclick="return confirm('ยืนยันการลบข้อมูล {{$row->type_name}} ใช่หรือไม่ ?')" class="btn btn-danger col-12 col-md-6"><i class="fas fa-eraser"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
<script>sweets("{{session('success')}}")</script>
@endif
@endsection
