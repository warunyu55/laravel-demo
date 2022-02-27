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
                            <th>ชื่อ - สกุล</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>อีเมล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach($value as $row)
                        <tr>
                            <td><?=$i++?></td>
                            <td>{{$row->firstname .' - '. $row->lastname}}</td>
                            <td>0{{$row->phone}}</td>
                            <td>{{$row->email}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
