@extends('layouts.layout')

@section('site-title')
    Public Report
@endsection
@section('header-title')
    <li class="breadcrumb-item"> گزارش ها </li>
    <li class="breadcrumb-item"> <a href="{{url('reports/yearly_report')}}"> گزارش عمومی </a> </li>
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
                  <h3> {{$goods}} </h3>
                  <span> تعداد جنس ها </span>
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
                  <h3> {{$employees}} </h3>
                  <span> تعداد کارمندان</span>
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
        <h4 class="text-uppercase"> گزارش های قرض گرفته شده  </h4>
      </div>
    </div>
   

    <div class="row">
        <div class="col-xl-6 col-md-12">
          <div class="card overflow-hidden">
            <div class="card-content">
              <div class="card-body cleartfix">
                <div class="media align-items-stretch">
                  <div class="align-self-center">
                    <i class="icon-arrow-down  warning font-large-2 mr-2"></i>
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
                    <i class="icon-arrow-down  warning font-large-2 mr-2"></i>
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
    
     
  </section>
  <!-- // Purchases section end -->







@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

@endsection
