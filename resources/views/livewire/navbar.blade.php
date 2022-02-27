<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="{{asset('/image/logo/Logo.png')}}" width="120"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?=(request()->is('/'))?'active':''?>" aria-current="page" href="/">หน้าหลัก</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" id="DropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    หมวดหมู่สินค้า
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="DropdownMenuLink">
                        <?php
                        use Illuminate\Support\Facades\DB;
                        $drop = DB::table('type_products')->get(); ?>
                        @foreach ($drop as $d_type)
                        <li><a class="dropdown-item" href="/shop/{{$d_type->type_name}}">{{$d_type->type_name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(request()->routeIs('shop'))?'active':''?>" href="{{route('shop')}}">ร้านค้า</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="DropdownSearch" data-bs-toggle="dropdown">
                        <i class="fas fa-search"></i>
                    </a>
                    <ul class="dropdown-menu nav-search p-2" aria-labelledby="DropdownSearch">
                            <form method="get" action="/shop/search/{name}">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control border-none" type="text" name="search" placeholder="ค้นหาสินค้า">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                    </ul>
                </li>
                @if(session('email'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cart')}}"><i class="fas fa-shopping-cart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(request()->routeIs('profile'))?'active':''?>" aria-current="page" href="{{route('profile')}}">บัญชีผู้ใช้</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('logout')}}">ออกจากระบบ</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link <?=(request()->routeIs('register'))?'active':''?>" aria-current="page" href="{{route('register')}}">สมัครสมาชิก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(request()->routeIs('login'))?'active':''?>" aria-current="page" href="{{route('login')}}">เข้าสู่ระบบ</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
