@extends('layouts.layout')

@section('site-title')
    Receipts
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('receipts')}}">رسید ها</a></li>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/forms/selects/select2.min.css')}}">

    <style>
        

        .table tr td{
            border:none !important;
        }

        table tbody  tr:nth-child(odd) .counter{
            background-color: #f1f1f1 ;
        }
        table tbody  tr:nth-child(even) .counter{
            background-color:#fafafa ;
        }

        table tbody  tr:hover .counter{
            background-color: #ebebeb !important;
        }


        table thead tr th{
            padding-top:14px !important;
            padding-bottom:14px !important;
            border-bottom:1px solid #E6E6E6 !important;
        }

        .table-responsive .table tbody td:last-child , 
        .table-responsive .table thead  th:last-child{
            border-left:1px solid #E6E6E6 !important;
        }

        .table-responsive .table tbody td:first-child , 
        .table-responsive .table thead th:first-child{
            border-right:1px solid #E6E6E6 !important;
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
                <ul class="nav nav-tabs mb-5 nav-top-border  no-hover-bg " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active  px-1" id="account-tab" data-toggle="tab"
                            href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="icon-wallet mr-50"></i><span class="d-none d-sm-block"> قرض های پرداخت نشده </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center px-1" id="information-tab" data-toggle="tab"
                            href="#information" aria-controls="information" role="tab" aria-selected="false">
                            <i class="icon-clock mr-50"></i><span class="d-none d-sm-block"> لیست تمام رسید ها</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content mt-3 mb-2">
                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                  <div class="card-content shadow">
                                    <div class="card-body">
                                      <div class="media d-flex">
                                        <div class="align-self-center">
                                          <i class="icon-graph success font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right total_loans_dollar">
                                          <h3 class="font">{{$total_loans_dollar}}</h3>
                                          <span>  مجموعه قرض دالر</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                  <div class="card-content shadow">
                                    <div class="card-body">
                                      <div class="media d-flex">
                                        <div class="align-self-center">
                                          <i class="icon-speech warning font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right total_loans_af">
                                          <h3 class="font">{{$total_loans_af}}</h3>
                                          <span>مجموعه قرض افغانی</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>  
                            <div class="ccol-xl-4 col-xl-4 col-sm-6 col-12">
                              <div class="card">
                                <div class="card-content shadow">
                                  <div class="card-body">
                                    <div class="media d-flex">
                                      <div class="align-self-center">
                                        <i class="icon-pencil primary font-large-2 float-left"></i>
                                      </div>
                                      <div class="media-body text-right total_NoPayments">
                                        <h3 class="font">{{$total_NoPayments}}</h3>
                                        <span>تعداد بل های پرداخت نشده</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="heading-elements mt-0 mr-1  text-right">
                            <button type="button" class="btn  btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item"><i class="icon icon-plus mr-1"></i> پرداخت قرض  </button>
                        </div>
                          <!-- Payments table -->
                          <div class="table-responsive mt-2 pt-75">
                            <table id="payment-table" class="table text-center   table-white-space table-striped display row-grouping  no-wrap icheck table-middle payment-table" >
                                <thead class="border-bottom">
                                  <tr>
                                     <th>#</th>
                                     <th>نمبر بل</th>
                                    <th> مشخضات مشتری </th>
                                    <th>مقدار قرض</th>
                                    <th>تاریخ قرض</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($loans as $row)
                                        @if ($row->quantity_loan>Helper::getPayments($row->id))
                                            <tr id="row{{$row->id}}" >
                                                <td class="counter">{{$counter++}}</td>
                                                <td class="font">
                                                    Bill-{{$row->bill_num}}
                                                </td>
                                                <td class="primary">
                                                    <a href="{{url('customers/info/')}}/{{$row->customer_id}}" target="_blank">
                                                        <span >{{$row->firstname}}  {{$row->lastname}}</span><br/>
                                                        <small style="color:#717b85 !important" class="font"> ({{$row->province}}) </small>
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger badge-pill"><span class="font">{{$row->quantity_loan-Helper::getPayments($row->id)}}</span>   {{$row->currency}}</span> 
                                                </td>
                                                <td class="pb-50" style="font-size: 13px;direction:ltr">
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
                                                {{-- <td>
                                                    <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                                    <a href="{{url('bills/info_bill')}}/{{$row->id}}" class="success  mr-1" ><i class="fa fa-eye"></i></a>
                                                </td> --}}
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                              </table>
                        </div><!-- Payments table -->
                    </div>

                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                        <!-- History table -->
                        <div class="table-responsive">
                            <table id="paymebts-history" class="table text-center table-striped display table-white-space row-grouping  no-wrap table-middle paymebts-history" >
                                <thead class="border-botto">
                                    <tr>
                                        <th>#</th>
                                        <th> نمبر بل </th>
                                        <th> مشخضات مشتری </th>
                                        <th>مقدار پرداخت شده</th>
                                        <th>تاریخ پرداخت</th>
                                        <th>نمبر حواله</th>
                                        <th>تاریخ ثبت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($paymentsHistory as $row)
                                        <tr id="row{{$row->id}}">
                                            <td class="counter">{{$counter++}}</td>
                                            <td class="font"> Bill-{{$row->bill_num }} </td>
                                            <td class="primary">
                                                <a href="{{url('customers/info/')}}/{{$row->customer_id}}" target="_blank">
                                                    <span >{{$row->firstname}}  {{$row->lastname}}</span><br/>
                                                    <small style="color:#717b85 !important" class="font"> ({{$row->province}}) </small>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge badge-success badge-pill"><span class="font">{{$row->pay_quantity}}</span> {{$row->currency}} </span>
                                            </td>
                                            <td class="pb-50 font" style="direction: ltr">
                                                @php
                                                    $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->pay_date));
                                                    echo $date;
                                                @endphp     
                                            </td>
                                            <td>
                                                @if (empty($row->referral_number))
                                                    <span class="warning">نمبر حواله موجود نیست </span>
                                                @else
                                                    <span class="font">{{$row->referral_number}} </span>
                                                @endif
                                            </td>
                                            <td class="pb-50 font" style="direction: ltr">
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
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}"  ><i class="fa fa-pencil"></i></a>
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
                <h5 class="modal-title">رسید قرض</h5>
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
                        <label for="loan_info">مشخضات بل <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block loan_info" name="loan_info" style="width:100%" id="loan_info">
                            {{-- <option  disabled  selected> اتنخاب کردن مقدار قرض </option>
                            @foreach ($loans as $item)
                                @if ($item->quantity_loan>Helper::getPayments($item->id))
                                    <optgroup label="مشخضات">
                                        <option value="{{$item->id}}" data-currency="{{$item->currency}}" >Bill-{{$item->bill_number}} /   {{$item->company_name}} /<span> ({{$item->quantity_loan-Helper::getPayments($item->id)}} {{$item->currency}}) </span> </option>
                                    </optgroup>
                                @endif
                            @endforeach  --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pay_quantity"> مقدار پرداخت <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text" id="remain">00</span>
                            </div>
                            <input type="number" class="form-control font" min="0" max="1000000" name="pay_quantity"  placeholder=" مقدار پرداخت " id="pay_quantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pay_date"> تاریخ پرداخت <span class="text-danger">*</span></label>
                        <input type="date" class="form-control font"  name="pay_date"  placeholder="تعداد جنس " id="pay_date">
                    </div>
                    <div class="form-group">
                        <label for="referral_number"> نمبر حواله <small class="text-primary"> ( اختیاری ) </small></label>
                        <input type="text" class="form-control font" name="referral_number"  placeholder=" نمبر حواله " id="referral_number">
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">لغو کردن</button>
                    <button type="submit" class="btn btn-primary">اضافه کردن رسید </button> 
                </div>
            </form>
        </div>
    </div>
</div><!-- End Create Modal -->




<!-- Edit Modal -->
<div class="modal fade text-left" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش کردن پرداخت قرض</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="editform">
                <div class="modal-body">
                    <div class="alert alert-edit alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group div_goods_name">
                        <label for="edit_loan_info">مشخضات قرض <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block edit_loan_info" name="loan_info" style="width:100%" id="edit_loan_info">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_pay_quantity"> مقدار پرداخت <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text font" id="edit_remain">00</span>
                            </div>
                            <input type="number" class="form-control font" min="0" max="1000000" name="pay_quantity"  placeholder=" مقدار پرداخت " id="edit_pay_quantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_pay_date"> تاریخ پرداخت <span class="text-danger">*</span></label>
                        <input type="date" class="form-control"  name="pay_date"  placeholder="تعداد جنس " id="edit_pay_date">
                    </div>
                    <div class="form-group">
                        <label for="edit_referral_number"> نمبر حواله <small class="text-primary"> ( اختیاری ) </small></label>
                        <input type="text" class="form-control font" name="referral_number"  placeholder=" نمبر حواله " id="edit_referral_number">
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
            $('#payment-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('#paymebts-history').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('.loan_info').select2();
            $('.edit_loan_info').select2();
        });
        $('.alert').hide();
    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $("#loan_info").trigger( "change" );
            $('#pay_quantity').removeClass(' is-invalid');
            $('#pay_date').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            var url='{{ url("receipts") }}'+'/get_loans/all';
            $.get(url,function(data){
               $('#loan_info').html(data);
            });
            $('#loan_info').on('change',function(){
                var loan_id=$('#loan_info').val();
                if(loan_id!=null){
                    var url='{{ url("receipts") }}'+'/get_loan_quantity/'+loan_id;
                    var loan_currency= $(this).find('option:selected').attr('data-currency'); 
                    $.get(url,function(data){
                        var quantity=data;
                        $('#remain').text(quantity+' '+loan_currency+' ');
                        $('#pay_quantity').attr('max',quantity);
                    });
                }else{
                    $('#remain').text('00');
                }                
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
            $('#pay_quantity').removeClass(' is-invalid');
            $('#pay_date').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("receipts") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.payment-table').load(document.URL + ' .payment-table');
                    $('.paymebts-history').load(document.URL + ' .paymebts-history');
                    $('.total_loans_dollar').load(document.URL + ' .total_loans_dollar');
                    $('.total_loans_af').load(document.URL + ' .total_loans_af');
                    $('.total_NoPayments').load(document.URL + ' .total_NoPayments');
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
                        if(key=='loan_info'){
                            $('.div_goods_name .select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='pay_quantity'){
                            $('#pay_quantity').addClass(' is-invalid');
                        }
                        if(key=='pay_date'){
                            $('#pay_date').addClass(' is-invalid');
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
        $('#loan_info').on('change',function(){
            $('.div_goods_name .select2-selection--single').removeClass(' border-danger');
        });
        $('#pay_quantity').on('keypress',function(){
            $('#pay_quantity').removeClass(' is-invalid');
        });
        $('#pay_date').on('change',function(){
            $('#pay_date').removeClass(' is-invalid');
        });
    </script>{{-- create item --}}




    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert-edit').hide();
            $('#editform').trigger("reset");            
            $('#edit_pay_quantity').removeClass(' is-invalid');
            $('#edit_pay_date').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            
            var id =$(this).attr('data-id');
            var url_getLoan='{{ url("receipts") }}'+'/get_loans/all_update/'+id;
            $.get(url_getLoan,function(data){
               $('#edit_loan_info').html(data['data']);
               $('#edit_remain').text(data['total_payment']+' '+data['currency']+' ');
               $('#edit_pay_quantity').attr('max',data['total_payment']);
            });

            var url_edit='{{ url("receipts") }}/'+id+'/edit';
            $.get(url_edit,function(data){
                $("#edit_pay_quantity").val(data.pay_quantity);
                $("#edit_pay_date").val(data.pay_date);
                $("#edit_referral_number").val(data.referral_number);
                $("#hidden_id").val(data.id);
            })
            $('#edit_loan_info').on('change',function(){
                var loan_id=$('#edit_loan_info').val();
                if(loan_id!=null){
                    var url='{{ url("receipts") }}'+'/get_loan_quantity/'+loan_id+'/edit/'+id;
                    var loan_currency= $(this).find('option:selected').attr('data-currency'); 
                    $.get(url,function(data){
                        var quantity=data;
                        $('#edit_remain').text(quantity+' '+loan_currency+' ');
                        $('#edit_pay_quantity').attr('max',quantity);
                    });
                }else{
                    $('#edit_remain').text('00');
                }                
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

            $('#edit_pay_quantity').removeClass(' is-invalid');
            $('#edit_pay_date').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("receipts_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#edit-item').modal('hide');
                    $('.payment-table').load(document.URL + ' .payment-table');
                    $('.paymebts-history').load(document.URL + ' .paymebts-history');
                    $('.total_loans_dollar').load(document.URL + ' .total_loans_dollar');
                    $('.total_loans_af').load(document.URL + ' .total_loans_af');
                    $('.total_NoPayments').load(document.URL + ' .total_NoPayments');
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
                        if(key=='loan_info'){
                            $('.div_goods_name .select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='pay_quantity'){
                            $('#edit_pay_quantity').addClass(' is-invalid');
                        }
                        if(key=='pay_date'){
                            $('#edit_pay_date').addClass(' is-invalid');
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
        $('#edit_loan_info').on('change',function(){
            $('.div_goods_name .select2-selection--single').removeClass(' border-danger');
        });
        $('#edit_pay_quantity').on('keypress',function(){
            $('#edit_pay_quantity').removeClass(' is-invalid');
        });
        $('#edit_pay_date').on('change',function(){
            $('#edit_pay_date').removeClass(' is-invalid');
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
                        url:'{{url("receipts")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
                            $('.payment-table').load(document.URL + ' .payment-table');
                            $('.total_loans_dollar').load(document.URL + ' .total_loans_dollar');
                            $('.total_loans_af').load(document.URL + ' .total_loans_af');
                            $('.total_NoPayments').load(document.URL + ' .total_NoPayments');
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
                                'دیتای مرتبط موجود است',
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>{{-- End delete form --}}



@endsection
