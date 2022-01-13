@extends('layouts.layout')

@section('site-title')
    Stock-Out
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('stock')}}">گدام</a></li>
    <li class="breadcrumb-item">  جنس های خارج شده </li>

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

    </style>

@endsection
@section('body')





<section id="basic-form-layouts">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-head mb-50">
                    <div class="card-header">
                        <div class="heading-elements mt-0 mr-1">
                            <button type="button" class="btn btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item">
                                <i class="icon icon-plus mr-1"></i> اضافه کردن جنس خارج شده</button>
                        </div>
                    </div>
                </div>
                <div class="card-content mt-2">
                    <div class="card-body">
                        <!-- Purchases table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table text-center table-striped table-lg table-white-space row-grouping  no-wrap table-middle" >
                                <thead class="border-botto">
                                  <tr>
                                     <th>#</th>
                                    <th> نام جنس </th>
                                    <th>کارمند خارج کننده</th>
                                    <th>تعداد جنس</th>
                                    <th>تاریخ خارج</th>
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
                                                <small style="color:#919ca7 !important" class="font">{{$row->user_email}}</small>
                                            </td>

                                            <td>
                                                @if ($row->quantity_goods<=0)
                                                    <span class="badge badge-danger badge-pill">{{$row->quantity_goods}}  دانه </span>
                                                @else
                                                    <span class="badge badge-warning badge-pill"><span class="font">{{$row->quantity_goods}} </span> دانه </span>
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
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-employee-id="{{$row->employee_id}}" data-goods-id="{{$row->goods_id}}" data-id="{{$row->id}}" data-goods="  {{ $row->category_name }} {{ $row->type_of }} {{ $row->goods_name }}" data-quantity="{{$row->quantity_goods}}" ><i class="fa fa-pencil"></i></a>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div><!-- Purchases table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--  layout section end -->



<!-- Create Modal -->
<div class="modal fade text-left" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">اضافه کردن جنس خارج شده از گدام</h5>
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
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text goods_value" id="sizing-addon2">00</span>
                            </div>
                            <input type="number" class="form-control" min="0" max="1000000" name="quantity_goods"  placeholder=" تعداد جنس خارج شده" id="quantity_goods">
                        </div> 
                    </div>
                    <div class="form-group div_emoloyee_name">
                        <label for="emoloyee_name">کارمند خارج کننده<span class="text-danger">*</span></label>
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
                        <div class="input-group">
                            <input type="number"  class="form-control" min="0" max="1000000" name="quantity_goods"  placeholder="تعداد جنس " id="edit_quantity_goods">
                            <div class="input-group-append">
                                <span class="input-group-text edit_goods_value" id="sizing-addon2">تعداد مجموعه جنس های موجود 0 دانه</span>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group div_emoloyee_name">
                        <label for="emoloyee_name">کارمند خارج کننده<span class="text-danger">*</span></label>
                        <select class="select2 custom-select block emoloyee_name" name="emoloyee_name" style="width:100%" id="edit_emoloyee_name">
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
            $('#purchases-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('.goods_name').select2();
            $('.edit_goods_name').select2();
            $('.emoloyee_name').select2();
        });
        $('.alert').hide();


    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $("#emoloyee_name").trigger( "change" );
            $('#quantity_goods').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $('.goods_value').text('  تعداد مجموعه جنس های موجود 0 دانه ');
        });

        $('#goods_name').on('change',function(){
                $goods_id=$('#goods_name').val();
                var url="stock_out/"+$goods_id+"/get_quantity";
                $.get(url,function(data){
                    var quantity=data[0].quantity_goods
                    $('.goods_value').text(' تعداد مجموعه جنس های موجود'+' '+quantity+' دانه');
                })
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
                url: '{{ url("stock_out") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.table').load(document.URL + ' .table');
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
            var goods_id=$(this).attr('data-goods-id');
            url="stock_out/"+goods_id+"/get_quantity";
            $.get(url,function(data){
                var quantity=data[0].quantity_goods
                $('.edit_goods_value').text(' تعداد مجموعه جنس های موجود'+' '+quantity+' دانه');
            });


            var employee_id=$(this).attr('data-employee-id');
            $('#edit_emoloyee_name').val(employee_id).trigger("change");            
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
                url: '{{ url("stock_out_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#edit-item').modal('hide');
                    $('.table').load(document.URL + ' .table');
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
                        url:'{{url("stock_out")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
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
                                'دیتا های مرتبط دارد',
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>{{-- End delete form --}}



@endsection
