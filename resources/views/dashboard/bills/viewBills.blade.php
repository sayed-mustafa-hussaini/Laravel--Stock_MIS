@extends('layouts.layout')

@section('site-title')
    Bill Information
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('bills')}}">بل ها</a></li>
    @if ( $bills->total_price<=0 && $bills->money_paid<=0 && $bills->quantity_goods<=0)
        <li class="breadcrumb-item"> معلومات بل ناتکمیل </li>
    @else
        <li class="breadcrumb-item"> معلومات بل </li>
    @endif
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/app-invoice.min.css')}}">

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
        table thead tr th, table tbody tr td{
           font-size:14px !important;
           padding:10px 0;
        }
        table thead tr th{
           border-bottom:1px solid #E3EBF3 !important;
        }
        .invoice-logo img{
            border-radius:5px;
            margin: auto 0;
        }
    </style>

@endsection
@section('body')




<section class="app-invoice-wrapper" >
    <div class="row row-reverse">
          <!-- buttons section -->
        <div class="col-lg-2 col-md-2 col-sm-12  order-md-2 pl-0">
            <div class="card">
                <div class="card-body p-1" >
                    @if ( $bills->total_price<=0 && $bills->money_paid<=0 && $bills->quantity_goods<=0)
                        <a href="{{url('bills/incomplate_bill')}}/{{$bills->id}}" class="btn btn-success d-block mb-1"> <i class="feather icon-edit mr-25 common-size"></i>  ویرایش بل</a>
                    @else
                        <a href="{{url('bills/update')}}/{{$bills->id}}" class="btn btn-success d-block mb-1"> <i class="feather icon-edit mr-25 common-size"></i>  ویرایش بل</a>
                    @endif
                    <a href="#" class="btn btn-info mb-1 d-block" onclick="window.print()"> <i class="feather icon-printer mr-25 common-size"></i> پرنت </a>
                    {{-- <a href="#" class="btn btn-success d-block">PDF<i class="feather icon-credit-card mr-25 common-size"></i></a> --}}
                </div>
            </div>
        </div><!-- buttons section -->

        <div class="col-lg-10 col-md-10 col-sm-12 order-md-1">
            <div class="card" >
                <!-- card body -->
                <div class="card-body p-2">
                    @if (!empty($paymentsHistory[0]))
                        <ul class="nav nav-tabs mb-3  nav-top-border no-hover-bg " role="tablist">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active  px-1" id="account-tab" data-toggle="tab"
                                    href="#account" aria-controls="account" role="tab" aria-selected="true">
                                    <i class="icon-wallet mr-50"></i><span class="d-none d-sm-block"> جزییات بل </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center px-1" id="information-tab" data-toggle="tab"
                                    href="#information" aria-controls="information" role="tab" aria-selected="false">
                                    <i class="icon-note mr-50"></i><span class="d-none d-sm-block"> لیست رسید ها در حساب </span>
                                </a>
                            </li>
                        </ul>   
                    @endif 


                    <div class="tab-content">                            
                        <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                            <!-- invoice logo and title -->
                            @if (!empty($paymentsHistory[0]))
                                <div class="invoice-logo-title pb-2">
                            @else 
                                <div class="invoice-logo-title py-2">
                            @endif
                                <div class="row">
                                    <div class="col-8">
                                        <h3 class="text-primary mb-75 mt-1">شرکت تجارتی شیک پوش</h3>
                                        <span class="mb-50">کیفیت را با ما تجربه کنید</span>
                                    </div>
                                    <div class="col-4 text-right">
                                        <img src="{{asset('public/assets/images/sheekposh.PNG')}}" alt="company-logo" height="46"width="164" style="object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                            <!-- card-header -->
                            <div class="card-header px-50">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center mb-1">
                                            <span > بل نمبر : </span>
                                            <span class="font ml-50">Bill-{{$bills->bill_num}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center justify-content-end justify-content-start">
                                            <span>تاریخ : </span>
                                            <span class="font ml-50" style="direction: ltr !important">
                                                @php
                                                    echo $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($bills->created_at));
                                                @endphp
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Infomation Purchase -->
                            <div class="row pb-3">
                                <div class="col-4 from-info">
                                    <div class="company-name">
                                        <span class="mr-50 text-primary">نام مشتری</span>: <span id="customer-name"> {{$bills->firstname}} {{$bills->lastname}} </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="company-address">
                                        <span class="mr-50 text-primary">شماره تماس</span>: <span id="customer-phone" class="font"> {{$bills->phone_number}} </span>
                                    </div>
                                </div>
                                <div class="col-4 to-info">
                                    <div class="company-name">
                                        <span class="mr-50  text-primary">ولایت</span>: <span id="customer-province"> {{$bills->province}} </span>
                                    </div>
                                </div>
                            </div><!-- End Infomation Purchase -->
                            <!--Purchases Documents details table -->
                            <div class="product-details-table pt-1 pb-2 table-responsive">
                                <div class="table-responsive mt-1">
                                    <table id="purchases-table" class="table table-bordered   text-center   table-white-space  row-grouping  no-wrap icheck table-middle" >
                                        <thead class="border-bottom">
                                        <tr>
                                            <th>#</th>
                                            <th>نام جنس</th>
                                            <th>قیمت جنس </th>
                                            <th>تعداد جنس</th>
                                            <th>مجموعه کل</th>
                                        </tr>
                                        </thead>
                                        <tbody id="html">
                                            @php $counter=1; @endphp
                                            @foreach ($billDocuments as $row)
                                                <tr id="row{{$row->id}}">
                                                    <td> {{$counter++}} </td>
                                                    <td>{{$row->category_name}} {{$row->type_of}} {{$row->goods_name}}</td>
                                                    <td><span class="font">{{$row->goods_price}}</span> <span class="bill-currency">{{$row->currency}}<span></span></td>
                                                    <td><span class="font">{{$row->quantity_goods}}</span> دانه</td>
                                                    @php
                                                        $money=$row->quantity_goods*$row->goods_price;
                                                    @endphp
                                                    <td>
                                                        <span class="font mr-50">{{$money}}</span><span class="bill-currency">{{$row->currency}}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- End Purchases Documents details table -->
                            </div>

                            <!-- total -->
                            <div class="invoice-total py-2">
                                <div class="row">
                                    <div class="col-6 col-sm-6 mt-75">
                                        {{-- <p>Thanks for your business.</p> --}}
                                    </div>

                                    @if (!empty($paymentsHistory[0]))
                                        <div class="col-6 col-sm-6 mt-75">
                                            <ul class="list-group cost-list pb-1">
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pb-1">
                                                    <span class="cost-title"> تعداد مجموعی جنس</span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$bills->quantity_goods}}  </span><span>دانه</span></span>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0">
                                                    <span class="cost-title"> مجموعه کل پول </span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$bills->total_price}}  </span><span>{{$bills->currency}}</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0">
                                                    <span class="cost-title">  مجموعه پول رسید شده در بل</span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$bills->money_paid}} </span><span>{{$bills->currency}}</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0 warning">
                                                    <span class="cost-title"> مجموعه پول باقی مانده در بل </span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$bills->money_remaining}}  </span><span>{{$bills->currency}}</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0 success">
                                                    <span class="cost-title"> پول پرداخت شده از حساب </span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$remain}} </span><span>{{$bills->currency}}</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0 danger">
                                                    <span class="cost-title"> باقی کل </span>
                                                    @if ($bills->money_remaining-$remain<=0)
                                                        <span class="cost-value success"> رسید </span>
                                                    @else
                                                        <span class="cost-value danger"><span class="font mr-50"> {{$bills->money_remaining-$remain}}  </span><span>{{$bills->currency}}</span></span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="col-6 col-sm-6 mt-75">
                                            <ul class="list-group cost-list pb-1">
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pb-1">
                                                    <span class="cost-title"> تعداد مجموعی جنس</span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$bills->quantity_goods}}  </span><span>دانه</span></span>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0">
                                                    <span class="cost-title"> مجموعه کل پول </span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$bills->total_price}}  </span><span>{{$bills->currency}}</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0">
                                                    <span class="cost-title"> مجموعه پول رسید </span>
                                                    <span class="cost-value"><span class="font mr-50"> {{$bills->money_paid}} </span><span>{{$bills->currency}}</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 d-flex justify-content-between pt-1 pb-0">
                                                    <span class="cost-title"> مجموعه پول باقی مانده </span>
                                                    @if ( $bills->total_price<=0 && $bills->money_paid<=0 && $bills->quantity_goods<=0)
                                                        <span class="cost-value"><span class="font mr-50"> {{$bills->money_remaining}}  </span><span>{{$bills->currency}}</span></span>
                                                    @else
                                                        @if ($bills->money_remaining<=0)
                                                            <span class="cost-value success"> رسید </span>
                                                        @else
                                                            <span class="cost-value danger"><span class="font mr-50"> {{$bills->money_remaining}}  </span><span>{{$bills->currency}}</span></span>
                                                        @endif
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div> <!-- total -->
                        </div><!-- Panel Tabe -->


                        <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                            <!-- History table -->
                           <div class="table-responsive my-2 paymebts-history-responsive pt-1">
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
                        </div><!-- Panel Tabe -->

                    </div> <!-- End Content Tabe-->
                    

                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#purchases-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                },
                searching: false, paging: false, info: false
            });
        });
    </script>
@endsection
