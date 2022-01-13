@extends('layouts.layout')

@section('site-title')
    Activity Log
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('bills')}}"> فعالیت کارمندان </a></li>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/app-invoice.min.css')}}">

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

        .table thead th{
            border-bottom:1px solid #E6E6E6 !important;
            font-size:13px !important;
        }
        .table tbody td{
            border-bottom:1px solid #E6E6E6 !important;
        }
        .table-responsive #purchases-table{
            border:1px solid #E6E6E6 !important;
            border-top: none !important;
        }

    </style>
@endsection
@section('body')


<section id="basic-form-layouts">
    <div class="row">
        <div class="col-12">
            <div class="card">
  
                <div class="card-content mt-2 pt-50">
                    <div class="card-body">
                        <!-- bills table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table text-center  table-md table-striped display row-grouping  no-wrap icheck table-middle" >
                                <thead class="border-bottom">
                                  <tr>
                                     <th class="px-1">#</th>
                                     <th>تاریخ</th>
                                     <th style="width:150px !important;">مشخصات کارمند</th>
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
                                            <td>
                                                <div class="d-flex">
                                                    <div class=" mr-1" style="width:50px;" >
                                                        @if (empty($row->photo))
                                                            <img class="rounded-circle" src="{{asset('public/assets/images/man.png')}}"  alt="image" style="width:40px; height:40px;border-radius:50%; object-fit: cover; ">
                                                        @else
                                                            <img class="rounded-circle" src="{{asset('storage/app')}}/{{$row->photo}}"  alt="image" style="width:40px; height:40px;border-radius:50%; object-fit: cover; ">
                                                        @endif
                                                    </div>
                                                    <div class="text-left">
                                                        <span class="text-truncate">{{$row->name}} {{$row->lastname}}</span><br>
                                                        <small style="color:#919ca7 !important"> {{$row->email}} </small>
                                                    </div>
                                                </div>
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
</section><!--  layout section end -->


@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#purchases-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
        });
    </script>
        
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
                        url:'{{url("delete_bill")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
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
