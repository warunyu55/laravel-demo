@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
       @include('sidebarprofile')
        <div class="col-md-10 col-12 my-2">
            <div class="container">
                <div class="card">
                    <div class="card-header"><h3 class="text-center"><b>แจ้งการชำระเงิน</b></h3></div>
                    <div class="card-body">
                        <form method="post" action="{{route('c_payment')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group my-2">
                                <label>เลือกบัญชีธนาคาร</label>
                                <div class="row">
                                <?php $n = 0;?>
                                @foreach($bank as $v_bank)
                                    <div class="col-12 col-md-6 col-lg-3 my-2 ">
                                        <div class="form-check form-check-inline">
                                            <label for="inlineRadio<?=$n?>">
                                                <div class="card">
                                                    <div class="card-body text-center" for="inlineRadio1">
                                                        <img src="{{asset($v_bank->bank_picture)}}" class="cover mx-auto">
                                                        <div class="text-sm">{{$v_bank->bank_name}}<br>
                                                        ชื่อ {{$v_bank->account_name}}<br>
                                                        เลขบัญชี {{$v_bank->account_number}}</div>
                                                        <input type="radio" name="banking_id" id="inlineRadio<?=$n?>" value="{{$v_bank->id}}" required>
                                                    </div>
                                                </div>  
                                            </label>
                                        </div>
                                    </div>
                                <?php $n++;?>
                                @endforeach
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <label>รหัสการสั่งซื้อ</label>
                                <select name="order_id" class="form-control payment" required>
                                    <option value="">กรุณาระบุรหัสการสั่งซื้อ</option>
                                    @foreach($value as $row)
                                    <option value="{{$row->id}}">{{$row->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group my-2">
                                <label>ยอดที่ต้องชำระ</label>
                                <input type="text" name="" class="form-control paid" value="" readonly>
                            </div>
                            <div class="form-group my-2">
                                <label>หลักฐานการโอนเงิน</label>
                                <img src="{{asset('/image/default/default.jpg')}}" id="blah" class="my-3" style="height: 250px;object-fit:cover">
                                <input type="file" name="o_payment" id="imgInp" class="form-control" required>
                            </div>
                            <div class="my-3">
                                <button type="submit" class="btn btn-dark col-12 col-md-3">ยืนยันการชำระเงิน</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
imgInp.onchange = evt => {
const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}
$(".payment").on('change',function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "{{route('ajaxpaid')}}" ,
        data: {
            id:$(this).val()
        },
        success: function(data,success){
            // console.log(data);
            $('.paid').val(data['paid']);
        },
    });
})
</script>
@if(session('success'))
<script>sweets("{{session('success')}}")</script>
@endif
@endsection