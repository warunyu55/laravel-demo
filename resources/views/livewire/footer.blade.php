<div class="container-fluid" style="margin-top:auto">
  <div class="d-flex flex-wrap justify-content-between align-items-center  mx-3 border-top">
    <div class="col-md-4 col-12 my-3">
      <h4 class="text-muted">Contact Us</h4>
      <label class="text-muted">Address :<br>Lorem ipsum dolor sit amet consectetur adipisicing elit.</label>
      <label class="text-muted">Contact phone : xxx-xxx-xxxx</label>
    </div>
    <div class="col-md-2 col-12 my-3">
      <ul class="nav justify-content-end flex-column footer-end">
        <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">หน้าหลัก</a></li>
        <li class="nav-item dropstart">
            <a class="nav-link text-muted px-2" href="#" id="DropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <li class="nav-item"><a href="{{route('shop')}}" class="nav-link px-2 text-muted">ร้านค้า</a></li>
        @if(session('email'))
          <li class="nav-item">
              <a class="nav-link px-2 text-muted" href="{{route('profile')}}">บัญชีผู้ใช้</a>
          </li>
          <li class="nav-item">
              <a class="nav-link px-2 text-muted" href="{{route('logout')}}">ออกจากระบบ</a>
          </li>
          @else
          <li class="nav-item">
            <a href="{{route('register')}}" class="nav-link px-2 text-muted">สมัครสมาชิก</a>
          </li>
          <li class="nav-item">
              <a class="nav-link px-2 text-muted"  href="{{route('login')}}">เข้าสู่ระบบ</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</div>
<footer class="text-center mt-3 bg-dark p-2">
    <p class="mb-0 text-muted">&copy; 2022 onlineshopping</p>
</footer>
