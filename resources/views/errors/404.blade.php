<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" style="overflow-x:hidden !important">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Sheek Posh .">
    <meta name="keywords" content="admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Sheek Posh - 404</title>
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

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/error.min.css')}}">




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

            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 p-0">
                        <div class="card-header bg-transparent border-0">
                            <h2 class="error-code text-center mb-2">404</h2>
                            <h3 class="text-uppercase text-center">صفحه یافت نشد !</h3>
                        </div>
                        <div class="card-content">
                            <a href="{{url('dashboard')}}" class="btn btn-primary btn-block"><i class="feather icon-home"></i> داشبورد</a>
                        </div>
                    </div>
                </div>
            </section>
            

          </div>
        </div>
      </div>
      <!-- END: Content-->


  </body>
  <!-- END: Body-->
</html>