@extends('layouts.layout')

@section('site-title')
    Sales
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('bills')}}"> فروشات </a></li>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/app-invoice.min.css')}}">

    <style>
        table tbody tr td{
            padding-top:8px !important;
            padding-bottom:8px !important;
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
                        <!-- sales table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table table-lg text-center   table-white-space table-striped display row-grouping  no-wrap icheck table-middle" >
                                <thead class="border-bottom">
                                  <tr>
                                     <th>#</th>
                                     <th>نمبر بل</th>
                                    <th> نام مشتری </th>
                                    <th>تعداد جنس</th>
                                    <th>مجموعه پول</th>
                                    <th>تاریخ بل</th>
                                    {{-- <th>تنظیمات</th> --}}
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($bills as $row)
                                        <tr id="row" >
                                            <td>{{$counter++}}</td>
                                            <td class="font">
                                                <a href="{{url('bills/info_bill')}}/{{$row->id}}" target="_blank">
                                                    Bill-{{$row->bill_num}}
                                                </a>
                                            </td>
                                            <td style="font-size: 12px">
                                                <a href="{{url('customers/info/')}}/{{$row->customer_id}}" target="_blank" class="grey">
                                                    <span >{{$row->firstname}}  {{$row->lastname}}</span><br/>
                                                    <span style="color:#717b85 !important" class="font"> ({{$row->province}}) </span>
                                                </a>
                                            </td>
                                            <td><span class="font" ><span class="bullet bullet-success bullet-sm"></span> {{$row->quantity_goods}}</span> <span>دانه</span></td>
                                            <td ><span class="font" >{{$row->total_price}}</span> {{$row->currency}} </td>
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
                                                        $date_tiem=\Morilog\Jalali\CalendarUtils::convertNumbers($date_tiem) ;
                                                        echo $date_tiem;
                                                        $time=date_create($row->created_at);
                                                        echo date_format($time,'h:i:s');
                                                    @endphp 
                                                </small>
                                            </td>
                                            {{-- <td>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                                <a href="{{url('bills/info_bill')}}/{{$row->id}}" class="success  mr-1" target="_blank" ><i class="fa fa-eye"></i></a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div><!-- sales table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--  layout section end -->


@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
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

@endsection
