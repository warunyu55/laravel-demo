@extends('layouts.default')
@section('content')
<div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('image/banner/banner1.jpg')}}" class="d-block cover w-100" style="height: 400px;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('image/banner/banner2.jpg')}}" class="d-block cover w-100" style="height: 400px;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('image/banner/banner3.jpg')}}" class="d-block cover w-100" style="height: 400px;" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<div class="container-fluid">
    <div class="container">
        <div class="text-center my-5">
            <h3><b>สินค้ามาใหม่</b></h3>
        </div>
        <div class="row">
            @foreach($value as $row)
            <div class="col-12 col-md-3">
                <div class="card" >
                    <div class="card-body mx-auto my-auto">
                        <a href="/shop/product/{{$row->id}}">
                            <img src="{{$row->picture}}" class="cover">
                        </a>
                    </div>
                </div>
                <div class="text-center my-2">
                    <p class="text-dot" style="width:100%">{{$row->productname}}</p>
                    <p>฿{{number_format($row->price)}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center my-3"><a href="{{route('shop')}}" class="btn btn-outline-dark">ดูสินค้าทั้งหมด</a></div>
    </div>
</div>

@endsection

