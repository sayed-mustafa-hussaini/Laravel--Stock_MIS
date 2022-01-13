@extends('layouts.layout')

@section('site-title')
    Get Loan
@endsection
@section('header-title')
    <li class="breadcrumb-item">قرض ها</li>
    <li class="breadcrumb-item"> <a href="{{url('loan/get_loan')}}">قرض گرفته شده</a></li>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/app-invoice.min.css')}}">

    <style>
        table tbody tr td{
            padding-top:10px !important;
            padding-bottom:10px !important;
        }

        table thead tr th{
            padding-top:14px !important;
            padding-bottom:14px !important;
        }

        .table thead th{
            border-bottom:1px solid #E6E6E6 !important;
            font-size:13px !important;
        }
        .table tbody td{
            border-bottom:0px solid #E6E6E6 !important;
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
                        <!-- Loan table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table text-center   table-white-space table-striped display row-grouping  no-wrap icheck table-middle" >
                                <thead class="border-bottom">
                                  <tr>
                                     <th>#</th>
                                     <th>نمبر بل</th>
                                    <th> نام شرکت </th>
                                    <th>مقدار قرض</th>
                                    <th>مقدار پرداخت شده قرض</th>
                                    <th>باقی مانده قرض</th>
                                    <th>تاریخ قرض</th>
                                    {{-- <th>تنظیمات</th> --}}
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($loans as $row)
                                        <tr id="row{{$row->id}}" >
                                            <td>{{$counter++}}</td>
                                            <td class="font">
                                                Bill-{{$row->bill_number}}</a>
                                            </td>
                                            <td class="primary">
                                                <a href="{{url('companies/info/')}}/{{$row->company_id}}" target="_blank">
                                                  {{$row->company_name}}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($row->quantity_loan<=Helper::getPayments($row->id))
                                                    <span class="bullet bullet-success bullet-sm"></span>
                                                @else
                                                    <span class="bullet bullet-warning bullet-sm"></span>
                                                @endif

                                                <span class="font" >{{$row->quantity_loan}}</span> {{$row->currency}} 
                                            </td>
                                            <td>
                                                @if ($row->quantity_loan<=Helper::getPayments($row->id))
                                                    <span class="bullet bullet-success bullet-sm"></span>
                                                @else
                                                    <span class="bullet bullet-warning bullet-sm"></span>
                                                @endif
                                                <span class="font">{{Helper::getPayments($row->id)}}</span>   {{$row->currency}}
                                            </td>
                                            <td>
                                                @if ($row->quantity_loan<=Helper::getPayments($row->id))
                                                    <span class="badge badge-success badge-pill"> رسید کامل </span>
                                                @else
                                                    <span class="badge badge-warning badge-pill"><span class="font">{{$row->quantity_loan-Helper::getPayments($row->id)}}</span>   {{$row->currency}} </span> 
                                                @endif
                                            </td>
                                            <td class="pb-50" style="font-size: 13px;direction:ltr">
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
                                            {{-- <td>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                                <a href="{{url('bills/info_bill')}}/{{$row->id}}" class="success  mr-1" ><i class="fa fa-eye"></i></a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div><!-- Loan table -->
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
                        url:'{{url("loans")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
                            // $('.table').load(document.URL + ' .table');
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
