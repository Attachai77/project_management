<!-- <div class="flex-center position-ref full-height">
    <div class="code">
        403            
    </div>
    <div class="message" style="padding: 10px;">
        User does not have the right permissions.            
    </div>
</div> -->

@extends('layouts.adminlte')
@section('content')

<style>
.error-page {
    width:800px;
}
.content-wrapper {
    background: #fff;
}
</style>

<section class="content">
    <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! User does not have the right permissions.</h3>

            <p>ขออภัย! ท่านไม่ได้รับสิทธิ์ในการเข้าถึงหน้านี้</p>

            <a href="javascript:history.back()" class="btn btn-outline-danger">
            <i class="fa fa-angle-left"></i> กลับไปก่อนหน้า
            </a>
        </div>
    </div>
</section>

@endsection