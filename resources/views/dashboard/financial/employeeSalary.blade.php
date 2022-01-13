@extends('layouts.layout')

@section('site-title')
    Employees Salaries
@endsection
@section('header-title')
    <li class="breadcrumb-item">بخش مالی</li>
    <li class="breadcrumb-item"> <a href="{{url('employees_salary')}}">معاش کارمندان</a></li>


@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/forms/selects/select2.min.css')}}">



    <style>
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
                                <i class="icon icon-plus mr-1"></i> اضافه کردن معاش کارمند</button>
                        </div>
                    </div>
                </div>
                <div class="card-content mt-2">
                    <div class="card-body">
                        <!-- Employees Salary table -->
                        <div class="table-responsive">
                            <table id="purchases-table" class="table text-center table- table-striped  row-grouping  no-wrap table-middle" >
                                <thead class="border-botto">
                                  <tr>
                                     <th>#</th>
                                    <th>کارمند معاش گیرنده</th>
                                    <th>مقدار معاش</th>
                                    <th>تاریخ پرداخت معاش</th>
                                    <th>تاریخ ثبت</th>
                                    <th>تنظیمات</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($employeeSalary as $row)
                                        <tr id="row{{$row->id}}">
                                            <td>{{$counter++}}</td>
                                            <td>
                                                <span> {{$row->username}} {{$row->user_lastname}}</span><br>
                                                <span style="color:#919ca7 !important" class="font">{{$row->user_email}}</span>
                                            </td>
                                            <td class="text-primary">
                                                <span class="font mr-25">{{$row->salary_quantity}}</span>   {{$row->currency}} 
                                            </td>
                                            <td style="direction: ltr">
                                                <span class="font">
                                                    @php
                                                        $date= \Morilog\Jalali\CalendarUtils::strftime('Y / m / d', strtotime($row->pay_date));
                                                        echo $date;
                                                    @endphp     
                                                </span>
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
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-employee-id="{{$row->employee_id}}" data-goods-id="{{$row->goods_id}}" data-id="{{$row->id}}" data-goods="  {{ $row->category_name }} {{ $row->type_of }} {{ $row->goods_name }}" data-quantity="{{$row->quantity_goods}}" ><i class="fa fa-pencil"></i></a>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div><!-- Employees Salary table -->
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
                <h5 class="modal-title">اضافه کردن معاش کارمند</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="createform">
                <div class="modal-body">
                    <div class="alert alert-create alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group div_emoloyee_name">
                        <label for="emoloyee_name">کارمند معاش گیرنده<span class="text-danger">*</span></label>
                        <select class="select2 custom-select block emoloyee_name" name="emoloyee_name" style="width:100%" id="emoloyee_name">
                            <option  disabled  selected> اتنخاب کردن کارمند </option>
                            @foreach ($employees as $item)
                                <option value="{{$item->id}}"> 
                                   ( {{ $item->email }} )
                                    {{ $item->name }}
                                    {{ $item->lastname }}
                                 </option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="salary_quantity">مقدار معاش<span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" min="0" max="1000000" name="salary_quantity"  placeholder="مقدار معاش" id="salary_quantity">
                    </div>
                    <div class="form-group">
                        <label for="currency"> واحد پولی <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block" name="currency" style="width:100%" id="currency">
                            <option  disabled  >اتنخاب کردن واحد پولی</option>
                            <option value="افغانی"  selected>افغانی</option>
                            {{-- <option value= "دالر"  >دالر</option> --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pay_date">تاریخ پرداخت معاش<span class="text-danger">*</span></label>
                        <input type="date" class="form-control font" min="0" max="1000000" name="pay_date"  placeholder="تاریخ پرداخت معاش" id="pay_date">
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
                <h5 class="modal-title">ویرایش کردن معاش کارمند</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="editform">
                <div class="modal-body">
                    <div class="alert alert-edit alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group div_emoloyee_name">
                        <label for="edit_emoloyee_name">کارمند معاش گیرنده<span class="text-danger">*</span></label>
                        <select class="select2 custom-select block emoloyee_name" name="emoloyee_name" style="width:100%" id="edit_emoloyee_name">
                            <option  disabled  selected> اتنخاب کردن کارمند </option>
                            @foreach ($employees as $item)
                                <option value="{{$item->id}}"> 
                                   ( {{ $item->email }} )
                                    {{ $item->name }}
                                    {{ $item->lastname }}
                                 </option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_salary_quantity">مقدار معاش<span class="text-danger">*</span></label>
                        <input type="number" class="form-control font" min="0" max="1000000" name="salary_quantity"  placeholder="مقدار معاش" id="edit_salary_quantity">
                    </div>
                    <div class="form-group">
                        <label for="edit_currency"> واحد پولی <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block" name="currency" style="width:100%" id="edit_currency">
                            <option  disabled  >اتنخاب کردن واحد پولی</option>
                            <option value="افغانی"  selected>افغانی</option>
                            {{-- <option value= "دالر"  >دالر</option> --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_pay_date">تاریخ پرداخت معاش<span class="text-danger">*</span></label>
                        <input type="date" class="form-control font" min="0" max="1000000" name="pay_date"  placeholder="تاریخ پرداخت معاش" id="edit_pay_date">
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
    <script src="{{asset('public/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    {{-- <script src="{{asset('public/assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js')}}"></script> --}}

    <script>
        $(document).ready( function () {
            $('#purchases-table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
            $('.emoloyee_name').select2();

            // $('#pay_date').inputmask({"mask": "99-99-9999", "placeholder": 'DD/MM-YYYY'});
        });
        $('.alert').hide();
    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $("#emoloyee_name").trigger( "change" );
            $('.select2-selection--single').removeClass(' border-danger');
            $('#pay_date').removeClass(' is-invalid');
            $('#salary_quantity').removeClass(' is-invalid');
        });


        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('.select2-selection--single').removeClass(' border-danger');
            $('#pay_date').removeClass(' is-invalid');
            $('#salary_quantity').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("employees_salary") }}',
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
                        if(key=='emoloyee_name'){
                            $('.div_emoloyee_name .select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='pay_date'){
                            $('#pay_date').addClass(' is-invalid');
                        }
                        if(key=='salary_quantity'){
                            $('#salary_quantity').addClass(' is-invalid');
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
       
        $('#emoloyee_name').on('change',function(){
            $('.div_emoloyee_name .select2-selection--single').removeClass(' border-danger');
        });
        $('#pay_date').on('change',function(){
            $('#pay_date').removeClass(' is-invalid');
        });
        $('#salary_quantity').on('change',function(){
            $('#salary_quantity').removeClass(' is-invalid');
        });
    </script>{{-- create item --}}



    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert-edit').hide();
            $('#editform').trigger("reset");
            $("#edit_emoloyee_name").trigger( "change" );
            $('.div_emoloyee_name .select2-selection--single').removeClass(' border-danger');
            $('#edit_pay_date').removeClass(' is-invalid');
            $('#edit_salary_quantity').removeClass(' is-invalid');

            var id=$(this).attr('data-id');
            url="employees_salary/"+id+"/edit";
            $.get(url,function(data){
                $('#edit_emoloyee_name').val(data.employee_id).trigger("change"); 
                $('#edit_salary_quantity').val(data.salary_quantity); 
                $('#edit_currency').val(data.currency); 
                $('#edit_pay_date').val(data.pay_date); 
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

            $("#edit_emoloyee_name").trigger( "change" );
            $('.div_emoloyee_name .select2-selection--single').removeClass(' border-danger');
            $('#edit_pay_date').removeClass(' is-invalid');
            $('#edit_salary_quantity').removeClass(' is-invalid');

            $.ajax({
                url: '{{ url("employees_salary_update") }}',
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

                        if(key=='emoloyee_name'){
                            $('.div_emoloyee_name .select2-selection--single').addClass(' border-danger');
                        }
                        if(key=='pay_date'){
                            $('#edit_pay_date').addClass(' is-invalid');
                        }
                        if(key=='salary_quantity'){
                            $('#edit_salary_quantity').addClass(' is-invalid');
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
        $('#edit_emoloyee_name').on('change',function(){
            $('.div_emoloyee_name .select2-selection--single').removeClass(' border-danger');
        });
        $('#edit_pay_date').on('change',function(){
            $('#pay_date').removeClass(' is-invalid');
        });
        $('#edit_salary_quantity').on('change',function(){
            $('#edit_salary_quantity').removeClass(' is-invalid');
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
                        url:'{{url("employees_salary")}}/'+id,
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
