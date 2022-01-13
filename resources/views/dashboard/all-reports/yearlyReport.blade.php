@extends('layouts.layout')

@section('site-title')
    Yearly Report
@endsection
@section('header-title')
    <li class="breadcrumb-item"> گزارش ها </li>
    <li class="breadcrumb-item"> <a href="{{url('reports/yearly_report')}}"> گزارش سالانه </a> </li>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/forms/selects/select2.min.css')}}">
@endsection

@section('body')



<!-- Sales section start -->
<section id="sales-statistics">
    <div class="row">
      <div class="col-12 mb-2">
        <h4 class="text-uppercase"> گزارش های عمومی  </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="feather icon-globe primary font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3> {{$company}} </h3>
                  <span>تعداد شرکت ها</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-users warning font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3> {{$customer}} </h3>
                  <span>تعداد مشتریان</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-tag success font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3> {{$purchase}} </h3>
                  <span> تعداد بل ها خرید شده</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-notebook danger font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3> {{$bill}} </h3>
                  <span> تعداد بل ها فروخته شده</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- // Sales section end -->



<hr>
<!-- Purchases section start -->
<section id="minimal-statistics">
    <div class="row">
      <div class="col-12 mb-2 mt-1">
        <h4 class="text-uppercase"> گزارش های خرید  </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-basket-loaded primary font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3> {{$purchase_goods}} دانه</h3>
                  <span>تعدا جنس های خرید شده</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-wallet  warning font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3> 
                      {{$purchase_price_doller}} 
                      <span style="font-size:13px;">دالر</span>
                 </h3>
                  <span>مقدار پول خرید شده به دالر</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-wallet  success font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3> 
                      {{$purchase_price_af}} 
                      <span style="font-size:13px;">افغانی</span>
                    </h3>
                  <span>مقدار پول خرید شده به افغانی</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12">
          <div class="card overflow-hidden">
            <div class="card-content">
              <div class="card-body cleartfix">
                <div class="media align-items-stretch">
                  <div class="align-self-center">
                    <i class="feather icon-grid warning font-large-2 mr-2"></i>
                  </div>
                  <div class="media-body">
                    <h5>مقدار قرض گرفته شده به دالر</h5>
                  </div>
                  <div class="align-self-center">
                    <h1>
                        {{$purchase_loan_price_doller}} 
                        <span style="font-size:14px;">دالر</span>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="col-xl-6 col-md-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body cleartfix">
                <div class="media align-items-stretch">
                  <div class="align-self-center">
                    <i class="feather icon-grid warning font-large-2 mr-2"></i>
                  </div>
                  <div class="media-body">
                    <h5>مقدار قرض گرفته شده به افغانی</h5>
                  </div>
                  <div class="align-self-center"> 
                    <h1>
                        {{$purchase_loan_price_af}} 
                        <span style="font-size:14px;">افغانی</span>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-xl-6 col-md-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body cleartfix">
                <div class="media align-items-stretch">
                  <div class="align-self-center">
                    <h1 class="mr-2">
                        {{$receipt_price_doller}}
                        <span style="font-size:14px;">دالر</span>
                    </h1>
                  </div>
                  <div class="media-body">
                    <h5>مقدار پول پرداخت شده به دالر</h5>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-arrow-up success font-large-2"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="col-xl-6 col-md-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body cleartfix">
                <div class="media align-items-stretch">
                  <div class="align-self-center">
                    <h1 class="mr-2">
                        {{$receipt_price_af}}
                        <span style="font-size:14px;">افغانی</span>
                    </h1>
                  </div>
                  <div class="media-body">
                    <h5>مقدار پول پرداخت شده به افغانی</h5>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-arrow-up success font-large-2"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </section>
  <!-- // Purchases section end -->


<hr>
<!-- Sales section start -->
<section id="sales-statistics">
    <div class="row">
      <div class="col-12 mb-2 mt-1">
        <h4 class="text-uppercase"> گزارش های فروش  </h4>
      </div>
    </div>
 
  <div class="row">
    <div class="col-xl-4 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="media align-items-stretch">
            <div class="p-2 text-center bg-primary">
              <i class="icon icon-bar-chart  font-large-2 white"></i>
            </div>
            <div class="p-2 media-body">
              <h6>تعدا جنس های فروخته شده</h6>
              <h5 class="text-bold-400 mb-0 pt-50"> {{$bill_goods}} دانه</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="media align-items-stretch">
            <div class="p-2 text-center bg-danger">
              <i class="icon-wallet font-large-2 white"></i>
            </div>
            <div class="p-2 media-body">
              <h6>مقدار پول فروخته شده به دالر</h6>
              <h5 class="text-bold-400 mb-0  pt-50">  {{$bill_price_doller}}  دالر</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="media align-items-stretch">
            <div class="p-2 text-center bg-success">
              <i class="icon-wallet font-large-2 white"></i>
            </div>
            <div class="p-2 media-body">
              <h6>مقدار پول فروخته شده به افغانی</h6>
              <h5 class="text-bold-400 mb-0  pt-50">  {{$bill_price_af}}   افغانی</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="bg-warning bg-darken-2 p-2 media-middle">
                            <i class="feather icon-grid font-large-2 white"></i>
                        </div>
                        <div class="media-body p-2">
                            <h5> مقدار قرض داده شده به دالر </h5>
                        </div>
                        <div class="media-right p-2 media-middle">
                            <h1>
                                {{$loan_price_doller}} 
                                <span style="font-size:14px;">دالر</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="bg-warning bg-darken-2 p-2 media-middle">
                            <i class="feather icon-grid font-large-2 white"></i>
                        </div>
                        <div class="media-body p-2">
                            <h5> مقدار قرض داده شده به افغانی </h5>
                        </div>
                        <div class="media-right p-2 media-middle">
                            <h1>
                                {{$loan_price_af}} 
                                <span style="font-size:14px;">افغانی</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 media-middle">
                            <h1>
                                {{$payment_price_doller}} 
                                <span style="font-size:14px;">دالر</span>
                            </h1>
                        </div>
                        <div class="media-body p-2">
                            <h6> مقدار پول رسید شده به دالر</h6>
                        </div>
                        <div class="media-right bg-success bg-darken-2 p-2 media-middle">
                            <i class="icon-arrow-down font-large-2 white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 media-middle">
                            <h1>
                                {{$payment_price_af}} 
                                <span style="font-size:14px;">افغانی</span>
                            </h1>
                        </div>
                        <div class="media-body p-2">
                            <h6> مقدار پول رسید شده به افغانی</h6>
                        </div>
                        <div class="media-right bg-success bg-darken-2 p-2 media-middle">
                            <i class="icon-arrow-down font-large-2 white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
<!-- // Sales section end -->




<hr>
<!-- Financial section start -->
<section id="sales-statistics">
    <div class="row">
      <div class="col-12 mb-2 mt-1">
        <h4 class="text-uppercase"> گزارش های مالی  </h4>
      </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card bg-warning">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body white text-left">
                    <h4> {{$employee_salary+$rent+$financialExpenses}}  <span style="font-size:13px;">افغانی</span></h4>
                    <span> مجموعه کل پول </span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-rocket white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card bg-success">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body white text-left">
                    <h4> {{$employee_salary}}  <span style="font-size:13px;">افغانی</span></h4>
                    <span> مجموعه معاش کارمندان </span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-user white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card bg-danger">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body white text-left">
                    <h4> {{$rent}}  <span style="font-size:13px;">افغانی</span></h4>
                    <span> مجموعه کرایه </span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-pie-chart white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card bg-primary">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body white text-left">
                    <h4> {{$financialExpenses}}  <span style="font-size:13px;">افغانی</span></h4>
                    <span> مجموعه مصارف </span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-support white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<!-- // Financial section end -->




@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

@endsection
