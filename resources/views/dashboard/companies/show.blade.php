@extends('layouts.layout')

@section('site-title')
    Companies
@endsection
@section('header-title')
    <li class="breadcrumb-item"><a href="{{url('customers')}}"> شرکت </a></li>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/dropify.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">

    <style>
        .ellipss{
            transform: translate3d(0px, 20px, 0px) !important;
        } 
        .pagenate-color{
            color:#ccc !important;
            /* color:white !important; */
            cursor: auto !important;
        }
        .icon-size{
            font-size: 16px !important; 
        }
        .border-red{
            border-color:#FF7588 !important;
        }
        .select2-selection--single{
            border-color:#CCD6E6 !important;
        }

    </style>
@endsection

@section('body')

    <div class="text-right mb-2">
        <button type="button" class="btn btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item"><i class="icon icon-plus mr-1"></i> اضافه کردن شرکت</button>
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
                                <input type="search" id="search" class="form-control" placeholder="چستجو کردن شرکت ">
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


    {{-- Customer section --}}
    <section class=" paginate">
       <div class="row">
            @foreach ($companies as $row)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 paginate-item" id="row{{$row->id}}">
                    <div class="card">
                        <div class="card-body pt-2">
                            <div class="row mt-50">
                                <div class="col-5">
                                    <div>
                                      <a href="{{url('companies/info')}}/{{$row->id}}">
                                        @if (empty($row->company_photo))
                                            <img src="{{asset('public/assets/images/company.jpg')}}" alt="img" class="ml-50" style="width:100%; height:100px; object-fit:cover;">
                                        @else
                                            <img src="{{asset('storage/app')}}/{{$row->company_photo}}" alt="img" class="ml-50" style="width:100%; height:100px; object-fit:cover;">
                                        @endif
                                      </a>
                                    </div>
                                </div>
                                <div  style="position: absolute; margin-right:5px;">
                                    <div class="btn-group">
                                        <a   data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" style="font-size:21px"></i>
                                        </a>
                                        <ul class="dropdown-menu p-1 ellipss" role="menu">
                                            <a href="{{url('companies/info')}}/{{$row->id}}"  class="d-flex align-items-center see" ><span class="feather icon-eye mr-50"></span><li >دیدن گزارشات</li></a>
                                            <hr>
                                            <a href="#" data-id="{{$row->id}}"  class="d-flex align-items-center edit" data-toggle="modal" data-target="#edit-item" ><span class="feather icon-edit mr-50"></span><li >ویرایش کردن</li></a>
                                            <hr>
                                            <li><a href="#"class="d-flex align-items-center delete" data-id="{{$row->id}}" ><span class="feather icon-trash mr-50"></span>حذف کردن</a></li>                  
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <a href="{{url('companies/info')}}/{{$row->id}}">
                                        <h6 class="mt-50  text-primary" >{{$row->company_name}}</span></h6>
                                    </a>
                                    <h6 class="mt-1 small " style="direction: ltr !important"> 
                                        @if (empty($row->phone_number))
                                            ----------------
                                        @else
                                           <span class="font"> {{$row->phone_number}} </span>
                                        @endif
                                    <span class="feather icon-phone mr-50 icon-size"></span></h6>
                                    <h6 class="mt-1 small d-flex" ><i class="icon-pointer mr-50 icon-size"></i> {{$row->location}} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
       </div>
    </section>{{-- End Customer section --}}


    <!-- Pagination -->
    <section class="mb-1">
        <nav aria-label="Page navigation" >
            <ul class="pagination justify-content-end" id="pagination">
                <li class="page-item prve"><a class="page-link" href="#" ><span aria-hidden="true">قبلی</span></a></li>
                
                <li class="page-item next"><a class="page-link" href="#" ><span aria-hidden="true">بعدی</span></a></li>
            </ul>
        </nav>
    </section> <!-- End Pagination -->




    <!-- Create Modal -->
    <div class="modal fade text-left" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content p-1">
            <div class="modal-header">
              <h5 class="modal-title">اضافه کردن شرکت</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form" id="createform">
                <div class="modal-body">
                    <div class="alert alert-create alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="name">نام شرکت <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"  placeholder="نام " id="name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="phone_number">شماره تماس</label>
                                <input type="text" class="form-control phone font" name="phone_number"  placeholder="شماره تماس" id="phone_number" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location">موقعیت شرکت  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" id="location" placeholder="موقعیت ">
                    </div>
                    <div class="form-group" id="overphoto">
                        <label for="photo">عکس شرکت <small>(اختیاری)</small> <small>( 200KB حداکثر)</small></label>
                        <input type="file" class="form-control  dropify" id="dropify"  data-height="170"  data-max-file-size="0.2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="شرکت عکس "  >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">لغو کردن</button>
                    <button type="submit" class="btn btn-primary">اضافه کردن</button> 
                </div>
            </form>
          </div>
        </div>
      </div><!-- End Create Modal -->



       <!-- Edit Modal -->
    <div class="modal fade text-left" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content p-1">
            <div class="modal-header">
              <h5 class="modal-title">ویرایش کردن شرکت</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form" id="editform">
                <div class="modal-body">
                    <div class="alert alert-edit alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="name">نام شرکت <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"  placeholder="نام " id="edit_name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="phone_number">شماره تماس</label>
                                <input type="text" class="form-control phone font" name="phone_number"  placeholder="شماره تماس" id="edit_phone_number" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location">موقعیت شرکت  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" id="edit_location" placeholder="موقعیت ">
                    </div>
                    <div class="form-group" id="myphoto">
                        <label for="photo">عکس شرکت <small>(اختیاری)</small> <small>( 200KB حداکثر)</small></label>
                        <input type="file" class="form-control "  data-default-file=" "  id="edit_photo" data-height="170"  data-max-file-size="0.2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="شرکت عکس "  >
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">لغو کردن</button>
                    <button type="submit" class="btn btn-primary">ذخیره ویرایش</button> 
                </div>
            </form>
          </div>
        </div>
      </div><!-- End Edit Modal -->



@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('public/assets/dropify.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
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
         var page_of_num=9;
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
                if(text_num<=numb_page){
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


 {{-- input code --}}
 <script>
    $(document).ready(function() {
        $('.phone').inputmask('00-999-999-999-999');

        $('.dropify').dropify({
            messages: {
                'default': 'یک فایل را در اینجا بکشید و یا کلیک کنید',
                'replace': 'فایل را اینجا بکشید یا کلیک کنید تا جایگزین شود',
                'remove':  'حذف',
                'error':   'اوه, مشکلی پیش آمده .'
            },
            error: {
                'fileSize': 'اندازه فایل بزرگ است (200KB حداکثر).',
            },
        });
    });
 </script> {{-- input code --}}








    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('.alert').hide();
            $('#createform').trigger("reset");
            $("#dropify").trigger( "change" );
            $('#name').removeClass(' is-invalid');
            $('#location').removeClass(' is-invalid');

            var html='<label for="photo">فایل بل <small>(اختیاری)</small> <small>( 0.2MB حداکثر)</small></label>'
            html += '<input type="file" class="form-control "   id="photo" data-height="170"  data-max-file-size="0.2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="شرکت عکس "  >';
            $('#overphoto').html(html);
            $("#photo").addClass('dropify');
            $('.dropify').dropify({
                messages: {
                    'default': 'یک فایل را در اینجا بکشید و یا کلیک کنید',
                    'replace': 'فایل را اینجا بکشید یا کلیک کنید تا جایگزین شود',
                    'remove':  'حذف',
                    'error':   'اوه, مشکلی پیش آمده .'
                },
                error: {
                    'fileSize': 'اندازه فایل بزرگ است (200KB حداکثر).',
                },
            });

        });

        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#name').removeClass(' is-invalid');
            $('#location').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("companies") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.paginate').load(document.URL + ' .paginate');
                    $('#create-item').modal('hide');
                    $('#createform')[0].reset();
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
                    $(".alert-create").find("ul").html('');
                    $(".alert-create").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert-create").find("ul").append('<li>' + value + '</li>');
                        if(key=='name'){
                            $('#name').addClass(' is-invalid');
                        }
                        if(key=='location'){
                            $('#location').addClass(' is-invalid');
                        }
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
        $('#name').on('keypress',function(){
            $('#name').removeClass(' is-invalid');
        });
        $('#location').on('keypress',function(){
            $('#location').removeClass(' is-invalid');
        });
    </script>{{-- create item --}}



    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert').hide();
            $('#edit_name').removeClass(' is-invalid');
            $('#edit_location').removeClass(' is-invalid');
            $('#editform').trigger("reset");
            var id=$(this).attr('data-id');
            var url ='{{url("companies")}}/'+id+'/edit';
            $.get(url,function(data){
                $('#edit_name').val(data.company_name);
                $('#edit_phone_number').val(data.phone_number);
                $('#edit_location').val(data.location);
                $('#hidden_id').val(data.id);

                var html='<label for="photo">فایل بل <small>(اختیاری)</small> <small>( 0.2MB حداکثر)</small></label>'
                html += '<input type="file" class="form-control "  data-default-file="'+"{{url('storage/app')}}/"+data.company_photo+' "  id="edit_photo" data-height="170"  data-max-file-size="0.2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="شرکت عکس "  >';
                $('#myphoto').html(html);
                $("#edit_photo").addClass('dropify1');
                $('#edit_photo').attr("data-default-file","{{url('storage/app')}}/"+data.company_photo);
                $('.dropify1').dropify({
                    messages: {
                        'default': 'یک فایل را در اینجا بکشید و یا کلیک کنید',
                        'replace': 'فایل را اینجا بکشید یا کلیک کنید تا جایگزین شود',
                        'remove':  'حذف',
                        'error':   'اوه, مشکلی پیش آمده .'
                    },
                    error: {
                        'fileSize': 'اندازه فایل بزرگ است (200KB حداکثر).',
                    },
                });
            });
        });

        $("#editform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#edit_name').removeClass(' is-invalid');
            $('#edit_location').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("companies_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.paginate').load(document.URL + ' .paginate');
                    $('#edit-item').modal('hide');
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
                    $(".alert-edit").find("ul").html('');
                    $(".alert-edit").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert-edit").find("ul").append('<li>' + value + '</li>');
                        if(key=='name'){
                            $('#edit_name').addClass(' is-invalid');
                        }
                        if(key=='location'){
                            $('#edit_location').addClass(' is-invalid');
                        }
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
        $('#edit_name').on('keypress',function(){
            $('#edit_name').removeClass(' is-invalid');
        });
        $('#edit_location').on('keypress',function(){
            $('#edit_location').removeClass(' is-invalid');
        });
    </script>{{-- Edit item --}}




    
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
                       url:'{{url("companies")}}/'+id,
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
                               'شرکت دیتا های مرتبط دارد',
                               'error'
                           )
                       }
                   });
               }
           })
       });
</script>{{-- End delete form --}}





@endsection
