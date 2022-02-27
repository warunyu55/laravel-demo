@extends('admin.layouts.app')
@section('content')
<div class="container">
    @include('admin.breadcrumb')
    <div class="py-12">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="title-box box-color text-white text-center">
                    <div class="row p-4 ">
                        <div class="col-6">
                            <h3><b>{{$c_product}}</b></h3>
                            <p>สินค้า</p>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-shopping-bag icon-font"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="title-box box-color text-white text-center">
                    <div class="row p-4 ">
                        <div class="col-6">
                            <h3><b>{{$c_member}}</b></h3>
                            <p>ผู้ใช้งาน</p>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-users icon-font"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="title-box box-color text-white text-center">
                    <div class="row p-4 ">
                        <div class="col-6">
                            <h3><b>{{$c_order}}</b></h3>
                            <p>รายการสั่งซื้อ</p>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-list-alt icon-font"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const labels = [
    'มกราคม',
    'กุมภาพันธ์',
    'มีนาคม',
    'เมษายน',
    'พฤษภาคม',
    'มิถุนายน',
    'กรกฏาคม',
    'สิงหาคม',
    'กันยายน',
    'ตุลาคม',
    'พฤศจิกายน',
    'ธันวาคม'
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'ยอดขายชิ้น/เดือน',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: ['{{$jan}}', '{{$feb}}','{{$march}}', '{{$april}}','{{$may}}','{{$jun}}','{{$july}}','{{$aug}}','{{$sep}}','{{$oct}}','{{$nov}}','{{$dec}}'],
    }]
  };
  const myChart = new Chart(
    document.getElementById('myChart'),
    config={
    type: 'line',
    data: data,
    options: {}
    }
  );
 
</script>
@endsection
