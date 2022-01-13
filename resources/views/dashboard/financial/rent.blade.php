@extends('layouts.layout')

@section('site-title')
     Rent
@endsection
@section('header-title')
    <li class="breadcrumb-item"> مالی</li>
    <li class="breadcrumb-item"> <a href="{{url('rent')}}">کرایه</a></li>


@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">



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

        .table tr td{
            border:none !important;
        }
        .table thead th{
            border-bottom:1px solid #E6E6E6 !important;
            padding-top:14px !important;
            padding-bottom:14px !important;
        }
        .table tbody td{
            border-bottom:1px solid #E6E6E6 !important;
        }

        .table-responsive #purchases-table tbody td:last-child , .table-responsive #purchases-table thead th:last-child{
            border-left:1px solid #E6E6E6 !important;
        }
        .table-responsive #purchases-table tbody td:first-child , .table-responsive #purchases-table thead th:first-child{
            border-right:1px solid #E6E6E6 !important;
        }

    </style>

@endsection
@section('body')





<section id="basic-form-layouts">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-head mb-50">
                    <div class="card-header">
                        <div class="heading-elements mt-0 mr-1">
                            <button type="button" class="btn btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item">
                                <i class="icon icon-plus mr-1"></i> اضافه کردن کرایه</button>
                        </div>
                    </div>
                </div>
                <div class="card-content mt-2">
                    <div class="card-body">
                        <!-- Rent table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table text-center display table-striped  row-grouping  no-wrap table-middle" >
                                <thead class="border-botto">
                                  <tr>
                                     <th>#</th>
                                    <th>نام مکان</th>
                                    <th>مقدار کرایه</th>
                                    <th>تاریخ پرداخت کرایه</th>
                                    <th>تاریخ ثبت</th>
                                    <th>تنظیمات</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($rents as $row)
                                        <tr id="row{{$row->id}}">
                                            <td class="counter" > {{$counter++}} </td>
                                            <td> {{$row->location}} </td>
                                            <td class="text-primary">
                                                <span class="font mr-25">{{$row->money_quantity}}</span>   {{$row->currency}} 
                                            </td>
                                            <td style="direction: ltr" class="font">
                                                @php
                                                    $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->pay_date));
                                                    echo $date;
                                                @endphp     
                                            </td>
                                            <td class="pb-50 pt-75" style="font-size: 14px;direction:ltr">
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
                                            <td>
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1"  data-id="{{$row->id}}" ><i class="fa fa-pencil"></i></a>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div><!-- Rent table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--  layout section end -->



<!-- Create Modal -->
<div class="modal fade text-left" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">اضافه کردن کرایه</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="createform">
                <div class="modal-body">
                    <div class="alert alert-create alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group location">
                        <label for="location">  نام مکان <span class="text-danger"> * </span></label>
                        <select class="select2 custom-select block" name="location" style="width:100%" id="location">
                            <option  disabled  selected>اتنخاب کردن نام مکان </option>
                            <option value="دفتر"  >دفتر</option>
                            <option value= "گدام"  >گدام</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="money_quantity"> مقدار کرایه <span class="text-danger"> * </span></label>
                        <input type="number" class="form-control font" min="0" max="1000000" name="money_quantity"  placeholder="مقدار کرایه" id="money_quantity">
                    </div>
                    <div class="form-group">
                        <label for="currency"> واحد پولی <span class="text-danger"> * </span></label>
                        <select class="select2 custom-select block" name="currency" style="width:100%" id="currency">
                            <option  disabled  >اتنخاب کردن واحد پولی</option>
                            <option value="افغانی"  selected>افغانی</option>
                            {{-- <option value= "دالر"  >دالر</option> --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_date"> تاریخ پرداخت کرایه <span class="text-danger"> * </span></label>
                        <input type="date" class="form-control font" min="0" max="1000000" name="payment_date"  placeholder="تاریخ پرداخت پول" id="payment_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">لغو کردن</button>
                    <button type="submit" class="btn btn-primary">اضافه کردن</button> 
                </div>
            </form>
        </div>
    </div>
</div><!-- End Create Modal -->




<!-- Edit Modal -->
<div class="modal fade text-left" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش کردن کرایه</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="editform">
                <div class="modal-body">
                    <div class="alert alert-edit alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group location">
                        <label for="edit_location">  نام مکان <span class="text-danger"> * </span></label>
                        <select class="select2 custom-select block" name="location" style="width:100%" id="edit_location">
                            <option  disabled  selected>اتنخاب کردن نام مکان </option>
                            <option value="دفتر"  >دفتر</option>
                            <option value= "گدام"  >گدام</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_money_quantity"> مقدار کرایه <span class="text-danger"> * </span></label>
                        <input type="number" class="form-control font" min="0" max="1000000" name="money_quantity"  placeholder="مقدار کرایه" id="edit_money_quantity">
                    </div>
                    <div class="form-group">
                        <label for="edit_currency"> واحد پولی <span class="text-danger"> * </span></label>
                        <select class="select2 custom-select block" name="currency" style="width:100%" id="edit_currency">
                            <option  disabled  >اتنخاب کردن واحد پولی</option>
                            <option value="افغانی"  selected>افغانی</option>
                            {{-- <option value= "دالر"  >دالر</option> --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_payment_date"> تاریخ پرداخت کرایه <span class="text-danger"> * </span></label>
                        <input type="date" class="form-control font" min="0" max="1000000" name="payment_date"  placeholder="تاریخ پرداخت پول" id="edit_payment_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">لغو کردن</button>
                    <button type="submit" class="btn btn-primary">ذخیره ویرایش</button> 
                </div>
            </form>
        </div>
    </div>
</div><!-- End Edit Modal -->



@endsection
@section('javascript')
    <script src="{{asset('public/assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>

    {{-- <script src="{{asset('public/assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js')}}"></script> --}}

    <script>
        $(document).ready( function () {
            $('#purchases-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            // $('#pay_date').inputmask({"mask": "99-99-9999", "placeholder": 'DD/MM-YYYY'});
        });
        $('.alert').hide();
    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $('#location').removeClass('  border-danger');
            $('#money_quantity').removeClass(' is-invalid');
            $('#payment_date').removeClass(' is-invalid');
        });

        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#location').removeClass('  border-danger');
            $('#money_quantity').removeClass(' is-invalid');
            $('#payment_date').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("rent") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.table').load(document.URL + ' .table');
                    $('#create-item').modal('hide');
                    $('#createform').trigger("reset");
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
                error: function(data) {
                    $(".alert-create").find("ul").html('');
                    $(".alert-create").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert-create").find("ul").append('<li>' + value + '</li>');
                        if(key=='location'){
                            $('#location').addClass('  border-danger');
                        }
                        if(key=='money_quantity'){
                            $('#money_quantity').addClass(' is-invalid');
                        }
                        if(key=='payment_date'){
                            $('#payment_date').addClass(' is-invalid');
                        }
                    });
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
       
        $('#location').on('change',function(){
            $('#location').removeClass('  border-danger');
        });
        $('#money_quantity').on('change',function(){
            $('#money_quantity').removeClass(' is-invalid');
        });
        $('#payment_date').on('change',function(){
            $('#payment_date').removeClass(' is-invalid');
        });
    </script>{{-- create item --}}



    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert-edit').hide();
            $('#editform').trigger("reset");
            $('#edit_location').removeClass('  border-danger');
            $('#edit_money_quantity').removeClass(' is-invalid');
            $('#edit_payment_date').removeClass(' is-invalid');

            var id=$(this).attr('data-id');
            url="rent/"+id+"/edit";
            $.get(url,function(data){
                $('#edit_location').val(data.location); 
                $('#edit_money_quantity').val(data.money_quantity); 
                $('#edit_currency').val(data.currency); 
                $('#edit_payment_date').val(data.payment_date); 
                $('#hidden_id').val(data.id); 
            });
        });

        $("#editform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#edit_location').removeClass('  border-danger');
            $('#edit_money_quantity').removeClass(' is-invalid');
            $('#edit_payment_date').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("rent_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#edit-item').modal('hide');
                    $('.table').load(document.URL + ' .table');
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
                error: function(data) {
                    $(".alert-edit").find("ul").html('');
                    $(".alert-edit").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert-edit").find("ul").append('<li>' + value + '</li>');
                        if(key=='location'){
                            $('#edit_location').addClass(' is-invalid');
                        }
                        if(key=='money_quantity'){
                            $('#edit_money_quantity').addClass(' is-invalid');
                        }
                        if(key=='payment_date'){
                            $('#edit_payment_date').addClass(' is-invalid');
                        }
                    });
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $('#edit_location').on('change',function(){
            $('#edit_type_of_work').removeClass(' is-invalid');
        });
        $('#edit_money_quantity').on('change',function(){
            $('#edit_money_quantity').removeClass(' is-invalid');
        });
        $('#edit_payment_date').on('change',function(){
            $('#edit_payment_date').removeClass(' is-invalid');
        });
    </script>{{-- Edit item --}}

    


        
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
                        url:'{{url("rent")}}/'+id,
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
                                'دیتا های مرتبط دارد',
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>{{-- End delete form --}}



@endsection
