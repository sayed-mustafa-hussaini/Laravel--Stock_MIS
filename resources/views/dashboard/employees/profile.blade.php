@extends('layouts.layout')

@section('site-title')
    Profile Employee
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('employees')}}">کارمندان</a></li>
    <li class="breadcrumb-item"> پروفایل </li>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">

    <style>
       
        .table tr td{
            border:none !important;
        }


        .table thead th{
            border-bottom:1px solid #E6E6E6 !important;
        }
        .table tbody td{
            border-bottom:1px solid #E6E6E6 !important;
        }
        table tbody tr td{
            padding-top:10px !important;
            padding-bottom:10px !important;
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

        
        
        .myborder{
            border: 1px solid #E4E7ED !important;
            margin-bottom:15px;
            text-align: center
        }




    </style>
@endsection
@section('body')

<section id="basic-form-layouts">
	<div class="row match-height">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">مشخصات کارمند</h4>
					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
						</ul>
					</div>
				</div>
                <hr>
				<div class="card-content collapse show">
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-4">
                                <div class="">
                                    @if (empty($employee->profile_photo_path))
                                        <img src="{{asset('public/assets/images/man.png')}}"  alt="Employee image" class="shadow mb-1" style="width:100%; height:300px; object-fit: cover; ">
                                    @else
                                        <img src="{{asset('storage/app')}}/{{$employee->profile_photo_path}}"  alt="Employee image" class="shadow mb-1" style="width:100%; height:300px; object-fit: cover; ">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-8 pl-lg-2">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item  myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                        <span class="">نام</span>
                                                    </span>
                                                    <span class="col-md-8">{{$employee->name}}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                    <span class="">تخلص</span>
                                                    </span>
                                                    <span class="col-md-8">{{$employee->lastname}}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                        <span>نام کاربری</span>
                                                    </span>
                                                    <span class="col-md-8">{{$employee->username}}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                        <span> ایمل ادرس</span>
                                                    </span>
                                                    <span class="col-md-8"><small>{{$employee->email}}</small></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <ul class="list-group">
                                            <li class="list-group-item  myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                        <span>وظیفه</span>
                                                    </span>
                                                    <span class="col-md-8">
                                                        @if ($employee->role=='admin')
                                                            ادمین
                                                        @elseif($employee->role=='manager')
                                                           مدیر
                                                        @elseif($employee->role=='staff')
                                                           کارگر
                                                        @endif    
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="list-group-item  myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                        <span>شماره تماس</span>
                                                    </span>
                                                    <span class="col-md-8">{{$employee->phone_number}}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item   myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                        <span>معاش</span>
                                                    </span>
                                                    <span class="col-md-8">{{$employee->salary}} <span class="ml-50"> افغانی </span> </span>
                                                </div>
                                            </li>
                                            <li class="list-group-item myborder shadow-sm">
                                                <div class="row">
                                                    <span class="float-left text-primary col-md-4">
                                                        <span>تاریخ</span>
                                                    </span>
                                                    <span class="col-md-8" style="direction:ltr !important">
                                                        <span >
                                                            @php
                                                                $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($employee->created_at));
                                                                echo $date;
                                                            @endphp     
                                                        </span>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!--  layout section end -->

<section>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs mb-2  nav-top-border no-hover-bg " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active  px-1" id="account-tab" data-toggle="tab"
                            href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="icon-wallet mr-50"></i><span class="d-none d-sm-block"> پرداخت معاشات </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center px-1" id="information-tab" data-toggle="tab"
                            href="#information" aria-controls="information" role="tab" aria-selected="false">
                            <i class="icon-note mr-50"></i><span class="d-none d-sm-block"> فعالیت </span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-3 mb-2">

                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-lg  table-striped display text-center table-white-space row-grouping  no-wrap table-middle" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="px-1">#</th>
                                        <th>مقدار معاش</th>
                                        <th>تاریخ پرداخت معاش</th>
                                        <th>تاریخ ثبت</th>
                                        {{-- <th>تنظیمات</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($employeeSalary as $row)
                                        <tr>
                                            <td class="px-1">{{$counter++}}</td>
                                            <td class="text-primary">
                                                <span class="font mr-25">{{$row->salary_quantity}}</span>   {{$row->currency}} 
                                            </td>
                                            <td  style="direction:ltr">
                                                <span>
                                                    @php
                                                        $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->pay_date));
                                                        echo $date;
                                                    @endphp     
                                                </span>
                                            </td>
                                            <td class="pb-75" style="direction:ltr">
                                                <span>
                                                    @php
                                                        $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->created_at));
                                                        echo $date;
                                                    @endphp     
                                                </span><br>
                                                <span style="font-size:11px;color:#919ca7 !important" class="font">
                                                    @php
                                                        $date_tiem= \Morilog\Jalali\CalendarUtils::strftime('a ', strtotime($row->created_at));
                                                        $date_tiem=\Morilog\Jalali\CalendarUtils::convertNumbers($date_tiem) ;
                                                        echo $date_tiem;
                                                        $time=date_create($row->created_at);
                                                        echo date_format($time,'h:i:s');
                                                    @endphp 
                                                </span>
                                            </td>
                                            {{-- <td>
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1"   data-id="{{$row->id}}" data-employee-id="{{$row->employee_id}}"  data-salary-quantity="{{$row->salary_quantity}}" data-currency="{{$row->currency}}" data-pay_date="{{$row->pay_date}}"><i class="fa fa-pencil"></i></a>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                            </td> --}}
                                        </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                       
                         <!-- bills table -->
                         <div class="table-responsive">
                            <table id="activityLog-table" class="table text-center  table-md table-striped display row-grouping  no-wrap icheck table-middle" >
                                <thead class="border-bottom">
                                  <tr>
                                     <th class="px-1">#</th>
                                     <th>تاریخ</th>
                                    <th> IP Address </th>
                                    <th>عامل کاربر</th>
                                    <th style="min-width:260px !important"> عمل انجام شده </th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($activityLog as $row)
                                        <tr id="row{{$row->id}}" >
                                            <td>{{$counter++}}</td>
                                            <td class="pb-0" style="font-size: 13px;direction:ltr">
                                                <span class="font">
                                                    @php
                                                        $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->created_at));
                                                        echo $date;
                                                    @endphp     
                                                </span><br>
                                                <small style="color:#919ca7 !important" class="font">
                                                    @php
                                                        $date_tiem= \Morilog\Jalali\CalendarUtils::strftime('a ', strtotime($row->created_at));
                                                        echo $date_tiem;
                                                        $time=date_create($row->created_at);
                                                        echo date_format($time,'h:i:s');
                                                    @endphp 
                                                </small>
                                            </td>
                                            <td class="primary"> {{$row->ip_address}} </td>
                                            <td >
                                                <span style="text-transform: capitalize" class="d-flex flex-column teal small">
                                                    @php
                                                        $user_agent = $row->user_agent;
                                                        if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
                                                        {
                                                            $bname = 'Internet Explorer';
                                                            $ub = "MSIE";
                                                        }
                                                        elseif(preg_match('/Firefox/i',$user_agent))
                                                        {
                                                            $bname = 'Mozilla Firefox';
                                                            $ub = "Firefox";
                                                        }
                                                        elseif(preg_match('/Chrome/i',$user_agent))
                                                        {
                                                            $bname = 'Google Chrome';
                                                            $ub = "Chrome";
                                                        }
                                                        elseif(preg_match('/Safari/i',$user_agent))
                                                        {
                                                            $bname = 'Apple Safari';
                                                            $ub = "Safari";
                                                        }
                                                        elseif(preg_match('/Opera/i',$user_agent))
                                                        {
                                                            $bname = 'Opera';
                                                            $ub = "Opera";
                                                        }
                                                        elseif(preg_match('/Netscape/i',$user_agent))
                                                        {
                                                            $bname = 'Netscape';
                                                            $ub = "Netscape";
                                                        }
                                                    @endphp
                                                    <span> {{$bname}} </span>
                                                    @php
                                                        $bname = 'Unknown';
                                                        $platform = 'Unknown';
                        
                                                        if (preg_match('/linux/i', $user_agent)) {
                                                            $platform = 'linux';
                                                        }
                                                        elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
                                                            $platform = 'mac';
                                                        }
                                                        elseif (preg_match('/windows|win32/i', $user_agent)) {
                                                            $platform = 'windows';
                                                        }
                                                    @endphp  
                                                    <small class="mt-50"> {{$platform}} </small>  
                                                </span>
                                            </td>
                                            <td style="width:200px !important;" class="text-left">
                                                <span class="small" style="white-space: initial;">
                                                    @php
                                                        echo html_entity_decode($row->activity_description);
                                                    @endphp
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div><!-- bills table -->


                    </div>
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
            $('#myTable').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('#activityLog-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
        } );
        $('.alert').hide();
    </script>


@endsection
