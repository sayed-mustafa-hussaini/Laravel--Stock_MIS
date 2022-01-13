<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" style="overflow-x:hidden !important">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Sheek Posh .">
    <meta name="keywords" content="admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Sheek Posh - @yield('site-title')</title>
    <link rel="apple-touch-icon" href="{{asset('public/assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/vendors-rtl.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/custom-rtl.min.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/meteocons/style.min.css')}}">
    <!-- END: Page CSS-->


    {{-- DataTable Custome Style --}}
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/datatablestyle.css')}}">


    <style>
        @font-face {font-family: "IRANYekan";
          src: url("{{asset('public/assets/fonts/IRANYekan/235b71a9b409e684e865eb4a996e925e.eot')}}"); /* IE9*/
          src: url("{{asset('public/assets/fonts/IRANYekan/235b71a9b409e684e865eb4a996e925e.eot?#iefix')}}") format("embedded-opentype"), /* IE6-IE8 */
          url("{{asset('public/assets/fonts/IRANYekan/235b71a9b409e684e865eb4a996e925e.woff2')}}") format("woff2"), /* chrome、firefox */
          url("{{asset('public/assets/fonts/IRANYekan/235b71a9b409e684e865eb4a996e925e.woff')}}") format("woff"), /* chrome、firefox */
          url("{{asset('public/assets/fonts/IRANYekan/235b71a9b409e684e865eb4a996e925e.ttf')}}") format("truetype"), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
          url("{{asset('public/assets/fonts/IRANYekan/235b71a9b409e684e865eb4a996e925e.svg#IRANYekan')}}") format("svg"); /* iOS 4.1- */
        }
   
  
      html,body,a,li,span,ol,ul,div,h1,h2,h3,h4,h5,h6{
        font-family: "IRANYekan",Montserrat,Georgia,'Times New Roman',Times,serif !important;
        font-style:normal;
        -webkit-font-smoothing: antialiased;
        -webkit-text-stroke-width: 0.2px;
        -moz-osx-font-smoothing: grayscale;
      }

      .main-menu .nav-item a{
        font-size:13px !important;
      }
      .main-menu .navigation-header{
        font-size:16px !important;
      }



      /* form input codes */
      .custom-select{
          border-color:#c1ced3 ;
          color:#2E405C !important;
       }
      .custom-select:focus{
          border-color: #a7a1a1 !important;
          box-shadow:none !important;
       }
      .custom-select option:first-child{
          background:#e2e0e0 !important
      }
      input::placeholder{
          color:#b3b3b3 !important;
          font-family: "IRANYekan",Montserrat,Georgia,'Times New Roman',Times,serif !important;
      }
      input{
          border-color:#c1ced3;
          color:#2E405C !important;
      }
      input:focus{
          border-color:#a7a1a1 !important;
      }

      .font{ 
            font-family:  Arial, sans-serif !important;
        }
      
      .table tbody{
        color:#212529 !important;
      }
    </style>


    @yield('css')

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" >

    @auth
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="stack admin logo" src="{{asset('public/assets/images/logo/stack-logo-light.png')}}">
                <h4 class="brand-text p-0 m-0">شیک پوش</h4></a></li>
            <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon feather icon-toggle-right font-medium-3 white" data-ticon="feather.icon-toggle-right"></i></a></li>
            <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">

              
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon feather icon-maximize"></i></a></li>
              <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon feather icon-search"></i></a>
                <div class="search-input">
                  <input class="input" type="text" placeholder="Explore Stack..." tabindex="0" data-search="template-search">
                  <div class="search-input-close"><i class="feather icon-x"></i></div>
                  <ul class="search-list"></ul>
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav float-right">
             
              
              <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (empty(Auth()->user()->profile_photo_path))
                            <img src="{{asset('public/assets/images/man.png')}}" alt="profile"  style="height:34px; width:34px; object-fit:cover;border-radius:50%;"><i></i>
                        @else
                          <img src="{{asset('storage/app')}}/{{Auth()->user()->profile_photo_path}}" alt="profile"  style="height:34px; width:34px; object-fit:cover;border-radius:50%;"><i></i>
                        @endif
                    </div>
                    <span class="user-name">
                      
                      @if (Auth()->user())
                        {{Auth()->user()->name}} {{Auth()->user()->lastname}}
                      @else
                        Guest
                      @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{url('profile')}}"><i class="feather icon-user"></i>Edit Profile</a>
                  {{-- <a class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> My Inbox</a>
                  <a class="dropdown-item" href="user-cards.html"><i class="feather icon-check-square"></i> Task</a>
                  <a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a> --}}
                <div class="dropdown-divider"></div>
                  <form action="{{route('logout')}}" method="POST">
                    @csrf
                      <button class="dropdown-item  text-danger" type="submit"><i class="feather icon-power"></i>خارج شدن</button>
                  </form>
              </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->

      
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="main-menu-content" >
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

          <li class=" navigation-header"><span>عمومی</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
          </li>
          <hr class="mb-0 pb-0">
          <li class=" nav-item">
              <a href="{{url('dashboard')}}" data-toggle="tab"><i class=" icon-home"></i><span class="menu-title" data-i18n="dashboard">داشبورد</span></a>
          </li>
          <li class=" nav-item">
              <a href="{{url('customers')}}" data-toggle="tab"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="employees">مشتریان</span></a>
          </li>
          <li class=" nav-item"><a href="#"><i class="icon-handbag"></i><span class="menu-title" data-i18n="Invoice">جنس</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{url('goods')}}" data-i18n="Invoice List">جنس</a></li>
                <li><a class="menu-item" href="{{url('goods_category')}}" data-i18n="Invoice View">کتگوری</a></li>
              </ul>
          </li>
          <li class=" nav-item">
              <a href="{{url('companies')}}" data-toggle="tab"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="employees">شرکت</span></a>
          </li>
          @if (Auth::user()->role=='admin' ||  Auth::user()->role=='manager')
            <li class=" nav-item">
                <a href="{{url('purchases')}}" data-toggle="tab"><i class="icon-tag"></i><span class="menu-title" data-i18n="employees">خرید ها</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="icon-directions"></i><span class="menu-title" data-i18n="Invoice">گدام</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="{{url('stock')}}" data-i18n="Invoice List">ذخیره شده</a></li>
                  <li><a class="menu-item" href="{{url('stock_out')}}" data-i18n="Invoice View">خارج شده</a></li>
                </ul>
            </li>
          @endif
          @if (Auth::user()->role=='admin')
            <li class=" nav-item"><a href="#"><i class="icon icon-credit-card"></i><span class="menu-title" data-i18n="Invoice">بخش مالی</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{url('employees_salary')}}" data-i18n="Employees Salary">ماش کارمندان</a></li>
                <li><a class="menu-item" href="{{url('financial_expenses')}}" data-i18n="Rent View">مصارف مالی</a></li>
                <li><a class="menu-item" href="{{url('rent')}}" data-i18n="Invoice View">کرایه</a></li>
              </ul>
          </li>
          @endif
         
          <li class=" nav-item"><a href="#"><i class="icon-notebook"></i><span class="menu-title" data-i18n="Invoice">بل ها</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{url('bills/add_bill')}}" data-i18n="َAdd new bill">اضافه کردن بل</a></li>
                <li><a class="menu-item" href="{{url('bills')}}" data-i18n="Bill View">لیست بل ها</a></li>
              </ul>
          </li>

  
          @if (Auth::user()->role=='admin' ||  Auth::user()->role=='manager')
            <li class=" nav-item">
                <a href="{{url('sales')}}" data-toggle="tab"><i class="icon-bar-chart"></i><span class="menu-title" data-i18n="employees"> فروشات </span></a>
            </li>
          @endif
          

          @if (Auth::user()->role=='admin' ||  Auth::user()->role=='manager')
            <li class=" navigation-header"><span>حسابات</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
              <hr class="mb-0 pb-0">
            <li class=" nav-item"><a href="#"><i class="feather icon-sliders"></i><span class="menu-title" data-i18n="Invoice">قرض</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="{{url('loan/get_loan')}}" data-i18n="Employees Salary">قرض گرفته شده</a></li>
                  <li><a class="menu-item" href="{{url('loan/give_loan')}}" data-i18n="Rent View">قرض داده شده</a></li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="{{url('payments')}}" data-toggle="tab"><i class="icon-arrow-up"></i><span class="menu-title" data-i18n="employees"> پرداخت ها </span></a>
            </li>
            <li class=" nav-item">
                <a href="{{url('receipts')}}" data-toggle="tab"><i class="icon-arrow-down"></i><span class="menu-title" data-i18n="employees"> رسید ها </span></a>
            </li>

            <li class=" nav-item"><a href="#"><i class="feather icon-grid"></i><span class="menu-title" data-i18n="Invoice">گزارش ها</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{url('reports/weekly_report')}}" data-i18n="Weekly report view">گزارش هفتگی</a></li>
                <li><a class="menu-item" href="{{url('reports/monthly_report')}}" data-i18n="Monthly report View">گزارش ماهانه</a></li>
                <li><a class="menu-item" href="{{url('reports/yearly_report')}}" data-i18n="Yearly Report View">گزارش سالانه</a></li>
                <li><a class="menu-item" href="{{url('reports/public_report')}}" data-i18n="Public Report View">گزارش عمومی</a></li>
              </ul>
          </li>
        @endif

          <li class=" navigation-header"><span>تنظیمات</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
            <hr class="mb-0 pb-0">
          <li class=" nav-item">
              <a href="{{url('profile')}}" data-toggle="tab"><i class="icon-user"></i><span class="menu-title" data-i18n="employees"> پروفایل </span></a>
          </li>
          @if (Auth::user()->role=='admin')
            <li class=" nav-item">
                <a href="{{url('employees')}}" data-toggle="tab"><i class="icon-users"></i><span class="menu-title" data-i18n="employees">کارمندان</span></a>
            </li>
            <li class=" nav-item mb-1">
                <a href="{{url('activity_log')}}" data-toggle="tab"><i class="feather icon-align-center"></i><span class="menu-title" data-i18n="employees">فعالیت ها</span></a>
            </li>
          @endif



        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->
    @endauth


    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-3 mt-1">

            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">

                  @auth
                  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">داشبورد</a>
                  </li>
                  @endauth
                  {{-- <li class="breadcrumb-item"><a href="#">Users</a>
                  </li> --}}
                  @yield('header-title')


                </ol>
              </div>
            </div>

          </div>
        </div>
        
        <div class="content-body"><!-- fitness target -->


              @yield('body')


        </div>
      </div>
    </div>
    <!-- END: Content-->
    


    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="fcontloat-md-left d-block d-md-inline-block">Copyright  &copy; 2020 <a class="text-bold-800 grey darken-2" href="#" target="_blank">Sheek Posh</a></span><span class="float-md-right d-none d-lg-block"> Sayed Mustafa <i class="feather icon-heart pink"></i></span></p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('public/assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->


    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('public/assets/js/core/app.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/customizer.min.js')}}"></script>
    <!-- END: Theme JS-->

   
    <script>
        $(document).ready(function() {
            $(".navigation .nav-item a").each(function(e){              
                    if($(this).attr("href")==window.location.href){
                        $(this).parent().addClass(localStorage.ClassName);   
                    }
            });
        });
    </script>

    @yield('javascript')
  </body>
  <!-- END: Body-->
</html>