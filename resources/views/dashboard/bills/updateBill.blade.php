@extends('layouts.layout')

@section('site-title')
    Update Bill Information
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('bills')}}">بل ها</a></li>
    <li class="breadcrumb-item"> ویرایش کردن بل </li>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/app-invoice.min.css')}}">
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
                    <a href="{{url('bills/info_bill')}}/{{$bills->id}}" class="btn btn-success d-block mb-1" > <i class="icon-eye mr-25 common-size"></i>    دیدن بل</a>

                    <a href="{{url('stock')}}" target="_blank" class="btn btn-info mb-1 d-block"> <i class="icon-directions mr-25 common-size"></i> گدام </a>
                    {{-- <a href="#" class="btn btn-success d-block">PDF<i class="feather icon-credit-card mr-25 common-size"></i></a> --}}
                    <a href="#" class="btn btn-success d-block" onclick="window.print()">Print<i class="feather icon-credit-card mr-25 common-size"></i></a>
                </div>
            </div>
        </div><!-- buttons section -->

        <div class="col-lg-10 col-md-10 col-sm-12 order-md-1">
            <div class="card" >
                <!-- card body -->
                <div class="card-body p-2">
                    <!-- invoice logo and title -->
                    <div class="invoice-logo-title py-2">
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
                        <div class="col-12 mb-2 text-right">
                            <button type="button" class="btn btn-success btn-min-width text-right create-customer-edit" data-id="{{$bills->id}}" data-toggle="modal" data-target="#create-customer-edit">
                                <i class="fa fa-pencil mr-50"></i> ویرایش کردن مشتری</button>
                        </div>
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

                    <hr>
                    <!--Purchases Documents details table -->
                    <div class="product-details-table py-2 table-responsive">
                        <div class="heading-elements mt-0 mr-1 text-right">
                            <button type="button" class="btn btn-primary btn-min-width create" data-id="{{$bills->id}}" data-toggle="modal" data-target="#create-item" >
                                <i class="icon icon-plus mr-1"></i> اضافه کردن جنس</button>
                        </div>
                        <div class="table-responsive mt-2">
                            <table id="purchases-table" class="table   text-center   table-white-space  row-grouping  no-wrap icheck table-middle" >
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
                                <tbody id="html">
                                    @php $counter=1; @endphp
                                    @foreach ($billDocuments as $row)
                                        <tr id="row{{$row->id}}">
                                            <td> {{$counter++}} </td>
                                            <td>{{$row->category_name}} {{$row->type_of}} {{$row->goods_name}}</td>
                                            <td><span class="font">{{$row->goods_price}}</span> <span class="bill-currency">{{$row->currency}}<span></span></td>
                                            <td><span class="bullet bullet-success bullet-sm"></span> <span class="font">{{$row->quantity_goods}}</span> دانه</td>
                                            @php
                                                $money=$row->quantity_goods*$row->goods_price;
                                            @endphp
                                            <td><span class="badge badge-success badge-pill"><span class="font">{{$money}}</span><span class="bill-currency">{{$row->currency}}</span></span></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}" data-goods-id="{{$row->goods_id}}" ><i class="fa fa-pencil"></i></a>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- End Purchases Documents details table -->
                    </div>
                    
                    <form action="{{url('update_bill_details')}}" method="POST">
                        @csrf
                        <!-- total -->
                        <div class="invoice-total py-2">
                            <hr>
                            <div class="row">
                                <div class="col-4 col-sm-6 mt-75">
                                    {{-- <p>Thanks for your business.</p> --}}
                                </div>
                                <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                    <ul class="list-group ">
                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                            <span class="cost-title mr-2"> تعداد مجموعی جنس</span>
                                            <span style="max-width:200px">
                                                <div class="input-group"> 
                                                    <input type="number" readonly class="form-control font" min="0" value="{{$bills->quantity_goods}}"   name="total_goods" id="total_goods">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">دانه</span>
                                                    </div>
                                                </div>
                                            </span> 
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                            <span class="cost-title mr-2"> مجموعه کل پول </span>
                                            <span style="max-width:200px">
                                                <div class="input-group"> 
                                                    <input type="number" readonly class="form-control font" min="0" value="{{$bills->total_price}}"  placeholder="مجموعه پول" name="total_money" id="total_money">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bill-currency"> {{$bills->currency}} </span>
                                                    </div>
                                                </div>
                                            </span> 
                                        </li>
                                        <li class="list-group-item border-0 p-50 d-flex justify-content-between my-1">
                                            <span class=" mr-2">مجموعه پول رسید</span>
                                            <span style="max-width:200px;">
                                                <div class="input-group"> 
                                                    <input type="number" class="form-control font" style="width:160px !important;" max="{{$bills->total_price}}"  value="{{$bills->money_paid}}" required min="0"  placeholder="رسید" name="money_paid" id="money_paid" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bill-currency"> {{$bills->currency}} </span>
                                                    </div>
                                                </div>
                                            </span> 
                                        </li>
                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                            <span class="cost-title mr-2">مجموعه پول باقی مانده</span>
                                            <span style="max-width:200px">
                                                <div class="input-group"> 
                                                    <input type="number" readonly class="form-control font" min="0" value="{{$bills->money_remaining}}" placeholder="باقی مانده" name="total_remain" id="total_remain">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bill-currency"> {{$bills->currency}} </span>
                                                    </div>
                                                </div>
                                            </span> 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- total -->
                        <div class="text-left mb-1 ">
                            <input type="hidden" id="bills_hidden_id" name="bills_hidden_id" value="{{$bills->id}}">
                            <button class="btn btn-primary print-invoice save-btn" onclick="window.print()"> <i class="feather icon-printer mr-25 common-size"></i> پرنت</button>
                            <button type="submit" class="btn btn-success submit-bill"><i class="feather icon-credit-card mr-25 common-size"></i>ذخیره کردن</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
      
    </div>
</section>




<!-- Edit Modal -->
<div class="modal fade text-left" id="create-customer-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش کردن مشتری</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="createform-customer-edit">
                <div class="modal-body">
                    <div class="alert alert-create alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group">
                        <label for="bill_num"> بل نمبر <span class="text-danger">*</span></label>
                        <input type="number" readonly class="form-control font" name="bill_num"  min="0"  id="edit_bill_num" value="{{$bills->id}}">
                    </div>
                    <div class="form-group">
                        <fieldset>
                            <input type="checkbox" name="checkbox" class="checkbox"  class="mr-25">
                            <label for="checkbox">جستجوی مشتری در دیتابیس</label>
                        </fieldset>
                    </div>
                    <div class="customers-old">
                        <div class="form-group edit_customer-div">
                            <label for="edit_customer-old">نام مشتری <span class="text-danger">*</span></label>
                            <select class="select2 custom-select block edit_customer-old" name="customer_old" style="width:100%" id="edit_customer-old">
                                <option  disabled  selected> اتنخاب کردن مشتری </option>
                                @foreach ($customers as $item)
                                    <option value="{{$item->id}}"> {{$item->firstname}} {{$item->lastname}} ({{$item->province}}) </option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="customers-new">
                        <div class="row mt-1">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="edit_firstname">نام مشتری <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="firstname"  placeholder="نام " id="edit_firstname">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="edit_lastname">تخلص مشتری  <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="lastname"  placeholder="تخلص" id="edit_lastname" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="edit_phone_number">شماره تماس <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control phone font" name="phone_number"  placeholder="شماره تماس" id="edit_phone_number" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group edit_province-div">
                                    <label for="province"> ولایت <span class="text-danger">*</span></label>
                                    <select class="select2 custom-select block edit_province edit_province1" name="province" style="width:100%" id="edit_province">
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
                    </div>
                    <div class="form-group">
                        <label for="edit_currency"> واحد پولی <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block" name="currency" style="width:100%" id="edit_currency">
                            <option  disabled  selected>اتنخاب کردن واحد پولی</option>
                            <option value="افغانی"  data="" >افغانی</option>
                            <option value= "دالر"  data="" >دالر</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"   name="bill_hidden_id" id="bill_hidden_id" value="{{$bills->id}}">
                    <input type="hidden"   name="customer_hidden_id" id="customer_hidden_id">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">لغو کردن</button>
                    <button type="submit" class="btn btn-primary">اضافه کردن</button> 
                </div>
            </form>
        </div>
    </div>
</div><!-- End Edit Modal -->




<!-- Create Modal -->
<div class="modal fade text-left" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">اضافه کردن جنس</h5>
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
                        <label for="quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text goods_value" id="sizing-addon2">00</span>
                            </div>
                            <input type="number" class="form-control font" min="0"  name="quantity_goods"  placeholder=" تعداد جنس " id="quantity_goods">
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="goods_price"> قیمت جنس <span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" name="goods_price"  min="0" placeholder=" قیمت جنس " id="goods_price">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"   name="hidden_id" id="billDocument_hidden_id">
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
                <h5 class="modal-title"> ویرایش کردن جنس </h5>
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
                                <option value="{{$item->id}}"> {{$item->goods_name}} {{$item->type_of}} {{$item->name}} </option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_quantity_goods"> تعداد جنس <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number"  class="form-control font" min="0" max="1000000" name="quantity_goods"  placeholder="تعداد جنس " id="edit_quantity_goods">
                            <div class="input-group-append">
                                <span class="input-group-text edit_goods_value" id="sizing-addon2">تعداد مجموعه جنس های موجود 0 دانه</span>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="goods_price"> قیمت جنس <span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" name="goods_price"  min="0" placeholder=" قیمت جنس " id="edit_goods_price">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"   name="bill_hidden_id" id="edit_bill_hidden_id" value="{{$bills->id}}">
                    <input type="hidden" name="hidden_id" id="edit_billDocument_hidden_id">
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
                },
                searching: false, paging: false, info: false
            });
        });

        $('.alert').hide();
        $('.province1').select2();
        $('.edit_province1').select2();
        $('.customer-old').select2();
        $('.edit_customer-old').select2();
        $('.goods_name').select2();
        $('.phone').inputmask('0-999-999-999');
        $('#checkbox').on('click paste',function() {
            if ( $('#checkbox').attr('checked')) {
                $('.customers-old').css('display','none');
                $('.customers-new').css('display','block');
                $('#checkbox').attr('checked', false);
            } else {
                $('#checkbox').attr('checked', true);
                $('.customers-old').css('display','block');
                $('.customers-new').css('display','none');
            }
        });
        $('.checkbox').on('click paste',function() {
            if ( $('.checkbox').attr('checked')) {
                $('.customers-old').css('display','none');
                $('.customers-new').css('display','block');
                $('.checkbox').attr('checked', false);
            } else {
                $('.checkbox').attr('checked', true);
                $('.customers-old').css('display','block');
                $('.customers-new').css('display','none');
            }
        });
        $('.submit-bill').attr('disabled','disabled');
        $('.save-btn').attr('disabled','disabled');
        $('#money_paid').on('keyup paste',function(){
            var total=$('#total_money').val();
            total=parseInt(total);
            var paid=$('#money_paid').val();
            var remain=total-paid;
            if(total>=paid){
                $('#total_remain').val(remain);
            }
            if(paid==''){
                $('.submit-bill').attr('disabled','disabled');
                $('.save-btn').attr('disabled','disabled');
            }else{
                $('.submit-bill').removeAttr('disabled');
                $('.save-btn').removeAttr('disabled');
            }
        });
    </script>




    {{-- Edit Customer --}}
    <script>
        $('body').on('click', '.create-customer-edit', function() {
            $('#createform-customer-edit').trigger("reset");
            $('.alert-create').hide();
            $(".edit_province1").trigger( "change" );
            $('.customers-old').css('display','none');
            $('.customers-new').css('display','block');
            $('.checkbox').attr('checked', false);
            $('#edit_firstname').removeClass(' is-invalid');
            $('#edit_lastname').removeClass(' is-invalid');
            $('#edit_phone_number').removeClass(' is-invalid');
            $('.edit_province-div .select2-selection--single').removeClass(' border-danger');
            $('#edit_currency').removeClass(' is-invalid');
            $('.edit_customer-div .select2-selection--single').removeClass(' border-danger');
            $('#edit_customer-old').select2();
            var id=$('.create-customer-edit').attr('data-id');
            var url= '{{ url("bills") }}/'+id+'/edit';
            $.get(url,function(data){
                $('#edit_firstname').val(data.firstname);
                $('#edit_lastname').val(data.lastname);
                $('#edit_phone_number').val(data.phone_number);
                $('#edit_province').val(data.province).trigger( "change" );
                $('#edit_currency').val(data.currency);
                $('#customer_hidden_id').val(data.customer_id);
            });
        });
        

        $("#createform-customer-edit").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#edit_firstname').removeClass(' is-invalid');
            $('#edit_lastname').removeClass(' is-invalid');
            $('#edit_phone_number').removeClass(' is-invalid');
            $('.edit_province-div .select2-selection--single').removeClass(' border-danger');
            $('#edit_currency').removeClass(' is-invalid');
            $('.edit_customer-div .select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("update_customer") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.edit_customer-div').load(document.URL + ' .edit_customer-div');
                    $('#create-customer-edit').modal('hide');
                    $('#customer-name').text(data['data'].firstname+' '+data['data'].lastname);
                    $('#customer-phone').text(data['data'].phone_number);
                    $('#customer-province').text(data['data'].province);
                    $('.bill-currency').text(data['data'].currency);
                    $('#bills_hidden_id').val(data['data'].bill_id);
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
                        if(key=='firstname'){
                            $('#edit_firstname').addClass(' is-invalid');
                        }
                        if(key=='lastname'){
                            $('#edit_lastname').addClass(' is-invalid');
                        }
                        if(key=='phone_number'){
                            $('#edit_phone_number').addClass(' is-invalid');
                        }
                        if(key=='province'){
                            $('.edit_province-div .select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='currency'){
                            $('#edit_currency').addClass(' is-invalid');
                        }
                        if(key=='customer_old'){
                            $('.edit_customer-div .select2-selection--single').addClass(' border-danger');
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
        $('#edit_firstname').on('change',function(){
            $('#edit_firstname').removeClass(' is-invalid');
        });
        $('#edit_lastname').on('change',function(){
            $('#edit_lastname').removeClass(' is-invalid');
        });
        $('#edit_phone_number').on('change',function(){
            $('#edit_phone_number').removeClass(' is-invalid');
        });
        $('#edit_province').on('change',function(){
            $('.edit_province-div .select2-selection--single').removeClass(' border-danger');
        });
        $('#edit_currency').on('change',function(){
            $('#edit_currency').removeClass(' is-invalid');
        }); 
        $('#edit_customer-old').on('change',function(){
            $('.edit_customer-div .select2-selection--single').removeClass(' border-danger');
        }); 
    </script>{{-- End Edit Customer --}}








    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $("#goods_name").trigger( "change" );
            $('#quantity_goods').removeClass(' is-invalid');
            $('#goods_price').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $('#billDocument_hidden_id').val($('.create').attr('data-id'));
            $('.goods_value').text(' تعداد جنس های موجود 0 دانه ');
            $('#goods_name').on('change',function(){
                var goods_id=$('#goods_name').val();
                var url='{{ url("stock_out") }}'+'/'+goods_id+'/get_quantity';
                $.get(url,function(data){
                    var quantity=data[0].quantity_goods;
                    $('.goods_value').text(' تعداد جنس های موجود '+' '+quantity+' دانه');
                    $('#quantity_goods').attr('max',quantity);
                })
            });

            var bill_id=$('.create').attr('data-id');
            var url_goods='{{ url("bill_documents") }}'+'/get_goods/'+bill_id;
            $.get(url_goods,function(data){
                var length=data.length;
                var dhead="<option  disabled  selected> اتنخاب کردن جنس </option>";
                for(var i=0;i<length;i++){
                   dhead+='<option value="'+data[i].good_id+'">'+data[i].category_name+' '+data[i].type_of+' '+data[i].goods_name+'</option>';
                }
                $('#goods_name').html(dhead);
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
            $('#quantity_goods').removeClass(' is-invalid');
            $('#goods_price').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("edit_bill_documents") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.total_money').load(document.URL + ' .total_money');
                    $('.total_goods').load(document.URL + ' .total_goods');
                    $('#create-item').modal('hide');
                    var dhead="";
                    var counter=1;
                    var length=data['data'].length;
                    var total_goods=0; var total_money=0;
                    for(var i=0;i<length;i++){
                        dhead+='<tr id="row'+data['data'][i].id+'"> <td>'+ counter++ +'</td>';
                        dhead+='<td>'+data['data'][i].category_name+' '+data['data'][i].type_of+' '+data['data'][i].goods_name+'</td>';
                        dhead+=' <td><span class="font">'+data['data'][i].goods_price+'</span> <span class="bill-currency">'+data['data'][i].currency+'<span></span></td>';
                        dhead+='<td><span class="bullet bullet-success bullet-sm"></span> <span class="font"> '+data['data'][i].quantity_goods+'</span> دانه</td>';
                        money=data['data'][i].quantity_goods*data['data'][i].goods_price;
                        total_money+=money;
                        total_goods+=data['data'][i].quantity_goods;
                        dhead+='<td><span class="badge badge-success badge-pill"><span class="font"> '+money+'</span><span class="bill-currency"> '+data['data'][i].currency+'</span></span></td>';
                        dhead+='<td><a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="'+data['data'][i].id+'" data-goods-id="'+data['data'][i].goods_id+'" ><i class="fa fa-pencil"></i></a><a class="danger delete mr-1" data-id="'+data['data'][i].id+'"><i class="fa fa-trash-o"></i></a></td></tr>';
                    }
                    $('#html').html(dhead);
                    $('#total_money').val(total_money);
                    $('#total_goods').val(total_goods);
                    $('#money_paid').attr('max',total_money);
                    $('.bill-currency').text(data['data'][0].currency);


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
            $('.edit_goods_value').text(' تعداد جنس های موجود 0 دانه ');
            var url ='{{url("bill_documents")}}/'+id+'/edit';
            var mygoods_id=0;
            var quantity_good=0;
            $.get(url,function(data){
                $('#edit_goods_price').val(data.goods_price);
                $('#edit_quantity_goods').val(data.quantity_goods);
                $('#edit_billDocument_hidden_id').val(data.id);
                var url='{{ url("stock_out") }}'+'/'+data.goods_id+'/get_quantity';

                quantity_good=data.quantity_goods;
                $.get(url,function(data){
                    var quantity=data[0].quantity_goods;
                    $('.edit_goods_value').text(' تعداد جنس های موجود '+' '+(quantity+quantity_good)+' دانه');
                    $('#edit_quantity_goods').attr('max',quantity+quantity_good);
                })

                mygoods_id=data.goods_id;
                var bill_id=$('.create').attr('data-id');
                var url_goods='{{ url("bill_documents") }}'+'/update_get_goods/'+bill_id+'/'+mygoods_id;
                $.get(url_goods,function(mydata){
                    var length=mydata.length;
                    var dhead="<option  disabled > اتنخاب کردن جنس </option>";
                    for(var i=0;i<length;i++){
                        if(mygoods_id==mydata[i].good_id){
                            dhead+='<option value="'+mydata[i].good_id+'" selected>'+mydata[i].category_name+' '+mydata[i].type_of+' '+mydata[i].goods_name+'</option>';
                        }else{
                            dhead+='<option value="'+mydata[i].good_id+'">'+mydata[i].category_name+' '+mydata[i].type_of+' '+mydata[i].goods_name+'</option>';
                        }
                    }
                    $('#edit_goods_name').html(dhead);
                }); 

            });
            
            $('#edit_goods_name').on('change',function(){
                var goods_id=$('#edit_goods_name').val();
                var url='{{ url("stock_out") }}'+'/'+goods_id+'/get_quantity';
                if(goods_id==mygoods_id){
                    $.get(url,function(data){
                        var quantity=data[0].quantity_goods;
                        $('.edit_goods_value').text(' تعداد جنس های موجود '+' '+(quantity+quantity_good)+' دانه');
                        $('#edit_quantity_goods').attr('max',(quantity+quantity_good));
                    });
                }else{
                    $.get(url,function(data){
                        var quantity=data[0].quantity_goods;
                        $('.edit_goods_value').text(' تعداد جنس های موجود '+' '+quantity+' دانه');
                        $('#edit_quantity_goods').attr('max',quantity);
                    });
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
            $('#edit_quantity_goods').removeClass(' is-invalid');
            $('#edit_goods_price').removeClass(' is-invalid');
            $('.select2-selection--single').removeClass(' border-danger');
            $.ajax({
                url: '{{ url("edit_bill_documents_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#edit-item').modal('hide');
                    $('.total_money').load(document.URL + ' .total_money');
                    $('.total_goods').load(document.URL + ' .total_goods');
                    $('#create-item').modal('hide');
                    var dhead="";
                    var counter=1;
                    var length=data['data'].length;
                    var total_goods=0; var total_money=0;
                    for(var i=0;i<length;i++){
                        dhead+='<tr id="row'+data['data'][i].id+'"> <td>'+ counter++ +'</td>';
                        dhead+='<td>'+data['data'][i].category_name+' '+data['data'][i].type_of+' '+data['data'][i].goods_name+'</td>';
                        dhead+=' <td><span class="font">'+data['data'][i].goods_price+'</span> <span class="bill-currency">'+data['data'][i].currency+'<span></span></td>';
                        dhead+='<td><span class="bullet bullet-success bullet-sm"></span> <span class="font"> '+data['data'][i].quantity_goods+'</span> دانه</td>';
                        money=data['data'][i].quantity_goods*data['data'][i].goods_price;
                        total_money+=money;
                        total_goods+=data['data'][i].quantity_goods;
                        dhead+='<td><span class="badge badge-success badge-pill"><span class="font"> '+money+'</span><span class="bill-currency"> '+data['data'][i].currency+'</span></span></td>';
                        dhead+='<td><a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="'+data['data'][i].id+'" data-goods-id="'+data['data'][i].goods_id+'" ><i class="fa fa-pencil"></i></a><a class="danger delete mr-1" data-id="'+data['data'][i].id+'"><i class="fa fa-trash-o"></i></a></td></tr>';
                    }
                    $('#html').html(dhead);
                    $('#total_money').val(total_money);
                    $('#total_goods').val(total_goods);
                    $('#money_paid').attr('max',total_money);
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
                        url:'{{url("delete_bill_documents")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
                            $('.total_money').load(document.URL + ' .total_money');
                            $('.total_goods').load(document.URL + ' .total_goods');
                            $('#create-item').modal('hide');
                            var dhead="";
                            var counter=1;
                            var length=data['data'].length;
                            var total_goods=0; var total_money=0;
                            for(var i=0;i<length;i++){
                                dhead+='<tr id="row'+data['data'][i].id+'"> <td>'+ counter++ +'</td>';
                                dhead+='<td>'+data['data'][i].category_name+' '+data['data'][i].type_of+' '+data['data'][i].goods_name+'</td>';
                                dhead+=' <td><span class="font">'+data['data'][i].goods_price+'</span> <span class="bill-currency">'+data['data'][i].currency+'<span></span></td>';
                                dhead+='<td><span class="bullet bullet-success bullet-sm"></span> <span class="font"> '+data['data'][i].quantity_goods+'</span> دانه</td>';
                                money=data['data'][i].quantity_goods*data['data'][i].goods_price;
                                total_money+=money;
                                total_goods+=data['data'][i].quantity_goods;
                                dhead+='<td><span class="badge badge-success badge-pill"><span class="font"> '+money+'</span><span class="bill-currency"> '+data['data'][i].currency+'</span></span></td>';
                                dhead+='<td><a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="'+data['data'][i].id+'" data-goods-id="'+data['data'][i].goods_id+'" ><i class="fa fa-pencil"></i></a><a class="danger delete mr-1" data-id="'+data['data'][i].id+'"><i class="fa fa-trash-o"></i></a></td></tr>';
                            }
                            $('#html').html(dhead);
                            $('#total_money').val(total_money);
                            $('#total_goods').val(total_goods);
                            $('#money_paid').attr('max',total_money);

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
                                ' دیتا های مرتبط موجود است',
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>{{-- End delete form --}}


@endsection
