@extends('layouts.layout')

@section('site-title')
    Employees
@endsection
@section('header-title')
    <li class="breadcrumb-item"><a href="{{url('employees')}}">کارمندان</a></li>
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
   
   
   <style>
        .ellipss{
            transform: translate3d(0px, 20px, 0px) !important;
        } 
        .img{
            width:150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .pagenate-color{
            color:#ccc !important;
            cursor: auto !important;
        } 
    </style>
@endsection
@section('body')


    <div class="text-right mb-2">
        <a href="{{url('employees/create')}}" type="button" class="btn btn-primary btn-min-width  " ><i class="icon icon-plus mr-1"></i> اضافه کردن کارمند</a>
    </div>
    
     <!-- Search -->
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="bug-list-search">
                        <div class="bug-list-search-content">
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu font-large-1"></i></div>
                            <div class="position-relative">
                                <input type="search" id="search" class="form-control" placeholder="چستجو کردن کارمندان ">
                                <div class="form-control-position">
                                    <i class="fa fa-search text-size-base text-muted "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Search -->


     <!-- Employees -->
    <section class="row paginate">
        @foreach ($employees as $row)
            <div class="col-xl-3 col-md-4 col-sm-6 col-12 paginate-item" id="row{{$row->id}}">
                <div class="card">
                    <div class="card-header pb-1">
                        <div class="btn-group">
                            <a   data-toggle="dropdown">
                                <i class="fa fa-ellipsis-v" style="font-size:21px"></i>
                            </a>
                            <ul class="dropdown-menu p-1 ellipss" role="menu">
                                <a href="{{url('employees/update')}}/{{$row->id}}" class="d-flex align-items-center" ><span class="feather icon-edit mr-50"></span><li >ویرایش کردن</li></a>
                                <hr>
                                <a data-toggle="modal" data-target="#large" class="text-primary d-flex align-items-center reset-password" data-id="{{$row->id}}" data-name="{{$row->name}}" ><span class="feather icon-unlock mr-50"></span><li>تغییر رمز عبور</li></a>
                                <hr>
                                <li><a href="#"class="d-flex align-items-center delete" data-id="{{$row->id}}" ><span class="feather icon-trash mr-50"></span>حذف کردن</a></li>                  
                            </ul>
                        </div>
                    </div>
            
                    <div class="card-body pt-0 ">
                        <div class="text-center">
                            @if (empty($row->photo))
                                <img src="{{asset('public/assets/images/man.png')}}"  alt="Employee image" class="img mb-1 shadow">
                            @else
                                <img src="{{asset('storage/app')}}/{{$row->photo}}"  alt="Employee image" class="img mb-1 shadow">
                            @endif
                            <h4 class="card-title mt-2 mb-1">{{$row->name}} {{$row->lastname}}</h4>
                            <h6 class=" text-muted font" ><small style="font-size:12px">{{$row->email}}</small></h6>
                            <h6 class="mt-75  text-muted font">{{$row->phone_number}}</h6>
                            <h6 class=" mt-75 text-muted">
                                @if ($row->role=='admin')
                                    <span class="badge bg-teal bg-lighten-2 px-2">ادمین</span>
                                @elseif($row->role=='manager')
                                    <span class="badge bg-primary bg-lighten-1  px-2">مدیر</span>
                                @elseif($row->role=='staff')
                                    <span class="badge bg-blue-grey bg-lighten-1 px-2">کارگر</span>
                                @endif
                            </h6>
                            
                            <a href="{{url('employees/profile')}}/{{$row->id}}" type="button" class="btn btn-primary mt-2 d-block"> <span> دیدن پروفایل </span> <i class="feather icon-chevrons-left"></i>  </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section> <!-- End Employees -->


     <!-- Pagination -->
    <section class="my-1">
        <nav aria-label="Page navigation" >
            <ul class="pagination justify-content-end" id="pagination">
                <li class="page-item prve"><a class="page-link" href="#" ><span aria-hidden="true">قبلی</span></a></li>
                
                <li class="page-item next"><a class="page-link" href="#" ><span aria-hidden="true">بعدی</span></a></li>
            </ul>
        </nav>
    </section> <!-- End Pagination -->




    <!-- Modal Password -->
    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content p-1">
            <div class="modal-header">
             
                <h4 class="modal-title">  تغییر رمز عبور ( پسورد )
                    <p style="font-size:13px;color:#90A4AE;" class="ml-25 mt-50 mb-50"><span class="feather icon-user mr-25"></span> <span id="user_name"></span> </p>
                </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form" id="form">
                <div class="modal-body pt-2">
                    <div class="alert alert-password alert-danger">
                        <ul id="error" class="p-0 m-0"></ul>
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
                    <input type="hidden" name='hidden_id' id="hidden-id" >
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >لغو کردن</button>
                    <button type="submit"  class="btn btn-primary"> تغییر دادن</button>
                </div>
            </form>
          </div>
        </div>
      </div> <!--End Modal Password -->




@endsection
@section('javascript')

   
<script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>

<script src="{{asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>

    {{-- searching code --}}
    <script>
        $(document).ready(function(){
            var search=$('#search');
            $(search).on('keyup',function(){
                value=$('#search').val().toUpperCase();
                var card_length= $('.paginate .paginate-item').length;
                var card= $('.paginate .paginate-item');
                var cardBody='';
                var cardChild='';
                cardBody = $('.paginate .paginate-item .card-body');
                for(var i=0;i<card_length;i++){
                    cardChild=$(cardBody[i]).children();
                    $(card[i]).css('display','none')
                    for(let j=0;j<cardChild.length;j++){
                        var tagText=$(cardChild[j]).text();
                        if (tagText.indexOf(value) > -1) {
                            $(card[i]).css('display','block')
                            console.log(tagText.indexOf(value));
                        } 
                    }
                }

            });
        });
    </script> {{-- searching code --}}


 {{-- pagenation code --}}
 <script>
    $(document).ready(function(){
         var num= $('.paginate .paginate-item').length;
         var div=$('.paginate .paginate-item');
         var page_of_num=8;
         if(num>page_of_num){
            var numb_page=num/page_of_num;
            var pagenate=' <li class="page-item prev"><a class="page-link" href="#pagination" ><span aria-hidden="true">قبلی</span></a></li>';
            for(var j=0;j<numb_page;j++){
                pagenate+='<li class="page-item pagenate_number"><a class="page-link" href="#pagination">'+(j+1)+'</a></li>';
            }
            pagenate+='<li class="page-item next"><a class="page-link" href="#pagination" ><span aria-hidden="true">بعدی</span></a></li>';
            $('#pagination').html(pagenate);
            $('#pagination .pagenate_number:first').addClass("active");
        
            $(div).css("display","none");
                for(var i=0;i<page_of_num;i++){
                $(div[i]).css("display","block");
            }
            var text_num=1;
            $('#pagination .pagenate_number').on('click',function(){
                text_num=$(this).text();
                $(div).css("display","none");
                for(var i=((page_of_num*text_num)-(page_of_num));i<page_of_num*text_num;i++){
                    $(div[i]).css("display","block");
                }
                $('.next a').removeClass('pagenate-color');
                $('.prev a').removeClass('pagenate-color');

                if(text_num>=numb_page){
                    $('.next a').addClass('pagenate-color');
                }   
                if(text_num<=1){
                    $('.prev a').addClass('pagenate-color');
                }  
            });

            $('body').on('click', '.next', function() {
                text_num=parseInt(text_num)+1;
                $('.prev a').removeClass('pagenate-color');
                if(text_num>=numb_page){
                    $(div).css("display","none");
                    for(var i=((page_of_num*text_num)-(page_of_num));i<page_of_num*text_num;i++){
                        $(div[i]).css("display","block");
                        $('.pagination .pagenate_number').removeClass('active');
                        $('.pagination .pagenate_number').eq(parseInt(text_num)-1).addClass('active');
                    }
                }
                if(text_num>=numb_page){
                    $('.next a').addClass('pagenate-color');
                }   
            });

            $('.prev a').addClass('pagenate-color');
            
            $('body').on('click', '.prev', function() {
                text_num=parseInt(text_num)-1;
                $('.next a').removeClass('pagenate-color');
                if(text_num>0){
                    $(div).css("display","none");
                    for(var i=((page_of_num*text_num)-(page_of_num));i<page_of_num*text_num;i++){
                        $(div[i]).css("display","block");
                        $('.pagination .pagenate_number').removeClass('active');
                        $('.pagination .pagenate_number').eq(parseInt(text_num)-1).addClass('active');
                    }
                }
                if(text_num<=1){
                    $('.prev a').addClass('pagenate-color');
                }   
            });
         }else{
             $('#pagination').css('display','none')
         }
    });
 </script>
 <script>
    $(document).ready(function(){
         $('.pagination .pagenate_number').on('click',function(){
             $('.pagination .pagenate_number').removeClass('active');
             $(this).addClass('active');
         });
    });
 </script>{{-- pagenation code --}}


@if (session()->has('status'))
    <script>
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
        toastr["success"]("{{ session('status') }}");
    </script>
@endif



{{-- reset password form --}}
<script>
     $(document).ready(function(){
        $('.reset-password').on('click',function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            $('#form').trigger("reset");
            $('#hidden-id').val(id);
            $('#user_name').html(name);
            $('.alert-password').css('display','none');
            $('#new_password').removeClass(' is-invalid');
            $('#confirm_password').removeClass(' is-invalid');
        })
    });
</script>

<script>
    $("#form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("employees/reset_password") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#large').modal('hide');
                    $('.alert-password').css('display','none');
                    $('#new_password').removeClass(' is-invalid');
                    $('#confirm_password').removeClass(' is-invalid');
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
                        if(key=='new_password'){
                            $('#new_password').addClass(' is-invalid');
                        }
                        if(key=='confirm_password'){
                            $('#confirm_password').addClass(' is-invalid');
                        }
                        $(".alert-password").css('display', 'block');
                        $(".alert-password").find("ul").append('<li>' + value + '</li>');
                    });     
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $('#new_password').on('keypress',function(){
            $('#new_password').removeClass(' is-invalid');
        });
        $('#confirm_password').on('keypress',function(){
            $('#confirm_password').removeClass(' is-invalid');
        });
</script>{{-- End reset password form --}}



{{-- delete form --}}
<script>
     $('body').on('click','.delete',function(){  
            var id =$(this).attr('data-id');
            Swal.fire({
                title: 'آیا مطمئن استی ؟',
                text: "شما نمی توانید دیگر این را برگردانید!",
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
                        url:'{{url("employees")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
                            $('.paginate').load(document.URL + ' .paginate');
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
                        error:function(error){
                            Swal.fire(
                                'ناموفق !',
                                'کارمند دیتا های مرتبط دارد',
                                'error'
                            )
                        }
                    });
                }
            })
        });
</script>{{-- End delete form --}}

@endsection
