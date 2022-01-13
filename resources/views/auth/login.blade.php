<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" style="overflow-x:hidden !important">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Sheek Posh .">
    <meta name="keywords" content="admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Sheek Posh - Login</title>
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

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/login-register.min.css')}}">




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
          font-size: 14px !important;
      }
      input{
          border-color:#c1ced3;
          color:#2E405C !important;
          font-size: 14px !important;
      }
      input:focus{
          border-color:#a7a1a1 !important;
      }

      .font{ 
        font-size: 14px !important;
            font-family:  Arial, sans-serif !important;
        }

        .danger div{
            display: none !important;
        }
        .danger ul{
            margin-top: 0 !important;
        }
      
    </style>


    @yield('css')

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" >




     <!-- BEGIN: Content-->
     <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
          <div class="content-body">

  <section class="row flexbox-container">
      <div class="col-12 d-flex align-items-center justify-content-center">
          <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                  <div class="card-header border-0 pb-1">
                      <div class="card-title text-center">
                          <div class="p-1"><img src="{{asset('public/assets/images/logo/stack-logo.png')}}"
                                  alt="branding logo">شیک پوش</div>
                      </div>
                      <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>ورود به سیستم</span></h6>
                  </div>
                  <div class="card-content">
                      <div class="card-body">
                        <x-jet-validation-errors class="danger" />
                        @if (session('status'))
                            <div class=" font-medium text-sm ">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                              <fieldset class="form-group position-relative has-icon-left mb-0">
                                  <input type="text" class="form-control form-control-lg" id="user-name"
                                  name="identity" value="{{old('identity')}}" required autofocus 
                                      placeholder="{{ __('ایمل یا نام کاربری') }}">
                                  <div class="form-control-position">
                                      <i class="feather icon-user"></i>
                                  </div>
                              </fieldset>
                              <fieldset class="form-group position-relative has-icon-left">
                                  <input  class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" 
                                      placeholder="{{ __('رمز عبور (پسورد)') }} ">
                                  <div class="form-control-position">
                                      <i class="fa fa-key"></i>
                                  </div>
                              </fieldset>
                              <div class="form-group row">
                                  <div class="col-sm-6 col-12 text-center text-sm-left">
                                      <fieldset>
                                          <input type="checkbox" id="remember_me" class="chk-remember" name="remember">
                                          <label for="remember-me">{{ __('بیاد داشته باش') }}</label>
                                      </fieldset>
                                  </div>
                                  <div class="col-sm-6 col-12 text-center text-sm-right">
                                     @if (Route::has('password.request'))
                                        <a  class="card-link" href="{{ route('password.request') }}">
                                              {{ __('فراموش  رمز عبور (پسورد) ؟') }}
                                          </a>
                                      @endif
                                  </div>
                                  
                              </div>
                              <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                                      class="feather icon-unlock"></i> {{ __('ورود') }}</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

          </div>
        </div>
      </div>
      <!-- END: Content-->



    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('public/assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->


    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('public/assets/js/core/app.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/customizer.min.js')}}"></script>
    <!-- END: Theme JS-->

   
  </body>
  <!-- END: Body-->
</html>