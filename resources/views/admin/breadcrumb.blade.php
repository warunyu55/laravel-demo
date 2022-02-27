<?php 
if(request()->segment(3)!= NULL){
    $name = request()->segment(3);
}elseif(request()->segment(2)!= NULL){
    $name = request()->segment(2);
}else{
    $name = request()->segment(1);
}
switch($name){
    case('admin'):
        $default = "Dashboard";
        break;
    case('member'):
        $default = "จัดการข้อมูลสมาชิก";
        $oldpage = "Dashboard";
        $link = 'dashboard';
        break;
    case('category'):
        $default = "จัดการประเภทสินค้า";
        $oldpage = "Dashboard";
        $link = 'dashboard';
        break;
    case('addcategory'):
        $default = "เพิ่มรายการประเภทสินค้า";
        $oldpage = "จัดการประเภทสินค้า";
        $link = 'category';
        break;
    case('editcategory'):
        $default = "แก้ไขประเภทสินค้า";
        $oldpage = "จัดการประเภทสินค้า";
        $link = 'category';
        break;
    case('product'):
        $default = "จัดการรายการสินค้า";
        $oldpage = "Dashboard";
        $link = 'dashboard';
        break;
    case('addproduct'):
        $default = "เพิ่มรายการสินค้า";
        $oldpage = "จัดการรายการสินค้า";
        $link = 'product';
        break;
    case('editproduct'):
        $default = "แก้ไขรายการสินค้า";
        $oldpage = "จัดการรายการสินค้า";
        $link = 'product';
        break;
    case('banking'):
        $default = "จัดการบัญชีธนาคาร";
        $oldpage = "Dashboard";
        $link = 'dashboard';
        break;
    case('addbanking'):
        $default = "เพิ่มบัญชีธนาคาร";
        $oldpage = "จัดการบัญชีธนาคาร";
        $link = 'banking';
        break;
    case('editbanking'):
        $default = "แก้ไขบัญชีธนาคาร";
        $oldpage = "จัดการบัญชีธนาคาร";
        $link = 'banking';
        break;
    case('order'):
        $default = "จัดการรายการสั่งซื้อ";
        $oldpage = "Dashboard";
        $link = 'dashboard';
        break;
    case('view'):
        $default = "ดูข้อมูลรายการสินค้า";
        $oldpage = "จัดการรายการสั่งซื้อ";
        $link = 'admin_order';
        break;
}
?>
<div class="my-3">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb float-end">
            @if(isset($default) && !empty($default))
                <li class="breadcrumb-item text-muted">{{$default}}</li>
            @endif
            @if(isset($oldpage) && !empty($oldpage))
                <li class="breadcrumb-item text-muted"><a href="{{route($link)}}" class="breadcrumb-a">{{$oldpage}}</a></li>
            @endif
        </ol>
    </nav>
    <h3>{{$default}}</h3>
</div>
