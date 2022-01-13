@extends('layouts.layout')

@section('site-title')
    Purchase Documents
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('goods')}}">خریدها</a></li>
    <li class="breadcrumb-item">جزییات خرید</li>
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

        table thead tr th, table tbody tr td{
           font-size:14px !important;
        }


        .paymebts-history-responsive table thead tr th, table tbody tr td{
           font-size:13px !important;
        }

        .paymebts-history-responsive  .table tr td{
            border:none !important;
            
        }

        .paymebts-history-responsive table tbody  tr:nth-child(odd) .counter{
            background-color: #f1f1f1 ;
        }
        .paymebts-history-responsive table tbody  tr:nth-child(even) .counter{
            background-color:#fafafa ;
        }

        .paymebts-history-responsive table tbody  tr:hover .counter{
            background-color: #ebebeb !important;
        }


        #purchases-table thead th{
            border-bottom:1px solid #E6E6E6 !important;  
            border-right:0px solid #E6E6E6 !important;
        }

        #purchases-table tbody tr td{
            padding:10px 0;
            border-right:0px solid #E6E6E6 !important;
        }
        #purchases-table{
            border-right:1px solid #E6E6E6 !important;
        }
        
        .paymebts-history-responsive  .nav.nav-tabs.nav-underline .nav-item a.nav-link.active{
            color:#2DCEE3 !important;
        }

        .paymebts-history-responsive  .nav.nav-tabs.nav-underline .nav-item a.nav-link {
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





          
<section class="app-invoice-wrapper">
    <div class="row row-reverse">
          <!-- buttons section -->
        <div class="col-lg-2 col-md-2 col-12  order-md-2 pl-0">
            <div class="card">
                <div class="card-body p-1" >
                    <a href="#" class="btn btn-info mb-1 d-block" onclick="window.print()"> <i class="feather icon-printer mr-25 common-size"></i> پرنت</a>
                    {{-- <a href="#" class="btn btn-success d-block">PDF<i class="feather icon-credit-card mr-25 common-size"></i></a> --}}
                </div>
            </div>
        </div>

        <div class="col-lg-10 col-md-10 col-12 order-md-1">

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @if (!empty($paymentsHistory[0]))
                            <ul class="nav nav-tabs mb-3  nav-top-border no-hover-bg " role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active  px-1" id="account-tab" data-toggle="tab"
                                        href="#account" aria-controls="account" role="tab" aria-selected="true">
                                        <i class="icon-wallet mr-50"></i><span class="d-none d-sm-block"> جزییات خرید </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center px-1" id="information-tab" data-toggle="tab"
                                        href="#information" aria-controls="information" role="tab" aria-selected="false">
                                        <i class="icon-note mr-50"></i><span class="d-none d-sm-block"> لیست پرداخت ها از حساب </span>
                                    </a>
                                </li>
                            </ul>   
                        @endif 
                       
                        <div class="tab-content">
                            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                <!-- datatable start -->
                               
                                <div class="invoice-logo-title row py-1">
                                    <div class="col-6 d-flex flex-column justify-content-center align-items-start">
                                        <h3 class="text-primary mb-75">نام شرکت</h3>
                                        <span>{{$purchase->company_name}}</span>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end invoice-logo">
                                        @if (empty($purchase->company_photo))
                                            <img src="{{asset('public/assets/images/logo/pixinvent-logo.png')}}" alt="company-logo" height="46"width="164" style="object-fit: contain">
                                        @else
                                            <img src="{{asset('storage/app')}}/{{$purchase->company_photo}}" alt="company-logo" height="46"width="164" style="object-fit: contain">
                                        @endif
                                    </div>
                                </div>
                                <hr>
            
                                <!-- Infomation Purchase -->
                                <div class="row invoice-adress-info py-2">
                                    @if (!empty($paymentsHistory[0]))
                                        <div class="col-md-3 col-sm-5 col-5 mt-1 from-info">
                                    @else
                                        <div class="col-6 mt-1 from-info">
                                    @endif
                                        <div class="company-name mb-1">
                                            <span class="mr-50 font-weight-bold text-primary">بل نمبر</span>: <span class="font">  Bill-{{$purchase->bill_number}} </span>
                                        </div>
                                        <div class="company-address mb-1">
                                            <span class="mr-50 font-weight-bold text-primary">تعداد جنس</span>: <span class="font"> {{$purchase->quantity_goods}} </span> دانه
                                        </div>
                                        <div class="company-address mb-1">
                                            <span class="mr-50 font-weight-bold text-primary">واحد پول</span>: {{$purchase->currency}}
                                        </div>
                                        {{-- @if (empty($paymentsHistory[0])) --}}
                                            <div class="company-email  mb-1 mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">تاریخ خرید</span>: <span class="font"> {{$purchase->purchase_date}} </span>
                                            </div>
                                        {{-- @endif --}}
                                    </div>
                                    @if (!empty($paymentsHistory[0]))
                                        <div class="col-md-4 col-sm-6 col-6 mt-1 to-info">
                                            <div class="company-email mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">مجموعه پول</span>: <span class="font"> {{$purchase->total_price}} </span> {{$purchase->currency}}
                                            </div>
                                            <div class="company-name mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">پول پرداخت شده از بل</span>: <span class="font"> {{$purchase->money_paid}} </span> {{$purchase->currency}}
                                            </div>
                                            <div class="company-email mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">باقی مانده پول از بل</span>: 
                                                @php
                                                    $total=$purchase->total_price;
                                                    $paid=$purchase->money_paid;
                                                    $maney=$total-$paid;
                                                @endphp
                                                @if ($maney<=0)
                                                    <span class="badge badge-success badge-pill"> رسید </span>
                                                @else
                                                     <span class="font">{{$maney}}</span>   {{$purchase->currency}}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-7 col-7 mt-1 to-info">
                                            <div class="company-name mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">پول پرداخت شده از حساب</span>: <span class="font"> {{$remain}} </span> {{$purchase->currency}}
                                            </div>
                                            <div class="company-name mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">باقی کل پول</span>: 
                                                @php
                                                    $total=$purchase->total_price;
                                                    $paid=$purchase->money_paid;
                                                    $remain_maney=$total-($paid+$remain);
                                                @endphp
                                                @if ($remain_maney<=0)
                                                    <span class="badge badge-success badge-pill"> رسید </span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">  <span class="font">{{$remain_maney}}</span>   {{$purchase->currency}}</span>
                                                @endif
                                            </div>
                                            <div class="company-email  mb-1 mb-1 d-flex">
                                                <div><span  class="mr-25 font-weight-bold text-primary"> تاریخ ثبت </span>:</div>
                                                <div class="font ml-50" style="direction:ltr !important">
                                                    <span class="font">
                                                        @php
                                                            $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($purchase->created_at));
                                                            echo $date;
                                                        @endphp     
                                                    </span><br>
                                                    <span style="color:#919ca7 !important" class="font">
                                                        @php
                                                            $date_tiem= \Morilog\Jalali\CalendarUtils::strftime('a ', strtotime($purchase->created_at));
                                                            echo $date_tiem;
                                                            $time=date_create($purchase->created_at);
                                                            echo date_format($time,'h:i:s');
                                                        @endphp 
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-6 mt-1 to-info">
                                            <div class="company-email mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">مجموعه پول</span>: <span class="font"> {{$purchase->total_price}} </span> {{$purchase->currency}}
                                            </div>
                                            <div class="company-name mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">پول پرداخت شده</span>: <span class="font"> {{$purchase->money_paid}} </span> {{$purchase->currency}}
                                            </div>
                                            <div class="company-email mb-1">
                                                <span class="mr-50 font-weight-bold text-primary">باقی مانده پول</span>: 
                                                @php
                                                    $total=$purchase->total_price;
                                                    $paid=$purchase->money_paid;
                                                    $maney=$total-$paid;
                                                @endphp
                                                @if ($maney<=0)
                                                    <span class="badge badge-success badge-pill"> رسید </span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">  <span class="font">{{$maney}}</span>   {{$purchase->currency}}</span>
                                                @endif
                                            </div>
                                            <div class="company-email  mb-1 mb-1 d-flex">
                                                <div><span  class="mr-25 font-weight-bold text-primary"> تاریخ ثبت </span>:</div>
                                                <div class="font ml-50" style="direction:ltr !important">
                                                    <span class="font">
                                                        @php
                                                            $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($purchase->created_at));
                                                            echo $date;
                                                        @endphp     
                                                    </span><br>
                                                    <span style="color:#919ca7 !important" class="font">
                                                        @php
                                                            $date_tiem= \Morilog\Jalali\CalendarUtils::strftime('a ', strtotime($purchase->created_at));
                                                            echo $date_tiem;
                                                            $time=date_create($purchase->created_at);
                                                            echo date_format($time,'h:i:s');
                                                        @endphp 
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div><!-- End Infomation Purchase -->
            
            
                                <!--Purchases Documents details table -->
                                <div class="product-details-table py-2 table-responsive">
                                    <div class="heading-elements mt-0 mr-1 text-right">
                                        <button type="button" class="btn btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item">
                                            <i class="icon icon-plus mr-1"></i> اضافه کردن اجزای خرید</button>
                                    </div>
                                    <div class="table-responsive mt-2">
                                        <table id="purchases-table" class="table table-bordered  text-center   table-white-space  row-grouping  no-wrap icheck table-middle purchases-table" >
                                            <thead class="border-bottom">
                                            <tr>
                                                <th>#</th>
                                                <th>نام جنس</th>
                                                <th>قیمت جنس </th>
                                                <th>تعداد جنس</th>
                                                <th>مجموعه کل</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php $counter=1;$total_money=0; $total_goods=0; @endphp
                                                @foreach ($purchaseDocument as $row)
                                                    <tr id="row{{$row->id}}" >
                                                        <td>{{$counter++}}</td>
                                                        <td>
                                                            {{$row->category_name}} {{$row->type_of}} {{$row->goods_name}}
                                                        </td>
                                                        <td><span class="font">{{$row->price}}</span>   {{$purchase->currency}}</td>
                                                        <td class="font">
                                                            <span class="bullet bullet-success bullet-sm"></span> {{$row->goods_quantity}}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $total=$row->goods_quantity; 
                                                                $paid=$row->price;
                                                                $maney=$total*$paid;
            
                                                                $total_goods+=$total;
                                                                $total_money+=$maney;
                                                            @endphp
                                                            @if ($maney<=0)
                                                                <span class="badge badge-danger badge-pill"> 0 </span>
                                                            @else
                                                                <span class="badge badge-success badge-pill"><span class="font"> {{$maney}} </span>   {{$purchase->currency}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}""><i class="fa fa-pencil"></i></a>
                                                            <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
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
                                        <div class="col-4 col-sm-6 mt-75">
                                            {{-- <p>Thanks for your business.</p> --}}
                                        </div>
                                        <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                            <ul class="list-group cost-list mylist">
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2"> مجموعه کل پول </span>
                                                    <span class="cost-value" id="total_money"><span class="font"> {{$total_money}}  </span> {{$purchase->currency}}</span> 
                                                </li>
                                                @if ($total_money>$purchase->total_price)
                                                    <li class="list-group-item each-cost border-0 px-75 pb-50 pt-0">
                                                        <span class="cost-title text-danger" style="font-size:10px"> 
                                                            مجموعه کل پول از مقداز تعیین شده زیاد شده است 
                                                        </span>
                                                    </li>
                                                @elseif(($total_money<$purchase->total_price))
                                                    <li class="list-group-item each-cost border-0 px-75 pb-50 pt-0">
                                                        <span class="cost-title text-danger" style="font-size:10px"> 
                                                            مجموعه کل پول از مقداز تعیین شده کم است 
                                                        </span>
                                                    </li>
                                                @endif   
                                                
                                                <li class="dropdown-divider"></li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2"> تعداد مجموعی جنس</span>
                                                    <span class="cost-value font" id="total_goods">{{$total_goods}}</span>
                                                </li>
                                                
                                                @if ($total_goods>$purchase->quantity_goods)
                                                    <li class="list-group-item each-cost border-0 px-75 pb-50 pt-0">
                                                        <span class="cost-title text-danger" style="font-size:10px"> 
                                                            تعداد مجموعی جنس از مقداز تعیین شده زیاد شده است 
                                                        </span>
                                                    </li>
                                                @elseif(($total_goods<$purchase->quantity_goods))
                                                    <li class="list-group-item each-cost border-0 px-75 pb-50 pt-0">
                                                        <span class="cost-title text-danger" style="font-size:10px"> 
                                                            تعداد مجموعی جنس از مقداز تعیین شده کم است 
                                                        </span>
                                                    </li>
                                                @endif   
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- total -->
        
                                <!-- datatable End -->
                            </div>
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
                                                    <td class="font"> Bill-{{$row->bill_number }} </td>
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


            @if (!empty($purchase->puchase_photo))
                <div class="card mt-4">
                    <div class="card-head mb-25">
                        <div class="card-header">
                            <h4 class="card-title">فایل</h4>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-3">
                            <img src="{{asset('storage/app')}}/{{$purchase->puchase_photo}}" alt="" style="width:100%">
                        </div>
                    </div>
                </div>
           @endif

        </div>
    </div>
</section>






<!-- Create Modal -->
<div class="modal fade text-left" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">اضافه کردن اجزای خرید</h5>
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
                        <label for="goods_name">نام جنس <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block goods_name" name="goods_name" style="width:100%" id="goods_name">
                            <option  disabled  selected> اتنخاب کردن جنس </option>
                            @foreach ($goods as $item)
                                <option value="{{$item->id}}"> {{$item->category_name}} {{$item->type_of}} {{$item->name}} </option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="goods_price"> قیمت جنس <span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" name="goods_price"  min="0" placeholder=" قیمت جنس " id="goods_price">
                    </div>
                    <div class="form-group">
                        <label for="quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" max="1000000" min="0" name="quantity_goods"  placeholder="تعداد جنس " id="quantity_goods">
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="{{$purchase->id}}"  name="purchase_id">
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
                <h5 class="modal-title">ویرایش کردن اجزای خرید</h5>
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
                        <label for="goods_name">نام جنس <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block goods_name" name="goods_name" style="width:100%" id="edit_goods_name">
                            <option  disabled  selected> اتنخاب کردن جنس </option>
                            @foreach ($goods as $item)
                                <option value="{{$item->id}}"> {{$item->category_name}} {{$item->type_of}} {{$item->name}} </option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="goods_price"> قیمت جنس <span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" name="goods_price"  min="0" placeholder=" قیمت جنس " id="edit_goods_price">
                    </div>
                    <div class="form-group">
                        <label for="quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" max="1000000" min="0" name="quantity_goods"  placeholder="تعداد جنس " id="edit_quantity_goods">
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
                },
                searching: false, paging: false, info: false
            });

            $('#paymebts-history').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                },
            });

           
            $('.goods_name').select2();
            $('.edit_company_name').select2();
        });
        $('.alert').hide();
    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $("#goods_name").trigger( "change" );

            $('#quantity_goods').removeClass(' is-invalid');
            $('#goods_price').removeClass(' is-invalid');
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
            $('#goods_price').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');

            $.ajax({
                url: '{{ url("purchase_documents") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.purchases-table').load(document.URL + ' .purchases-table');
                    $('.mylist').load(document.URL + ' .mylist');
                    $('#create-item').modal('hide');
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
                            $('.select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='quantity_goods'){
                            $('#quantity_goods').addClass(' is-invalid');
                        }
                        if(key=='goods_price'){
                            $('#goods_price').addClass(' is-invalid');
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
            $('.select2-selection--single').removeClass(' border-danger');
        });
        $('#quantity_goods').on('keypress',function(){
            $('#quantity_goods').removeClass(' is-invalid');
        });
        $('#goods_price').on('keypress',function(){
            $('#goods_price').removeClass(' is-invalid');
        });
    </script>{{-- create item --}}



    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert-edit').hide();
            $('#editform').trigger("reset");
            var id=$(this).attr('data-id');
            var url ='{{url("purchase_documents")}}/'+id+'/edit';
            $.get(url,function(data){
                $('#edit_goods_name').val(data.goods_id).trigger( "change" );
                $('#edit_goods_price').val(data.price);
                $('#edit_quantity_goods').val(data.goods_quantity);
                $('#hidden_id').val(data.id);

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
            $('#edit_quantity_goods').removeClass(' is-invalid');
            $('#edit_goods_price').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("purchase_documents_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#edit-item').modal('hide');
                    $('.purchases-table').load(document.URL + ' .purchases-table');
                    $('.mylist').load(document.URL + ' .mylist');

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
                        if(key=='goods_name'){
                            $('.select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='quantity_goods'){
                            $('#edit_quantity_goods').addClass(' is-invalid');
                        }
                        if(key=='goods_price'){
                            $('#edit_goods_price').addClass(' is-invalid');
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
        $('#edit_goods_name').on('change',function(){
            $('.select2-selection--single').removeClass(' border-danger');
        });
        $('#edit_quantity_goods').on('keypress',function(){
            $('#edit_quantity_goods').removeClass(' is-invalid');
        });
        $('#edit_goods_price').on('keypress',function(){
            $('#edit_goods_price').removeClass(' is-invalid');
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
                        url:'{{url("purchase_documents")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
                            // $('.table').load(document.URL + ' .table');
                            $('.mylist').load(document.URL + ' .mylist');
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
