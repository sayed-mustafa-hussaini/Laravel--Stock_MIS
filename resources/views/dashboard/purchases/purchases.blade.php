@extends('layouts.layout')

@section('site-title')
    Purchases
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('goods')}}">خریدها</a></li>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/app-invoice.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/dropify.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/forms/selects/select2.min.css')}}">

    <style>
        table tbody  tr:nth-child(odd) .counter{
            background-color: #f1f1f1 ;
        }
        table tbody  tr:nth-child(even) .counter{
            background-color:#fafafa ;
        }

        table tbody  tr:hover .counter{
            background-color: #ebebeb !important;
        }

        table tbody tr td{
            padding-top:14px !important;
            padding-bottom:14px !important;
        }

        table thead tr th{
            padding-top:14px !important;
            padding-bottom:14px !important;
        }

        .table thead th{
            border-bottom:1px solid #E6E6E6 !important;
            font-size:13px !important;
        }
        .table tbody td{
            border-bottom:1px solid #E6E6E6 !important;
        }
        .table-responsive #purchases-table{
            border:1px solid #E6E6E6 !important;
            border-top: none !important;
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
                                <i class="icon icon-plus mr-1"></i> اضافه کردن خرید</button>
                        </div>
                    </div>
                </div>
                <div class="card-content mt-2">
                    <div class="card-body">
                        <!-- Purchases table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table text-center   table-white-space table-striped display row-grouping  no-wrap icheck table-middle" >
                                <thead class="border-bottom">
                                  <tr>
                                     <th>#</th>
                                     <th>نمبر بل</th>
                                    <th> نام شرکت </th>
                                    <th>تعداد جنس</th>
                                    <th>مجموعه پول</th>
                                    <th>پول پرداخت شده</th>
                                    <th>پول باقی مانده </th>
                                    <th>تاریخ خرید</th>
                                    <th>تنظیمات</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($purchases as $row)
                                        <tr id="row{{$row->id}}" >
                                            <td class="counter">{{$counter++}}</td>
                                            <td class="font">
                                                Bill-{{$row->bill_number}}</a>
                                            </td>
                                            <td>
                                                <a href="{{url('companies/info')}}/{{$row->company_id}}" target="_blank">{{$row->company_name}}</a>
                                            </td>
                                            <td><span class="font" >{{$row->quantity_goods}}</span> <span>دانه</span></td>
                                            <td><span class="font" >{{$row->total_price}}</span> {{$row->currency}} </td>
                                            @php
                                                $total=$row->total_price;
                                                $paid=$row->money_paid;
                                                $maney=$total-($paid+Helper::purchasePayments($row->id));
                                            @endphp
                                            <td>
                                                @if ($maney<=0)
                                                    <span class="bullet bullet-success bullet-sm"></span> <span class="font">{{$row->money_paid}}</span>   {{$row->currency}}
                                                @else 
                                                    <span class="bullet bullet-danger bullet-sm"></span> <span class="font">{{$row->money_paid}}</span>   {{$row->currency}}
                                                @endif
                                               
                                            </td>
                                            <td>
                                                @if ($maney<=0)
                                                    <span class="badge badge-success badge-pill"> رسید </span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">  <span class="font">{{$maney}}</span>   {{$row->currency}}</span>
                                                @endif
                                            </td>
                                            <td><span class="font">{{$row->purchase_date}}</span></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}"><i class="fa fa-pencil"></i></a>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                                <a href="{{url('purchases/info-item')}}/{{$row->id}}" class="success  mr-1" target="_blank"><i class="fa fa-eye"></i></a>
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
                <h5 class="modal-title">اضافه کردن خرید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="createform">
                <div class="modal-body">
                    <div class="alert alert-create alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group">
                        <label for="company_name">نام شرکت <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block company_name" name="company_name" style="width:100%" id="company_name">
                            <option  disabled  selected> اتنخاب کردن شرکت </option>
                            @foreach ($companies as $item)
                                <option value="{{$item->id}}">{{$item->company_name}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="bill_number"> نمبر بل <span class="text-danger">*</span></label>
                                <input type="text" class="form-control size font" name="bill_number"  placeholder="نمبر بل " id="bill_number">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="currency"> واحد پولی <span class="text-danger">*</span></label>
                                <select class="select2 custom-select block" name="currency" style="width:100%" id="currency">
                                    <option  disabled  selected>اتنخاب کردن واحد پولی</option>
                                    <option value="افغانی"  data="" >افغانی</option>
                                    <option value= "دالر"  data="" >دالر</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                                <input type="number" class="form-control font" max="1000000" name="quantity_goods"  placeholder="تعداد جنس " id="quantity_goods">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="purchase_date">تاریخ خرید<span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-left font" style="direction: ltr !important" name="purchase_date"  placeholder="تاریخ" id="purchase_date" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="total_price">مجموعه پول <span class="text-danger">*</span></label>
                                <input type="number" class="form-control font" name="total_price"  placeholder="مجموعه پول " id="total_price">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="money_paid">پول پرداخت شده<span class="text-danger">*</span></label>
                                <input type="number" class="form-control font" name="money_paid"  placeholder="پول پرداخت شده " id="money_paid">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="overphoto">
                        <label for="photo">فایل بل <small>(اختیاری)</small> <small>( 2MB حداکثر)</small></label>
                        <input type="file" class="form-control  dropify" id="dropify"  data-height="170"  data-max-file-size="2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="شرکت عکس "  >
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
                <h5 class="modal-title">ویرایش کردن جنس</h5>
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
                        <label for="edit_company_name">نام شرکت <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block edit_company_name" name="company_name" style="width:100%" id="edit_company_name">
                            <option  disabled  selected> اتنخاب کردن شرکت </option>
                            @foreach ($companies as $item)
                                <option value="{{$item->id}}">{{$item->company_name}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="edit_bill_number"> نمبر بل <span class="text-danger">*</span></label>
                                <input type="text" class="form-control size font" name="bill_number"  placeholder="نمبر بل " id="edit_bill_number">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="edit_currency"> واحد پولی <span class="text-danger">*</span></label>
                                <select class="select2 custom-select block" name="currency" style="width:100%" id="edit_currency">
                                    <option  disabled  selected>اتنخاب کردن واحد پولی</option>
                                    <option value="افغانی"  data="" >افغانی</option>
                                    <option value= "دالر"  data="" >دالر</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="edit_quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                                <input type="number" class="form-control font" max="1000000" name="quantity_goods"  placeholder="تعداد جنس " id="edit_quantity_goods">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="edit_purchase_date">تاریخ خرید<span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-left" style="direction: ltr !important" name="purchase_date"  placeholder="تاریخ" id="edit_purchase_date" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="edit_total_price">مجموعه پول <span class="text-danger">*</span></label>
                                <input type="number" class="form-control font" name="total_price"  placeholder="مجموعه پول " id="edit_total_price">
                            </div>
                            
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="edit_money_paid">پول پرداخت شده<span class="text-danger">*</span></label>
                                <input type="number" class="form-control font" name="money_paid"  placeholder="پول پرداخت شده " id="edit_money_paid">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="myphoto">
                        <label for="photo">فایل بل <small>(اختیاری)</small> <small>( 2MB حداکثر)</small></label>
                        <input type="file" class="form-control"  data-default-file=" "   id="edit_photo"  data-height="170"  data-max-file-size="2M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="شرکت عکس "  >
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
    <script src="{{asset('public/assets/dropify.min.js')}}"></script>


    <script src="{{asset('public/assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#purchases-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('.company_name').select2();
            $('.edit_company_name').select2();
            $('#edit_purchase_date').inputmask({"mask": "99/99/9999", "placeholder": 'DD/MM/YYYY'});
            $('#purchase_date').inputmask({"mask": "99/99/9999", "placeholder": 'DD/MM/YYYY'});
            
        });
        $('.alert').hide();
    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $("#company_name").trigger( "change" );
            $("#dropify").trigger( "change" );
            $('#bill_number').removeClass(' is-invalid');
            $('#quantity_goods').removeClass(' is-invalid');
            $('#total_price').removeClass(' is-invalid');
            $('#money_paid').removeClass(' is-invalid');
            $('#purchase_date').removeClass(' is-invalid');
            $('#currency').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');

            var html='<label for="photo">فایل بل <small>(اختیاری)</small> <small>( 2MB حداکثر)</small></label>'
            html += '<input type="file" class="form-control "   id="photo" data-height="170"  data-max-file-size="2M"   name="photo"  placeholder="فایل بل "  >';
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
                    'fileSize': 'اندازه فایل بزرگ است (2MB حداکثر).',
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
            $('#bill_number').removeClass(' is-invalid');
            $('#quantity_goods').removeClass(' is-invalid');
            $('#total_price').removeClass(' is-invalid');
            $('#money_paid').removeClass(' is-invalid');
            $('#purchase_date').removeClass(' is-invalid');
            $('#currency').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("purchases") }}',
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
                        if(key=='bill_number'){
                            $('#bill_number').addClass(' is-invalid');
                        }
                        if(key=='company_name'){
                            $('.select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='quantity_goods'){
                            $('#quantity_goods').addClass(' is-invalid');
                        }
                        if(key=='total_price'){
                            $('#total_price').addClass(' is-invalid');
                        }
                        if(key=='money_paid'){
                            $('#money_paid').addClass(' is-invalid');
                        }
                        if(key=='purchase_date'){
                            $('#purchase_date').addClass(' is-invalid');
                        }
                        if(key=='currency'){
                            $('#currency').addClass(' is-invalid');
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
        $('#bill_number').on('keypress',function(){
            $('#bill_number').removeClass(' is-invalid');
        });
        $('#company_name').on('keypress',function(){
            $('.select2-selection--single').removeClass(' border-danger');
        });
        $('#quantity_goods').on('keypress',function(){
            $('#quantity_goods').removeClass(' border-danger');
        });
        $('#total_price').on('keypress',function(){
            $('#total_price').removeClass(' is-invalid');
        });
        $('#money_paid').on('change',function(){
            $('#money_paid').removeClass(' is-invalid');
        }); 
        $('#purchase_date').on('change',function(){
            $('#purchase_date').removeClass(' is-invalid');
        }); 
        $('#currency').on('change',function(){
            $('#currency').removeClass(' is-invalid');
        }); 
    </script>{{-- create item --}}



    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert-edit').hide();
            $('#editform').trigger("reset");
            
            var id=$(this).attr('data-id');
            var url ='{{url("purchases")}}/'+id+'/edit';
            $('#myphoto').html(' ');
            $.get(url,function(data){
                $('#edit_bill_number').val(data.bill_number);
                $('#edit_company_name').val(data.company_id).trigger('change');
                $('#edit_quantity_goods').val(data.quantity_goods);
                $('#edit_total_price').val(data.total_price);
                $('#edit_money_paid').val(data.money_paid);
                $('#edit_purchase_date').val(data.purchase_date);
                $('#edit_currency').val(data.currency);
                $('#edit_').val(data.name);
                $('#edit_photo').val(data.photo);
                $('#hidden_id').val(data.id);

                var html='<label for="photo">فایل بل <small>(اختیاری)</small> <small>( 2MB حداکثر)</small></label>'
                html += '<input type="file" class="form-control "  data-default-file="'+"{{url('storage/app')}}/"+data.photo+'"  id="edit_photo" data-height="170"  data-max-file-size="2M"   name="photo"  placeholder="شرکت عکس "  >';
                $('#myphoto').html(html);
                $("#edit_photo").addClass('dropify1');
                $('#edit_photo').attr("data-default-file","{{url('storage/app')}}/"+data.photo);
                $('.dropify1').dropify({
                    messages: {
                        'default': 'یک فایل را در اینجا بکشید و یا کلیک کنید',
                        'replace': 'فایل را اینجا بکشید یا کلیک کنید تا جایگزین شود',
                        'remove':  'حذف',
                        'error':   'اوه, مشکلی پیش آمده .'
                    },
                    error: {
                        'fileSize': 'اندازه فایل بزرگ است (2MB حداکثر).',
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
            $('#edit_bill_number').removeClass(' is-invalid');
            $('#edit_quantity_goods').removeClass(' is-invalid');
            $('#edit_total_price').removeClass(' is-invalid');
            $('#edit_money_paid').removeClass(' is-invalid');
            $('#edit_purchase_date').removeClass(' is-invalid');
            $('#edit_currency').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("purchase_update") }}',
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
                        if(key=='bill_number'){
                            $('#edit_bill_number').addClass(' is-invalid');
                        }
                        if(key=='company_name'){
                            $('.select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='quantity_goods'){
                            $('#edit_quantity_goods').addClass(' is-invalid');
                        }
                        if(key=='total_price'){
                            $('#edit_total_price').addClass(' is-invalid');
                        }
                        if(key=='money_paid'){
                            $('#edit_money_paid').addClass(' is-invalid');
                        }
                        if(key=='purchase_date'){
                            $('#edit_purchase_date').addClass(' is-invalid');
                        }
                        if(key=='currency'){
                            $('#edit_currency').addClass(' is-invalid');
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
        $('#edit_bill_number').on('keypress',function(){
            $('#edit_bill_number').removeClass(' is-invalid');
        });
        $('#edit_company_name').on('keypress',function(){
            $('.select2-selection--single').removeClass(' border-danger');
        });
        $('#edit_quantity_goods').on('keypress',function(){
            $('edit_#quantity_goods').removeClass(' border-danger');
        });
        $('#edit_total_price').on('keypress',function(){
            $('#edit_total_price').removeClass(' is-invalid');
        });
        $('#edit_money_paid').on('change',function(){
            $('#edit_money_paid').removeClass(' is-invalid');
        }); 
        $('#edit_purchase_date').on('change',function(){
            $('#edit_purchase_date').removeClass(' is-invalid');
        }); 
        $('#edit_currency').on('change',function(){
            $('#edit_currency').removeClass(' is-invalid');
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
                        url:'{{url("purchases")}}/'+id,
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
