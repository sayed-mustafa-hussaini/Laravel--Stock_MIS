@extends('layouts.layout')

@section('site-title')
    Customers
@endsection
@section('header-title')
    <li class="breadcrumb-item"><a href="{{url('customers')}}">مشتریان</a></li>
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
            font-size: 18px !important; 
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
        <button type="button" class="btn btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item"><i class="icon icon-plus mr-1"></i> اضافه کردن مشتری</button>
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
                                <input type="search" id="search" class="form-control" placeholder="چستجو کردن مشتری ">
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
            @foreach ($customers as $row)
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 paginate-item" id="row{{$row->id}}">
                    <div class="card">
                        <div class="card-header pb-1">
                            <div class="btn-group">
                                <a   data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v" style="font-size:21px"></i>
                                </a>
                                <ul class="dropdown-menu p-1 ellipss" role="menu">
                                    <a href="#" data-id="{{$row->id}}"  class="d-flex align-items-center edit" data-toggle="modal" data-target="#edit-item" ><span class="feather icon-edit mr-50"></span><li >ویرایش کردن</li></a>
                                    <hr>
                                    <li><a href="#"class="d-flex align-items-center delete" data-id="{{$row->id}}" ><span class="feather icon-trash mr-50"></span>حذف کردن</a></li>                  
                                </ul>
                            </div>
                        </div>
                
                        <div class="card-body pt-0">
                            <div class="">
                                <h6 class=" mt-1 d-flex"><span class="feather icon-user mr-50 icon-size text-right"></span> <span>{{$row->firstname}} {{$row->lastname}}</span></h6>
                                <h6 class="mt-2 " style="direction: ltr !important"><span class="font">  {{$row->phone_number}} </span> <span class="feather icon-phone mr-50 icon-size"></span></h6>
                                <h6 class="mt-1" ><span class="feather icon-map mr-50 icon-size"></span> {{$row->province}} </h6>
                                <a href="{{route('customerInfo')}}/{{$row->id}}" type="button" class="btn btn-primary w-100 py-50 mt-1 mb-50"> <span> دیدن مشخصات </span> <i class="feather icon-chevrons-left"></i>  </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
       </div>
    </section>{{-- End Customer section --}}


    <!-- Pagination -->
    <section class="my-1">
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
              <h5 class="modal-title">اضافه کردن مشتری</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form" id="createform">
                <div class="modal-body">
                    <div class="alert alert1 alert-danger">
                        <ul id="error"></ul>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="firstname">نام مشتری <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname"  placeholder="نام " id="one">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="lastname">تخلص مشتری  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname"  placeholder="تخلص" id="two" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="phone_number">شماره تماس <span class="text-danger">*</span></label>
                                <input type="text" class="form-control phone font" name="phone_number"  placeholder="شماره تماس" id="there" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="province"> ولایت <span class="text-danger">*</span></label>
                                <select class="select2 custom-select block province province1 border-danger" name="province" style="width:100%" id="four">
                                    <option selected disabled>اتنخاب کردن ولایت </option>
                                    <option value="ارزگان"  >ارزگان</option>
                                    <option value="بادغیس">بادغیس</option>
                                    <option value="بامیان">بامیان</option>
                                    <option value="بدخشان">بدخشان</option>
                                    <option value="بغلان">بغلان</option>
                                    <option value="بلخ">بلخ</option>
                                    <option value="پروان">پروان</option>
                                    <option value="پکتیا">پکتیا</option>
                                    <option value="پکتیکا">پکتیکا</option>
                                    <option value="پنجشیر">پنجشیر</option>
                                    <option value="تخار">تخار</option>
                                    <option value="جوزجان">جوزجان</option>
                                    <option value="خوست">خوست</option>
                                    <option value="دایکندی">دایکندی</option>
                                    <option value="زابل">زابل</option>
                                    <option value="سرپل">سرپل</option>
                                    <option value="سمنگان">سمنگان</option>
                                    <option value="غزنی">غزنی</option>
                                    <option value="غور">غور</option>
                                    <option value="فاریاب">فاریاب</option>
                                    <option value="فراه">فراه</option>
                                    <option value="کابل">کابل</option>
                                    <option value="کاپیسا">کاپیسا</option>
                                    <option value="کندز">کندز</option>
                                    <option value="کندهار">کندهار</option>
                                    <option value="کنر">کنر </option>
                                    <option value="لغمان">لغمان</option>
                                    <option value="لوگر">لوگر</option>
                                    <option value="ننگرهار">ننگرهار</option>
                                    <option value="نورستان">نورستان</option>
                                    <option value="نیمروز">نیمروز</option>
                                    <option value="هـلــمنـد">هـلــمنـد</option>
                                    <option value="هرات">هرات</option>
                                    <option value="وردک">وردک</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo">عکس مشتری <small>(اختیاری)</small> <small>( 200KB حداکثر)</small></label>
                        <input type="file" class="form-control  dropify" id="dropify" id="input-file-now" data-height="170"  data-max-file-size="0.2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="عکس مشتری"  >
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
        <div class="modal-dialog " role="document">
          <div class="modal-content p-1">
            <div class="modal-header">
              <h5 class="modal-title">ویرایش کردن مشتری</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form" id="editform">
                <div class="modal-body">
                    <div class="alert alert1 alert-edit alert-danger">
                        <ul id="error"></ul>
                    </div>
                    {{-- <div class="row mt-1">
                        <div class="col-lg-6 col-md-6"> --}}
                            <div class="form-group">
                                <label for="firstname">نام مشتری <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname"  placeholder="نام " id="firstname">
                            </div>
                        {{-- </div>
                        <div class="col-lg-6 col-md-6"> --}}
                            <div class="form-group">
                                <label for="lastname">تخلص مشتری  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname"  placeholder="تخلص" id="lastname" >
                            </div>
                        {{-- </div>
                    </div> --}}
                    {{-- <div class="row"> --}}
                        {{-- <div class="col-lg-6 col-md-6"> --}}
                            <div class="form-group">
                                <label for="phone_number">شماره تماس <span class="text-danger">*</span></label>
                                <input type="text" class="form-control phone font" name="phone_number"  placeholder="شماره تماس" id="phone_number" >
                            </div>
                        {{-- </div>
                        <div class="col-lg-6 col-md-6"> --}}
                            <div class="form-group">
                                <label for="province"> ولایت <span class="text-danger">*</span></label>
                                <select class="select2 custom-select block province province2 border-danger " name="province" style="width:100%" id="province">
                                    <option selected disabled>اتنخاب کردن ولایت </option>
                                    <option value="ارزگان"  >ارزگان</option>
                                    <option value="بادغیس">بادغیس</option>
                                    <option value="بامیان">بامیان</option>
                                    <option value="بدخشان">بدخشان</option>
                                    <option value="بغلان">بغلان</option>
                                    <option value="بلخ">بلخ</option>
                                    <option value="پروان">پروان</option>
                                    <option value="پکتیا">پکتیا</option>
                                    <option value="پکتیکا">پکتیکا</option>
                                    <option value="پنجشیر">پنجشیر</option>
                                    <option value="تخار">تخار</option>
                                    <option value="جوزجان">جوزجان</option>
                                    <option value="خوست">خوست</option>
                                    <option value="دایکندی">دایکندی</option>
                                    <option value="زابل">زابل</option>
                                    <option value="سرپل">سرپل</option>
                                    <option value="سمنگان">سمنگان</option>
                                    <option value="غزنی">غزنی</option>
                                    <option value="غور">غور</option>
                                    <option value="فاریاب">فاریاب</option>
                                    <option value="فراه">فراه</option>
                                    <option value="کابل">کابل</option>
                                    <option value="کاپیسا">کاپیسا</option>
                                    <option value="کندز">کندز</option>
                                    <option value="کندهار">کندهار</option>
                                    <option value="کنر">کنر </option>
                                    <option value="لغمان">لغمان</option>
                                    <option value="لوگر">لوگر</option>
                                    <option value="ننگرهار">ننگرهار</option>
                                    <option value="نورستان">نورستان</option>
                                    <option value="نیمروز">نیمروز</option>
                                    <option value="هـلــمنـد">هـلــمنـد</option>
                                    <option value="هرات">هرات</option>
                                    <option value="وردک">وردک</option>
                                </select>
                            </div>
                        {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <div class="form-group">
                        <label for="photo">عکس مشتری <small>(اختیاری)</small> <small>( 200KB حداکثر)</small></label>
                        <input type="file" class="form-control  dropify photo" id="dropify" id="input-file-now" data-height="170"   data-max-file-size="0.2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="عکس مشتری"  >
                    </div> --}}
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
        $('.phone').inputmask('0-999-999-999');

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

        $('.province1').select2();
        $('.province2').select2();
    });

 </script> {{-- input code --}}








    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('.alert').hide();
            $('#createform').trigger("reset");
            $(".province1").trigger( "change" );
            $("#dropify").trigger( "change" );
            $('#one').removeClass(' is-invalid');
            $('#two').removeClass(' is-invalid');
            $('#there').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-red');
        });

        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#one').removeClass(' is-invalid');
            $('#two').removeClass(' is-invalid');
            $('#there').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-red');
            $.ajax({
                url: '{{ url("customers") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                   
                    location.reload(true); 
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
                    $(".alert").find("ul").html('');
                    $(".alert").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert").find("ul").append('<li>' + value + '</li>');
                        if(key=='firstname'){
                            $('#one').addClass(' is-invalid');
                        }
                        if(key=='lastname'){
                            $('#two').addClass(' is-invalid');
                        }
                        if(key=='phone_number'){
                            $('#there').addClass(' is-invalid');
                        }
                        if(key=='province'){
                            $('.select2-selection--single').addClass(' border-red');
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
        $('#one').on('keypress',function(){
            $('#one').removeClass(' is-invalid');
        });
        $('#two').on('keypress',function(){
            $('#two').removeClass(' is-invalid');
        });
        $('#there').on('keypress',function(){
            $('#there').removeClass(' is-invalid');
        });
        $('.select2-selection--single').on('change',function(){
            $('.select2-selection--single').removeClass(' border-red');
        }); 
    </script>{{-- create item --}}




    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert').hide();
            $("#dropify").trigger( "change" );
            $('#firstname').removeClass(' is-invalid');
            $('#lastname').removeClass(' is-invalid');
            $('#phone_number').removeClass(' is-invalid');
            var id=$(this).attr('data-id');
            var url ='{{url("customers")}}/'+id+'/edit';
            $.get(url,function(data){
                $('#firstname').val(data.firstname);
                $('#lastname').val(data.lastname);
                $('#phone_number').val(data.phone_number);
                $('#province').val(data.province).change();
                $('#hidden_id').val(data.id);
                $('.photo').attr('data-default-file','{{url("storage/app")}}/'+data.photo);
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
            $('#firstname').removeClass(' is-invalid');
            $('#lastname').removeClass(' is-invalid');
            $('#phone_number').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("customers_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    // $('.paginate').load(document.URL + ' .paginate');
                    location.reload(true); 
                    $('#edit-item').modal('hide');
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
                    $(".alert").find("ul").html('');
                    $(".alert").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert").find("ul").append('<li>' + value + '</li>');
                        if(key=='firstname'){
                            $('#firstname').addClass(' is-invalid');
                        }
                        if(key=='lastname'){
                            $('#lastname').addClass(' is-invalid');
                        }
                        if(key=='phone_number'){
                            $('#phone_number').addClass(' is-invalid');
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
        $('#firstname').on('keypress',function(){
            $('#firstname').removeClass(' is-invalid');
        });
        $('#lastname').on('keypress',function(){
            $('#lastname').removeClass(' is-invalid');
        });
        $('#phone_number').on('keypress',function(){
            $('#phone_number').removeClass(' is-invalid');
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
                       url:'{{url("customers")}}/'+id,
                       type:'Delete',
                       success:function(data){ 
                           Swal.fire(
                               'موفقانه حذف شد !',
                               'فایل شما حذف شده است.',
                               'success'
                           )
                           $('#row'+id).hide(1500);
                            setTimeout(function(){
                                location.reload(true);
                            }, 2500); 
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
                               'مشتری دیتا های مرتبط دارد',
                               'error'
                           )
                       }
                   });
               }
           })
       });
</script>{{-- End delete form --}}





@endsection
