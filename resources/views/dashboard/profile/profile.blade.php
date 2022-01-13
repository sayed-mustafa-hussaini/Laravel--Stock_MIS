@extends('layouts.layout')

@section('site-title')
     Profile
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('profile')}}">پروفایل</a></li>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <style>
    .myborder{
            border: 1px solid #E4E7ED !important;
            margin-bottom:15px;
            text-align: center
        }
    </style>
@endsection
@section('body')


<section id="page-account-settings">
    <div class="row">
        <!-- left menu section -->
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                <li class="nav-item">
                    <a class="nav-link d-flex active click-info" id="account-pill-info" data-toggle="pill" href="#account-vertical-info"
                        aria-expanded="false">
                        <i class="feather icon-info"></i>
                        معلومات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex click-general" id="account-pill-general" data-toggle="pill"
                        href="#account-vertical-general" aria-expanded="true">
                        <i class="feather icon-globe"></i>
                        تغییرات عمومی
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex click" id="account-pill-photo" data-toggle="pill"
                        href="#account-vertical-photo" aria-expanded="true">
                        <i class="feather icon-camera"></i>
                        تغییر عکس
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex click" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                        aria-expanded="false">
                        <i class="feather icon-lock"></i>
                        تغییر رمزعبور (پسورد)
                    </a>
                </li>
            </ul>
        </div>
        <!-- right content section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                
                                <div class="row p-1">
                                    <div class="col-md-5 col-lg-5">
                                        <div class="profile">
                                            @if (empty($profile->profile_photo_path))
                                                <img src="{{asset('public/assets/images/man.png')}}"  alt="Employee image" class="shadow mb-1" style="width:100%; height:270px;border-radius:3px; object-fit: cover; ">
                                            @else
                                                <img src="{{asset('storage/app')}}/{{$profile->profile_photo_path}}"  alt="Employee image" class="shadow mb-1" style="width:100%; height:270px;border-radius:3px; object-fit: cover; ">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-7 ">
                                        <div class="row load-general">
                                            <div class="col-md-12">
                                                <ul class="list-group">
                                                    <li class="list-group-item  myborder shadow-sm">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="primary">نام</span>
                                                            <span class=""> {{$profile->name}} </span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item myborder shadow-sm">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="primary">تخلص</span>
                                                            <span class=""> {{$profile->lastname}} </span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item myborder shadow-sm">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="primary" >نام کاربری</span>
                                                            <span> {{$profile->username}} </span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item myborder shadow-sm">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="primary" > ایمل ادرس</span>
                                                            <span class="font"><small> {{$profile->email}} </small></span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12">
                                                <ul class="list-group">
                                                    <li class="list-group-item  myborder shadow-sm border-top-0">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="primary" >وظیفه</span>                                                       
                                                            <span > 
                                                                @if ($profile->role=='admin')
                                                                    ادمین
                                                                @elseif($profile->role=='manager')
                                                                    مدیر
                                                                @elseif($profile->role=='staff')
                                                                    کارگر
                                                                @endif     
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item  myborder shadow-sm">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="primary" >شماره تماس</span>
                                                            <span class="font"> {{$profile->phone_number}} </span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item   myborder shadow-sm">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="primary" >معاش</span>
                                                            <span> <span class="font">{{$profile->salary}}</span> <span class="ml-50"> افغانی </span> </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane  fade" id="account-vertical-general"
                                aria-labelledby="account-pill-general" aria-expanded="true">
                                <form id="general-update">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-general alert-danger">
                                                <ul id="error" class="py-0 px-1 m-0"></ul>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">نام <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name"  placeholder="نام " value="{{ $profile->name }}" id="name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="lastname"> تخلص  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="lastname"  placeholder="تخلص" value="{{ $profile->lastname }}" id="lastname">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="username">نام کاربری <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" placeholder="نام کاربری" value="{{ $profile->username }}" id="username">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="phone_number">شماره تماس <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control phone font" name="phone_number"  placeholder="شماره تماس" value="{{ $profile->phone_number }}" id="phone_number">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <input type="hidden" name='hidden_id' value="{{$profile->id}}" >
                                            <button type="submit"  class="btn btn-primary"> تغییر دادن</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            
                            <div role="tabpanel" class="tab-pane  fade" id="account-vertical-photo"
                                aria-labelledby="account-pill-photo" aria-expanded="true">
                                <form id="change-photo">
                                    <div class="media">
                                        <a href="javascript: void(0);" class="photo">
                                            @if (empty($profile->profile_photo_path))
                                                <img src="{{asset('public/assets/images/man.png')}}"  alt="Employee image" class="rounded mr-75" alt="profile image" height="164" width="164" id="uploadUpdate" >
                                            @else
                                                <img src="{{asset('storage/app')}}/{{$profile->profile_photo_path}}"  alt="Employee image" class="rounded mr-75" alt="profile image" height="164" width="164" id="uploadUpdate" >
                                            @endif
                                        </a>
                                        <div class="media-body mt-75">
                                            <div class="alert alert-photo alert-danger">
                                                <ul id="error" class="py-0 px-1 m-0"></ul>
                                            </div>
                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                <label class="btn btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                    for="account-upload"  >اضاقه کردن عکس جدید</label>
                                                <input type="file" name="photo" id="account-upload" hidden onChange="UpdatePreview()">
                                                <button class="btn btn-secondary ml-50 delete-photo" data-id="{{$profile->user_id}}">پاک کردن عکس</button>
                                            </div>
                                            <p class="text-muted ml-75 mt-50"><small>JPG یا PNG مجاز است. حداکثر حجم KB 400</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-sm-row flex-column justify-content-end">
                                        <input type="hidden" name='hidden_id' value="{{$profile->user_id}}" >
                                        <button type="submit"  class="btn btn-primary"> تغییر دادن</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                aria-labelledby="account-pill-password" aria-expanded="false">
                                <form class="form" id="reset-password">
                                    <div class="modal-body pt-2">
                                        <div class="alert alert-password alert-danger">
                                            <ul id="error" class="py-0 px-1 m-0"></ul>
                                        </div>
                                        <div class="form-group mt-25">
                                            <label for="old_password"> رمز عبور ( پسورد ) فعلی <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="old_password"  placeholder="رمز عبور فعلی" id="old_password" >
                                        </div> 
                                        <div class="form-group mt-25">
                                            <label for="new_password"> رمز عبور ( پسورد ) جدید <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="new_password"  placeholder="رمز عبور جدید" id="new_password" >
                                        </div> 
                                        <div class="form-group">
                                            <label for="confirm_password">تایید رمز عبور ( پسورد ) <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control " name="confirm_password"  placeholder="تایید رمز عبور"  id="confirm_password">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name='hidden_id' value="{{$profile->user_id}}" >
                                        <button type="submit"  class="btn btn-primary"> تغییر دادن</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- account setting page end -->


@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>


    <script>
         $('.alert').hide();
         $('.click-info').click(function(){
            $('.profile').load(document.URL + ' .profile');
         })
         $('.click').click(function(){
            $('.alert').hide();
            $('#name').removeClass(' is-invalid');
            $('#lastname').removeClass(' is-invalid');
            $('#username').removeClass(' is-invalid');
            $('#phone_number').removeClass(' is-invalid');
            $('#old_password').removeClass(' is-invalid');
            $('#new_password').removeClass(' is-invalid');
            $('#confirm_password').removeClass(' is-invalid');
            $('#reset-password').trigger("reset");
         })
         $('.click-general').click(function(){
            $('.alert').hide();
            $('#name').removeClass(' is-invalid');
            $('#lastname').removeClass(' is-invalid');
            $('#username').removeClass(' is-invalid');
            $('#phone_number').removeClass(' is-invalid');
         })

         function UpdatePreview(){
            $('#uploadUpdate').attr('src', URL.createObjectURL(event.target.files[0]));
        };
    </script>





      {{-- General Update --}}
      <script>
        $("#general-update").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("profile/general_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.alert').css('display','none');
                    $('#name').removeClass(' is-invalid');
                    $('#lastname').removeClass(' is-invalid');
                    $('#username').removeClass(' is-invalid');
                    $('#phone_number').removeClass(' is-invalid');
                    $('.load-general').load(document.URL + ' .load-general');

                    toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-left",
                        "preventDuplicates": false,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "6000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr["success"](data['success']);
                },
                error: function(data) {
                    $(".alert-general").find("ul").html('');
                    $.each( data.responseJSON.errors, function( key, value ) {
                        if(key=='name'){
                            $('#name').addClass(' is-invalid');
                        }
                        if(key=='lastname'){
                            $('#lastname').addClass(' is-invalid');
                        }
                        if(key=='username'){
                            $('#username').addClass(' is-invalid');
                        }
                        if(key=='phone_number'){
                            $('#phone_number').addClass(' is-invalid');
                        }
                        $(".alert-general").css('display', 'block');
                        $(".alert-general").find("ul").append('<li>' + value + '</li>');
                    });     
                   
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $('#name').on('change',function(){
            $('#name').removeClass(' is-invalid');
        });
        $('#lastname').on('change',function(){
            $('#lastname').removeClass(' is-invalid');
        });
        $('#username').on('change',function(){
            $('#username').removeClass(' is-invalid');
        });
        $('#phone_number').on('change',function(){
            $('#phone_number').removeClass(' is-invalid');
        });
    </script> {{-- General Update --}}



    {{-- Change Photo Profile --}}
    <script>
        $("#change-photo").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("profile/change_photo") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert-photo").css('display', 'none');
                    $('.profile').load(document.URL + ' .profile');
                    toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-left",
                        "preventDuplicates": false,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "6000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr["success"](data['success']);
                },
                
                error: function(data) {
                    $(".alert-photo").find("ul").html('');
                    $(".alert-photo").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert-photo").find("ul").append('<li class="m-0 p-0">' + value + '</li>');
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script> {{-- Change Photo Profile --}}


    {{-- Reset Password --}}
    <script>
        $("#reset-password").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("profile/reset_password") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.alert-password').css('display','none');
                    $('#old_password').removeClass(' is-invalid');
                    $('#new_password').removeClass(' is-invalid');
                    $('#confirm_password').removeClass(' is-invalid');
                    $('#reset-password').trigger("reset");

                    toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-left",
                        "preventDuplicates": false,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "6000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr["success"](data['success']);
                },
                error: function(data) {
                    $(".alert-password").find("ul").html('');
                    $.each( data.responseJSON.errors, function( key, value ) {
                        if(key=='old_password'){
                            $('#old_password').addClass(' is-invalid');
                        }
                        if(key=='new_password'){
                            $('#new_password').addClass(' is-invalid');
                        }
                        if(key=='confirm_password'){
                            $('#confirm_password').addClass(' is-invalid');
                        }
                        $(".alert-password").css('display', 'block');
                        $(".alert-password").find("ul").append('<li>' + value + '</li>');
                    });     
                   
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $('#old_password').on('change',function(){
            $('#old_password').removeClass(' is-invalid');
        });
        $('#new_password').on('change',function(){
            $('#new_password').removeClass(' is-invalid');
        });
        $('#confirm_password').on('change',function(){
            $('#confirm_password').removeClass(' is-invalid');
        });
    </script> {{-- Reset Password --}}




  
    {{-- delete photo --}}
    <script>
        $('body').on('click','.delete-photo',function(){  
           var id =$(this).attr('data-id');
           Swal.fire({
               title: 'آیا مطمئن استی ؟',
               text: "آیا شما میخواهید عکس را پاک کنید !",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#d33',
               cancelButtonColor: '#3085d6',
               confirmButtonText: 'بلی ، حذف شود !',
               cancelButtonText: "لغو",      
           }).then((result) => {
             if (result.value) {
               $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
               $.ajax({
                       type:'DELETE',
                       url:'{{url("profile/delete_photo")}}/'+id,
                       type:'Delete',
                       success:function(data){ 
                        $('.profile').load(document.URL + ' .profile');
                        $('.photo').load(document.URL + ' .photo');

                           Swal.fire(
                               'موفقانه حذف شد !',
                               'عکس شما حذف شد .',
                               'success'
                           )
                           
                       },
                       error:function(error){
                           Swal.fire(
                               'ناموفق !',
                               'مشتری دیتا های مرتبط دارد',
                               'error'
                           )
                       }
                   });
               }
           })
       });
    </script>{{-- delete photo --}}



@endsection
