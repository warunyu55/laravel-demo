<div class="col-md-2 col-12 my-2">
    <div class="nav flex-column" style="background-color:whitesmoke;" >
        <li class="nav-link text-center <?=(request()->routeIs('profile'))?'active':''?>">
            <a href="{{route('profile')}}" class="text-dark <?=(request()->routeIs('profile'))?'c_color':''?>">จัดการบัญชี</a>
        </li>
        <li class="nav-link text-center <?=(request()->segment(2) == 'address')?'active':''?>">
            <a href="{{route('address')}}" class="text-dark <?=(request()->segment(2) == 'address')?'c_color':''?>">จัดการที่อยู่</a>
        </li>
        <li class="nav-link text-center <?=(request()->routeIs('password'))?'active':''?>">
            <a href="{{route('password')}}" class="text-dark <?=(request()->routeIs('password'))?'c_color':''?>">เปลี่ยนแปลงรหัสผ่าน</a>
        </li>
        <li class="nav-link text-center <?=(request()->routeIs('order'))?'active':''?>">
            <a href="{{route('order')}}"class="text-dark <?=(request()->routeIs('order'))?'c_color':''?>" >ประวัติการสั่งซื้อ</a>
        </li>
        <li class="nav-link text-center <?=(request()->routeIs('payment'))?'active':''?>">
            <a href="{{route('payment')}}"class="text-dark <?=(request()->routeIs('payment'))?'c_color':''?>" >แจ้งการชำระเงิน</a>
        </li>
    </div>
</div>
