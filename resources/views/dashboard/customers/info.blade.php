@extends('layouts.layout')

@section('site-title')
    Information Customers
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('customers')}}">مشتریان</a></li>
    <li class="breadcrumb-item">  معلومات </li>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">

    <style>
        .dataTables_wrapper {
            direction: rtl !important;
        }
        .dataTables_length {
            float: right !important;
            margin-bottom: 10px !important;
            font-size:12px !important;
        }
        .dataTables_filter {
            float: left !important;
            text-align: left !important;
            margin-bottom: 10px !important;
            font-size:12px !important;
        }

        .dataTables_filter label input {
           margin-right:10px !important;
        }
        
        .dataTables_info {
            float: right !important;
            margin-top: 10px !important;
            font-size:12px !important;
        }
        .dataTables_paginate {
            float: left !important;
            text-align: left !important;
            margin-top: 10px !important;
            font-size:12px !important;
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

        .table{
            font-size:13px !important;
        }
        .table.dataTable.no-footer{
            border:0 !important;
        }

        .dropdown-toggle::after{
            display:none !important;   
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

        /* table tbody tr td{
            padding-top:10px !important;
            padding-bottom:10px !important;
        }
        */
        table thead tr th{
            padding-top:10px !important;
            padding-bottom:10px !important;
            /* font-size:13px !important; */
        } 


    </style>


@endsection
@section('body')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12  pr-50">

            {{-- card customer --}}
            <div class="card">
                <div class="card-header pb-1 profile_img">
                    @if (empty($customer->photo))
                        <img src="{{asset('public/assets/images/man.png')}}" alt="" style="width:100%; height:200px;  object-fit: cover;" >
                    @else
                        <img src="{{asset('storage/app/')}}/{{$customer->photo}}" alt="" style="width:100%; height:200px;  object-fit: cover;" >
                    @endif
                </div>
                <div class="card-body pt-0">
                    <div>
                        <h6 class=" mt-1 d-flex"><span class="feather icon-user mr-50 icon-size text-right "></span> <span>{{$customer->firstname}} {{$customer->lastname}}</span></h6>
                        <h6 class="mt-2 font" style="direction: ltr !important"> {{$customer->phone_number}} <span class="feather icon-phone mr-50 icon-size"></span></h6>
                        <h6 class="mt-1" ><span class="feather icon-map mr-50 icon-size"></span> {{$customer->province}} </h6>
                        <h6 class="mt-1 pt-25 font" style="direction: ltr !important">
                            @php
                                $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($customer->pay_date));
                                echo $date;
                            @endphp      
                            <span class="feather icon-clock mr-50 icon-size"></span> 
                        </h6>
                    </div>
                </div>
            </div> {{-- End card customer --}}


            <!-- Infomation Views -->
            <div class="card">
                <div class="card-head">
                    <div class="media p-1">
                        <div class="media-body media-middle">
                            <h5 class="media-heading">معلومات عمومی</h5>
                        </div>
                    </div>
                </div>

               <!-- Groups-->
               <div class="card-body border-top-blue-grey  border-top-lighten-5">
                    <ul class="list-group">
                        <li class="list-group-item text-center pt-75">
                            <p class="primary m-0">تعداد جنس</p>
                            <div class="d-flex flex-column mt-50 text-center">
                                <span class="badge badge-warning badge-pill float-right ml-0"><span class="font">{{$total_goods}}</span> دانه</span>
                            </div>
                        </li>
                        <li class="list-group-item text-center pt-75">
                            <p class="primary m-0">مجموعه پول</p>
                            <div class="d-flex flex-column mt-50 text-center">
                                <span class="badge badge-primary badge-pill float-right ml-0"><span class="font">{{$total_price_daller}}</span> دالر</span>
                                <span class="badge badge-primary badge-pill float-right ml-0 mt-50"><span class="font">{{$total_price_af}}</span> افغانی</span>
                            </div>
                        </li>
                        <li class="list-group-item text-center pt-75">
                            <p class="primary m-0">مجموعه پرداخت </p>
                            <div class="d-flex flex-column mt-50 text-center">
                                <span class="badge badge-success badge-pill float-right ml-0"><span class="font">{{$total_paid_doller+$payments_money_doller}} </span> دالر</span>
                                <span class="badge badge-success badge-pill float-right ml-0 mt-50"><span class="font">{{$total_paid_af+$payments_money_af}} </span> افغانی</span>
                            </div>
                        </li>
                        <li class="list-group-item text-center pt-75">
                            <p class="primary m-0">مجموعه قرض </p>
                            <div class="d-flex flex-column mt-50 text-center">
                                <span class="badge badge-danger badge-pill float-right ml-0"><span class="font">{{$total_loans_dollar}} </span> دالر</span>
                                <span class="badge badge-danger badge-pill float-right ml-0 mt-50"><span class="font">{{$total_loans_af}} </span> افغانی</span>
                            </div>
                        </li>
                    </ul>
                </div><!--/ Groups-->


            </div> <!-- End Information Views -->


             <!-- Photo Edit -->
             <div class="card">
                <div class="card-head">
                    <div class="media p-1">
                        <div class="media-body media-middle">
                            <h5 class="media-heading">تغییر دادن عکس</h5>
                        </div>
                    </div>
                </div>
                <!-- Groups-->
                <div class="card-body border-top-blue-grey  border-top-lighten-5">
                    <form method="post" id="editphoto">
                        <div class="card-body py-0 px-1">
                            <div class="alert alert1 alert-danger alert-photo p-0 pt-1" style="font-size:12px">
                                <ul id="error"></ul>
                            </div>
                            <div class="mb-2 text-center">
                                @if (empty($customer->photo))
                                    <img class="userpicimg rounded-circle  height-100 width-100" src="{{asset('public/assets/images/man.png')}}" name="user_img" alt="img" id="uploadUpdate">
                                    @else
                                    <img class="userpicimg rounded-circle  height-100 width-100" src="{{asset('storage/app/')}}/{{$customer->photo}}" name="user_img" alt="img" id="uploadUpdate">
                                @endif
                            </div>
                            <div class="text-center">
                                <div class="input-group">
                                    <input type="file" class="form-control" placeholder="Button on left" name="photo"  onChange="UpdatePreview()" id="photo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer  mt-2">
                            <input type="hidden" name="hidden_id" value="{{$customer->id}}">
                            <button type="submit" class="btn btn-primary">تغییر دادن</button>
                        </div>
                    </form>
                </div><!--/ Groups-->
            </div> <!-- Photo Edit -->

        </div>





        <div class="col-lg-9 col-md-8 col-sm-12">
                            
                <section>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <ul class="nav nav-tabs nav-top-border no-hover-bg " role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active  px-3" id="account-tab" data-toggle="tab"
                                            href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="icon-wallet mr-50"></i><span class="d-none d-sm-block"> بل ها </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center px-3" id="information-tab" data-toggle="tab"
                                            href="#information" aria-controls="information" role="tab" aria-selected="false">
                                            <i class="icon icon-drawer mr-50"></i><span class="d-none d-sm-block">  قرض ها </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center px-3" id="info-tab" data-toggle="tab"
                                            href="#info" aria-controls="info" role="tab" aria-selected="false">
                                            <i class="icon-equalizer mr-50"></i><span class="d-none d-sm-block">  رسید ها </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content ">

                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                          <!-- bills table -->
                                        <div class="table-responsive">
                                            <table id="bills-table" class="table text-center   table-white-space table-striped display row-grouping  no-wrap icheck table-middle" >
                                                <thead class="border-bottom">
                                                <tr>
                                                    <th>#</th>
                                                    <th>نمبر بل</th>
                                                    <th>تعداد جنس</th>
                                                    <th>مجموعه پول</th>
                                                    <th>پول پرداخت شده</th>
                                                    <th>پول باقی مانده </th>
                                                    <th>تاریخ ثبت</th>
                                                    <th>تنظیمات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php $counter=1; @endphp
                                                    @foreach ($bills as $row)
                                                        <tr id="row" >
                                                            <td>{{$counter++}}</td>
                                                            <td class="font">
                                                                Bill-{{$row->bill_num}}</a>
                                                            </td>
                                                            <td><span class="font" >{{$row->quantity_goods}}</span> <span>دانه</span></td>
                                                            <td><span class="font" >{{$row->total_price}}</span> {{$row->currency}} </td>
                                                            <td class="success"> 
                                                                <span class="font">{{$row->money_paid+Helper::billPayments($row->id)}}</span>   {{$row->currency}}
                                                            </td>

                                                            <td>
                                                                @php
                                                                    $total=$row->total_price;
                                                                    $paid=$row->money_paid;
                                                                    $maney=$total-($paid+Helper::billPayments($row->id));
                                                                @endphp
                                                                @if ($maney<=0)
                                                                    <span class="badge badge-success badge-pill"> رسید </span>
                                                                @else
                                                                    <span class="badge badge-danger badge-pill"> <span class="font"> {{$maney}}</span>   {{$row->currency}}</span>
                                                                @endif
                                                            </td>

                                                            <td class="pb-0" style="direction:ltr;font-size:12px !important;">
                                                                <span class="font">
                                                                    @php
                                                                        $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->created_at));
                                                                        echo $date;
                                                                    @endphp     
                                                                </span><br>
                                                                <small style="color:#919ca7 !important;" class="font">
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
                                                                <a href="{{url('bills/info_bill')}}/{{$row->id}}" class="success  mr-1" ><i class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- bills table -->

                                    </div>


                                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                         <!-- Loans table -->
                                         <div class="table-responsive mb-2 mt-0 paymebts-history-responsive">
                                            <table id="loans-history" class="table table-sm text-center table-striped display table-white-space row-grouping  no-wrap table-middle loans-history" >
                                                <thead class="border-bottom">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>نمبر بل</th>
                                                        <th>مقدار قرض</th>
                                                        {{-- <th>مقدار پرداخت شده قرض</th> --}}
                                                        <th>باقی مانده قرض</th>
                                                        <th>تاریخ قرض</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                    @php $counter=1; @endphp
                                                    @foreach ($loans as $row)
                                                        <tr id="row{{$row->id}}" >
                                                            <td>{{$counter++}}</td>
                                                            <td class="font">
                                                                Bill-{{$row->bill_num}}</a>
                                                            </td>
                                                            <td>
                                                                @if ($row->quantity_loan<=Helper::getPayments($row->id))
                                                                    <span class="bullet bullet-success bullet-sm"></span>
                                                                @else
                                                                    <span class="bullet bullet-danger bullet-sm"></span>
                                                                @endif
                
                                                                <span class="font" >{{$row->quantity_loan}}</span> {{$row->currency}} 
                                                            </td>
                                                            <td>
                                                                @if ($row->quantity_loan<=Helper::getPayments($row->id))
                                                                    <span class="badge badge-success badge-pill"> رسید کامل </span>
                                                                @else
                                                                    <span class="badge badge-danger badge-pill"><span class="font">{{$row->quantity_loan-Helper::getPayments($row->id)}}</span>   {{$row->currency}} </span> 
                                                                @endif
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
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- Loans table -->
                                    </div>


                                    <div class="tab-pane" id="info" aria-labelledby="info-tab" role="tabpanel">
                                         <!-- History table -->
                                         <div class="table-responsive mb-2 mt-0 paymebts-history-responsive">
                                            <table id="paymebts-history" class="table table-sm text-center table-striped display table-white-space row-grouping  no-wrap table-middle paymebts-history" >
                                                <thead class="border-botto">
                                                    <tr>
                                                        <th>#</th>
                                                        <th> نمبر بل </th>
                                                        <th>مقدار پرداخت شده</th>
                                                        <th>تاریخ پرداخت</th>
                                                        <th>نمبر حواله</th>
                                                        <th>تاریخ ثبت</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $counter=1; @endphp
                                                    @foreach ($paymentsHistory as $row)
                                                        <tr id="row{{$row->id}}">
                                                            <td class="counter">{{$counter++}}</td>
                                                            <td class="font"> Bill-{{$row->bill_num }} </td>
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
            
        </div>
    </div>
</section><!--  layout section end -->


@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#bills-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('#loans-history').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('#paymebts-history').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
        });

        function UpdatePreview(){
            $('#uploadUpdate').attr('src', URL.createObjectURL(event.target.files[0]));
        };
    </script>

    <script>
        $('.alert').hide();
        
        $("#editphoto").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("change_photo") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert1").css('display', 'none');
                    $('#photo').removeClass(' is-invalid');
                    $('.profile_img').load(document.URL + ' .profile_img');

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
                        if(key=='photo'){
                            $('#photo').addClass(' is-invalid');
                        }
                        $(".alert-photo").find("ul").append('<li class="m-0 p-0">' + value + '</li>');
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
    </script>

@endsection
