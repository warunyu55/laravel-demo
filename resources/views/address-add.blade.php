@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
       @include('sidebarprofile')
       <div class="col-md-10 col-12 my-2">
           <div class="card">
               <div class="card-header"><h4 class="text-center"><b>จัดการที่อยู่</b></h4></div>
               <div class="card-body">
                    <form method="post" action="{{route('add-address-db')}}">
                        @csrf
                        <div class="form-group my-2">
                            <label>ที่อยู่ <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" name="a_address" placeholder="กรอกที่อยู่" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group my-2">
                                    <label>จังหวัด <span class="text-danger">*</span></label>
                                    <select class="form-control province" name="province_id" required>
                                        <option value="">กรุณาเลือกจังหวัด</option>
                                        @foreach($value as $row)
                                        <option value="{{$row->ProvinceID}}">{{$row->ProvinceThai}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <label>แขวง/ตำบล <span class="text-danger">*</span></label>
                                    <select class="form-control tambon" name="tambon_id" id="tambon" required>
                                        <option value="">กรุณาเลือกแขวง/ตำบล</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group my-2">
                                    <label>เขต/อำเภอ <span class="text-danger">*</span></label>
                                    <select id="district" class="form-control district" name="district_id" required>
                                        <option value=" ">กรุณาเลือกเขต/อำเภอ</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <label>รหัสไปรษณีย์ <span class="text-danger">*</span></label>
                                    <input type="text" name="postcode" class="form-control postcode" value="" required> 
                                </div>
                            </div>
                        </div>
                        <div class="form-check my-2">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="a_status">
                            <label class="form-check-label" for="flexCheckDefault">
                                ใช้เป็นที่อยู่ในการจัดส่งสินค้า
                            </label>
                        </div>
                        <div class="my-2">
                            <button class="btn btn-dark col-12 col-md-3 my-2">ยืนยันข้อมูล</button>
                            <a href="{{route('address')}}" class="btn btn-outline-dark col-12 col-md-3 my-2">ย้อนกลับ</a>
                        </div>
                    </form>
               </div>
           </div>
       </div>
    </div>
</div>
<script>
$(".province").on('change',function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "{{route('ajaxprovince')}}",
        data: {
            'provinceID':$(this).val()
        },
        success: function(data,success){
            $("#district").html(data);
        },
    });
})
$(".district").on('change',function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "{{route('ajaxdistrict')}}",
        data: {
            'provinceID':$(".province").val(),
            'districtID':$(this).val(),
        },
        success: function(data,success){
            // console.log(data)
            $("#tambon").html(data)
        },
    });
})
$(".tambon").on('change',function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "{{route('ajaxtambon')}}",
        data: {
            'provinceID':$(".province").val(),
            'districtID':$(".district").val(),
            'tambonID':$(this).val(),
        },
        success: function(data,success){
            // console.log(data)
            $(".postcode").val(data)
        },
    });
})
</script>
@if(session('success'))
<script>sweetslocation("{{session('success')}}","{{session('location')}}")</script>
@endif
@endsection