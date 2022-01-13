@extends('layouts.layout')

@section('site-title')
    Bills
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('bills')}}">بل ها</a></li>
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

        table tbody tr td{
            padding-top:10px !important;
            padding-bottom:10px !important;
        }

        table thead tr th{
            padding-top:14px !important;
            padding-bottom:14px !important;
        }
    </style>

@endsection
@section('body')


<section id="basic-form-layouts">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-head mb-50 ">
                    <div class="card-header">
                        <div class="heading-elements mt-50 mr-1">
                            @if ($incomplate>0)
                                <a href="{{ url('bills/incomplate_bill') }}" class="btn btn-warning py-75 px-1 mr-1">
                                    <i class="feather icon-alert-triangle mr-50"></i> بل های نا تکمیل <span class="font">( {{$incomplate}} )</span> </a>
                            @endif

                            <a href="{{ url('bills/add_bill') }}" class="btn btn-primary py-75 px-1">
                                <i class="icon icon-plus mr-1"></i> اضافه کردن بل </a>
                            
                        </div>
                    </div>
                </div>
                <div class="card-content mt-2 pt-50">
                    <div class="card-body">
                        <!-- bills table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table text-center   table-white-space table-striped display row-grouping  no-wrap icheck table-middle" >
                                <thead class="border-bottom">
                                  <tr>
                                     <th>#</th>
                                     <th>نمبر بل</th>
                                    <th> نام مشتری </th>
                                    <th>تعداد جنس</th>
                                    <th>مجموعه پول</th>
                                    <th>پول پرداخت شده</th>
                                    <th>پول باقی مانده </th>
                                    <th>تاریخ بل</th>
                                    <th>تنظیمات</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($bills as $row)
                                        <tr id="row{{$row->id}}" >
                                            <td>{{$counter++}}</td>
                                            <td class="font">
                                                Bill-{{$row->bill_num}}</a>
                                            </td>
                                            <td class="primary">
                                                <a href="{{url('customers/info/')}}/{{$row->customer_id}}" target="_blank">
                                                    <span >{{$row->firstname}}  {{$row->lastname}}</span><br/>
                                                    <small style="color:#717b85 !important" class="font"> ({{$row->province}}) </small>
                                                </a>
                                            </td>
                                            <td><span class="font" >{{$row->quantity_goods}}</span> <span>دانه</span></td>
                                            <td><span class="font" >{{$row->total_price}}</span> {{$row->currency}} </td>
                                            <td>
                                                <span class="bullet bullet-success bullet-sm"></span> <span class="font">{{$row->money_paid+Helper::billPayments($row->id)}}</span>   {{$row->currency}}
                                            </td>
                                            <td>
                                                @if ($row->money_remaining-Helper::billPayments($row->id)<=0)
                                                    <span class="badge badge-success badge-pill"> رسید </span>
                                                @else
                                                    <span class="badge badge-danger badge-pill"><span class="font"> {{$row->money_remaining-Helper::billPayments($row->id)}} </span>  {{$row->currency}}</span>
                                                @endif
                                            </td>
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
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                                <a  href="{{url('bills/update')}}/{{$row->id}}" class="primary edit mr-1" target="_blank" ><i class="fa fa-pencil"></i></a>
                                                <a href="{{url('bills/info_bill')}}/{{$row->id}}" class="success  mr-1" target="_blank"><i class="fa fa-eye"></i></a>
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
