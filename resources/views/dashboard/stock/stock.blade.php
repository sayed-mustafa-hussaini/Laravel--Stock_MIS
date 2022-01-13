@extends('layouts.layout')

@section('site-title')
    Stock
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('stock')}}">گدام</a></li>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/forms/selects/select2.min.css')}}">

    <style>
        .dataTables_wrapper {
            direction: rtl !important;
        }
        .dataTables_length {
            float: right !important;
            margin-bottom: 10px !important;
        }
        .dataTables_filter {
            float: left !important;
            text-align: left !important;
            margin-bottom: 10px !important;
        }

        .dataTables_filter label input {
           margin-right:10px !important;
        }
        
        .dataTables_info {
            float: right !important;
            margin-top: 10px !important;
        }
        .dataTables_paginate {
            float: left !important;
            text-align: left !important;
            margin-top: 10px !important;
        }
        @media screen and (max-width:767px){
            .dataTables_length {
                float: right !important;
            }
            .dataTables_filter {
                float: right !important;
            }
            .dataTables_info {
                float: right !important;
            }
            .dataTables_paginate {
                float: right !important;
            }
        }
        .table.dataTable.no-footer{
            border:0 !important;
        }

        .dropdown-toggle::after{
            display:none !important;   
        }

        .table tr td{
            border:none !important;
        }


        .table thead th{
            border-bottom:1px solid #E6E6E6 !important;
        }
        .table tbody td{
            border-bottom:1px solid #E6E6E6 !important;
        }
        
        .nav.nav-tabs.nav-underline .nav-item a.nav-link.active{
            color:#2DCEE3 !important;
        }

         .nav.nav-tabs.nav-underline .nav-item a.nav-link {
            color:#404E67 ;
        }

        .d-sm-block {
            display: block!important;
        }

        @media screen and (max-width:520px){
            .align-items-stretch .media-right h2{
                font-size:16px !important;
            }
            .align-items-stretch .media-body h5{
                font-size:14px !important;
            }
        }
        

    </style>

@endsection
@section('body')



<section>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs mb-5  nav-underline no-hover-bg nav-justified " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active  px-1" id="account-tab" data-toggle="tab"
                            href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="icon-wallet mr-50"></i><span class="d-none d-sm-block">  جنس های موجود در گدام </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center px-1" id="information-tab" data-toggle="tab"
                            href="#information" aria-controls="information" role="tab" aria-selected="false">
                            <i class="icon-clock mr-50"></i><span class="d-none d-sm-block"> تاریخ  جنس های ذخیره شده در گدام </span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content mt-3 mb-2">
                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-xl-6 col-md-6 col-sm-12">
                              <div class="card ">
                                <div class="card-content  shadow">
                                  <div class="media align-items-stretch">
                                    <div class="bg-primary p-2 media-middle">
                                      <i class="icon-pencil font-large-2 white"></i>
                                    </div>
                                    <div class="media-body p-2">
                                      <h5>مجموعه کل جنس های موجود</h5>
                                    </div>
                                    <div class="media-right p-2 media-middle ">
                                      <h2 class="primary total_goods"><span class="font"> {{$total_goods}}  </span><span class="small" style="font-size:15px">دانه</span></h2>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12">
                              <div class="card ">
                                <div class="card-content  shadow">
                                  <div class="media align-items-stretch">
                                    <div class="bg-warning p-2 media-middle">
                                      <i class="icon-speech font-large-2  white"></i>
                                    </div>
                                    <div class="media-body p-2">
                                      <h5>انواع جنس های موجود</h5>
                                    </div>
                                    <div class="media-right p-2 media-middle">
                                      <h1 class="warning font">{{$total_goods_type}}</h1>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="heading-elements mt-0 mr-1  text-right">
                            <button type="button" class="btn  btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item">
                                <i class="icon icon-plus mr-1"></i> اضافه کردن جنس در گدام</button>
                        </div>
                        <!-- Stock table -->
                        <div class="table-responsive mt-2 pt-75">
                            <table id="stock-table" class="table text-center table-striped table-lg table-white-space row-grouping  no-wrap table-middle stock-table" >
                                <thead class="border-botto">
                                    <tr>
                                        <th>#</th>
                                        <th> نام جنس </th>
                                        <th>تعداد جنس</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($stocks as $row)
                                        <tr id="row">
                                            <td>{{$counter++}}</td>
                                            <td class="text-primary"> {{ $row->category_name }} {{ $row->type_of }} {{ $row->goods_name }}</td>
                                            <td>
                                                @if ($row->quantity_goods<=0)
                                                    <span class="badge badge-danger badge-pill">{{$row->quantity_goods}}  دانه </span>
                                                @else
                                                    <span class="badge badge-success badge-pill"><span class="font">{{$row->quantity_goods}} </span> دانه </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}" data-goods="  {{ $row->category_name }} {{ $row->type_of }} {{ $row->goods_name }}" data-quantity="{{$row->quantity_goods}}" ><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- Stock table -->
                    </div>

                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                        <!-- History table -->
                        <div class="table-responsive">
                            <table id="stock-history" class="table text-center table-striped table-lg table-white-space row-grouping  no-wrap table-middle stock-history" >
                                <thead class="border-botto">
                                    <tr>
                                        <th>#</th>
                                        <th> نام جنس </th>
                                        <th>کارمند ذخیره کننده</th>
                                        <th>تعداد جنس</th>
                                        <th>تاریخ ذخیره</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($stockHistory as $row)
                                        <tr id="row{{$row->id}}">
                                            <td>{{$counter++}}</td>
                                            <td> {{ $row->category_name }} {{ $row->type_of }} {{ $row->goods_name }}</td>
                                            <td>
                                                <span> {{$row->username}} {{$row->user_lastname}}</span><br>
                                                <small style="color:#919ca7 !important">{{$row->user_email}}</small>
                                            </td>
                                            <td>
                                                @if ($row->quantity_goods<=0)
                                                    <span class="badge badge-danger badge-pill">{{$row->quantity_goods}}  دانه </span>
                                                @else
                                                    <span class="badge badge-success badge-pill"><span class="font">{{$row->quantity_goods}}</span>  دانه </span>
                                                @endif
                                            </td>
                                            <td class="pb-50" style="direction: ltr">
                                                <span class="font">
                                                    @php
                                                        $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->created_at));
                                                        echo $date;
                                                    @endphp     
                                                </span><br>
                                                <small style="color:#919ca7 !important" class="font">
                                                    @php
                                                        $date_tiem= \Morilog\Jalali\CalendarUtils::strftime('a ', strtotime($row->created_at));
                                                        $date_tiem=\Morilog\Jalali\CalendarUtils::convertNumbers($date_tiem) ;
                                                        echo $date_tiem;
                                                        $time=date_create($row->created_at);
                                                        echo date_format($time,'h:i:s');
                                                    @endphp 
                                                </small>
                                            </td>
                                            <td>
                                                {{-- <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}" data-goods="  {{ $row->category_name }} {{ $row->type_of }} {{ $row->goods_name }}" data-quantity="{{$row->quantity_goods}}" ><i class="fa fa-pencil"></i></a> --}}
                                                {{-- <a data-toggle="modal" data-target="#edit-item" class="warning edit mr-1" data-id="{{$row->id}}"  ><i class="fa fa-bar-chart"></i></a> --}}
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        </div><!-- History table -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>






<!-- Create Modal -->
<div class="modal fade text-left" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">اضافه کردن جنس در گدام</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="createform">
                <div class="modal-body">
                    <div class="alert alert-create alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group div_goods_name">
                        <label for="goods_name">نام جنس <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block goods_name" name="goods_name" style="width:100%" id="goods_name">
                            <option  disabled  selected> اتنخاب کردن جنس </option>
                            @foreach ($goods as $item)
                                <option value="{{$item->id}}"> {{$item->category_name}} {{$item->type_of}} {{$item->name}} </option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" min="0" max="1000000" name="quantity_goods"  placeholder="تعداد جنس " id="quantity_goods">
                    </div>
                    <div class="form-group div_emoloyee_name">
                        <label for="emoloyee_name">کارمند <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block emoloyee_name" name="emoloyee_name" style="width:100%" id="emoloyee_name">
                            <option  disabled  selected> اتنخاب کردن کارمند </option>
                            @foreach ($employees as $item)
                                <option value="{{$item->id}}"> 
                                   ( {{ $item->email }} )
                                    {{ $item->name }}
                                    {{ $item->lastname }}
                                 </option>
                            @endforeach 
                        </select>
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
                <h5 class="modal-title">ویرایش کردن تعداد جنس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="editform">
                <div class="modal-body">
                    <div class="alert alert-edit alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group">
                        <label for="edit_goods_name">نام جنس <span class="text-danger">*</span></label>
                        <input class="form-control" disabled  placeholder="نام جنس " id="edit_goods_name">
                    </div>
                    <div class="form-group">
                        <label for="edit_quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                        <input type="number"  class="form-control" min="0" max="1000000" name="quantity_goods"  placeholder="تعداد جنس " id="edit_quantity_goods">
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
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>


    <script src="{{asset('public/assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#stock-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('#stock-history').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('.goods_name').select2();
            $('.edit_goods_name').select2();
            $('.emoloyee_name').select2();
            $('#edit_purchase_date').inputmask({"mask": "99/99/9999", "placeholder": 'DD/MM/YYYY'});;
        });
        $('.alert').hide();
    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $("#goods_name").trigger( "change" );
            $("#emoloyee_name").trigger( "change" );
            $('#quantity_goods').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
        });

        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#quantity_goods').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("stock") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.stock-table').load(document.URL + ' .stock-table');
                    $('.stock-history').load(document.URL + ' .stock-history');
                    $('.total_goods').load(document.URL + ' .total_goods');
                    
                    $('#create-item').modal('hide');
                    $('#createform').trigger("reset");
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
                       
                        if(key=='goods_name'){
                            $('.div_goods_name .select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='quantity_goods'){
                            $('#quantity_goods').addClass(' is-invalid');
                        }
                        if(key=='emoloyee_name'){
                            $('.div_emoloyee_name .select2-selection--single').addClass(' border-danger');
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
       
        $('#goods_name').on('change',function(){
            $('.div_goods_name .select2-selection--single').removeClass(' border-danger');
        });
        $('#quantity_goods').on('keypress',function(){
            $('#quantity_goods').removeClass(' is-invalid');
        });
        $('#emoloyee_name').on('change',function(){
            $('.div_goods_name .select2-selection--single').removeClass(' border-danger');
        });
    </script>{{-- create item --}}



    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert-edit').hide();
            $('#editform').trigger("reset");
            
            var id=$(this).attr('data-id');
            var goods=$(this).attr('data-goods');
            var quantity=$(this).attr('data-quantity');

            $('#edit_goods_name').val(goods);
            $('#edit_quantity_goods').val(quantity);
            $('#hidden_id').val(id);
            $('#edit_quantity_goods').removeClass(' is-invalid');
        });

        $("#editform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });

            $('#edit_quantity_goods').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("stock_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#edit-item').modal('hide');
                    $('.stock-table').load(document.URL + ' .stock-table');
                    $('.total_goods').load(document.URL + ' .total_goods');
                    $('.stock-history').load(document.URL + ' .stock-history');
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
                        if(key=='quantity_goods'){
                            $('#edit_quantity_goods').addClass(' is-invalid');
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
        $('#edit_quantity_goods').on('keypress',function(){
            $('#edit_quantity_goods').removeClass(' is-invalid');
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
                        url:'{{url("stock")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
                            $('.stock-table').load(document.URL + ' .stock-table');
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
                                'جنس دیتا های مرتبط دارد',
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>{{-- End delete form --}}



@endsection
