@extends('layouts.adminlte')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-12">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">กรอกข้อมูลผู้ใช้งาน</h3>
                </div>
                <form method="POST" action="/users/{{ $user->id }}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">

                        @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($user->id) @endphp
                        
                        <div class="alert" style="padding:0; margin:0;"></div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-2">
                                <div id='profile_img_contain'>
                                    <img id="profile_img" align='middle' src="{{$img_url}}" alt="your image" title=''/>
                                </div> 
                            </div> 
                        </div> 

                        <div class="form-group row">
                            <div class="col-sm-10 offset-2">
                                <div class="upload-btn-wrapper">
                                    <button id="btnImgUpload" class="btn" >เลือกรูปภาพโปรไฟล์</button>
                                    <input type="file" id="inputGroupFile01" name="profile_img" accept="image/*" />
                                    <label style="display:none;" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div> 

                        <h6 class="text-right"><b><i>#ข้อมูลทั่วไป</i></b></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อ :</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $user->first_name }}" required name="first_name" class="form-control" placeholder="ชื่อ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">นามสกุล :</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $user->last_name }}" name="last_name" class="form-control" placeholder="นามสกุล">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">อีเมล :</label>
                            <div class="col-sm-6">
                                <input type="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="อีเมล">
                            </div>
                        </div>
                        <hr>

                        <h6 class="text-right"><b><i>#ข้อมูลการเข้าใช้ระบบ</i></b></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อผู้ใช้งาน :</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $user->username }}" disabled name="username" class="form-control" placeholder="ชื่อ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-2 col-sm-6">
                                <a class="btn btn-outline-danger" href="{{ route('users.reset_password',$user->id) }}">รีเซตรหัสผ่าน</a>
                                <span style="color:red;">(ระบบจะรีเซตรหัสผ่านเป็น "password")</span>
                            </div>
                        </div>
                        
                        <hr>

                        <h6 class="text-right"><b><i>#สิทธิ์การใช้งานระบบ</i></b></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">บทบาท (Role) :</label>
                            <div class="col-sm-6">
                                <!-- <select name="role_id" id="role_id" class="form-control"> -->
                                @foreach($roles as $role_id => $role_name)

                                    @if(in_array($role_id , $user_roles))
                                        @php $beRole = "checked"; @endphp
                                    @else
                                        @php $beRole = ""; @endphp
                                    @endif
                                    <input type="checkbox" name="role_id[]" value="{{ $role_id }}" id="" {{$beRole}}>
                                    <label for="control-label">{{ $role_name }}</label>
                                    
                                    </br>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">บันทึก</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default float-right">ยกเลิก / กลับหน้ารายชื่อ</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>

<style>
#profile_img_contain{
    /* text-align:center; */
}
img#profile_img{
    max-height: 180px;
    border-radius: 50%;
}
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn#btnImgUpload {
  border: 1px solid gray;
  color: gray;
  background-color: white;
  padding: 4px 10px;
  border-radius: 8px;
  font-size:12px;
  font-weight: bold;
  margin-left:25px;
}

.upload-btn-wrapper input[type=file] {
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
</style>

<script>
    $("#inputGroupFile01").change(function(event) {  
        RecurFadeIn();
        readURL(this);    
    });
    $("#inputGroupFile01").on('click',function(event){
        RecurFadeIn();
    });
    function readURL(input) {    
    if (input.files && input.files[0]) {   
        var reader = new FileReader();
        var filename = $("#inputGroupFile01").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
        $('#profile_img').attr('src', e.target.result);
        $('#profile_img').hide();
        $('#profile_img').fadeIn(500);      
        $('.custom-file-label').text(filename);             
        }
        reader.readAsDataURL(input.files[0]);    
    } 
    $(".alert").removeClass("loading").hide();
    }
    function RecurFadeIn(){ 
        console.log('ran');
        FadeInAlert("Wait for it...");  
    }
    function FadeInAlert(text){
        $(".alert").show();
        $(".alert").text(text).addClass("loading");  
    }
</script>


@endsection