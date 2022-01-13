@extends('layouts.layout')

@section('site-title')
    Goods
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('goods')}}">جنس</a></li>
    {{-- <li class="breadcrumb-item"> اضافه کردن</li> --}}
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
        table tbody tr td{
            padding-top:10px !important;
            padding-bottom:10px !important;
            font-weight: normal !important;
            color:#404E67 !important;
        }
        table thead tr th{
            padding-top:10px !important;
            padding-bottom:10px !important;
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
                        {{-- <h4 class="card-title">All Contacts</h4> --}}
                        <div class="heading-elements mt-0 mr-1">
                            <button type="button" class="btn btn-primary btn-min-width create" data-toggle="modal" data-target="#create-item">
                                <i class="icon icon-plus mr-1"></i> اضافه کردن جنس</button>
                        </div>
                    </div>
                </div>
                <div class="card-content mt-2">
                    <div class="card-body">
                        <!-- Task List table -->
                        <div class="table-responsive">
                            <table id="goodsTable" class="table table-white-space table-striped display row-grouping  no-wrap icheck table-middle text-center ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کتگوری جنس</th>
                                        <th>نام جنس</th>
                                        <th>نوعیت جنس</th>
                                        <th> رنگ های جنس </th>
                                        <th>سایز جنس</th>
                                        {{-- <th>تاریخ ثبت</th> --}}
                                        <th>تنظیمات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter=1; @endphp
                                    @foreach ($goods as $row)
                                        <tr id="row{{$row->id}}">
                                            <td class="counter">{{$counter++}}</td>
                                            <td> {{$row->category_name}} </td>
                                            <td style="color:#009C9F !important;">{{$row->name}} </td>
                                            <td class="text-center"> {{$row->type_of}} </td>
                                            <td class="text-center"> <span class="bullet bullet-success bullet-sm mr-50"></span><span class="font"> {{$row->color}} </span>  رنگ</td>
                                            <td><span class="font"> {{$row->size}} </span>  سایز</td>
                                            {{-- <td class="pb-75 font">
                                                <span>
                                                    @php
                                                        $date= \Morilog\Jalali\CalendarUtils::strftime('Y / M / d', strtotime($row->created_at));
                                                        $date=\Morilog\Jalali\CalendarUtils::convertNumbers($date) ;
                                                        echo $date;
                                                    @endphp     
                                                </span><br>
                                                <small style="color:#919ca7 !important">
                                                    @php
                                                        $date_tiem= \Morilog\Jalali\CalendarUtils::strftime('a ', strtotime($row->created_at));
                                                        $date_tiem=\Morilog\Jalali\CalendarUtils::convertNumbers($date_tiem) ;
                                                        echo $date_tiem;
                                                        $time=date_create($row->created_at);
                                                        echo date_format($time,'h:i:s');
                                                    @endphp 
                                                </small>
                                            </td> --}}
                                            <td>
                                                <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}"><i class="fa fa-pencil"></i></a>
                                                <a class="danger delete mr-1" data-id="{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                <h5 class="modal-title">اضافه کردن جنس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="createform">
                <div class="modal-body">
                    <div class="alert alert-create alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group">
                        <label for="name">نام جنس <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name"  placeholder="نام " id="name">
                    </div>
                    <div class="form-group">
                        <label for="type_of"> نوعیت جنس <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block" name="type_of" style="width:100%" id="type_of">
                            <option selected disabled>اتنخاب کردن نوعیت</option>
                            <option value="دخترانه">دخترانه</option>
                            <option value="بجه گانه">بچه گانه</option>
                            <option value="نوجوان بچه گانه">نوجوان بچه گانه</option>
                            <option value="نوجوان دخترانه">نوجوان دخترانه </option>
                            <option value="مردانه">مردانه</option>
                            <option value="زنانه">زنانه</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category"> کتگوری جنس <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block" name="category" style="width:100%" id="category">
                            <option selected disabled>اتنخاب کردن کتگوری </option>
                            @foreach ($goodsCategory as $item)
                            <option value="{{$item->id}}" >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="size"> سایز جنس <span class="text-danger">*</span></label>
                                <input type="text" class="form-control size" name="size"  placeholder="سایز " id="size">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="color"> رنگ جنس <span class="text-danger">*</span></label>
                                <input type="text" class="form-control color" name="color"  placeholder="رنگ " id="color">
                            </div>
                        </div>
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
                <h5 class="modal-title">ویرایش کردن جنس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="editform">
                <div class="modal-body">
                    <div class="alert alert-edit alert-danger">
                        <ul id="error" class="p-0 m-0 px-2"></ul>
                    </div>
                    <div class="form-group">
                        <label for="name">نام جنس <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name"  placeholder="نام " id="edit_name">
                    </div>
                    <div class="form-group">
                        <label for="type_of"> نوعیت جنس <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block" name="type_of" style="width:100%" id="edit_type_of">
                            <option selected disabled>اتنخاب کردن نوعیت</option>
                            <option value="دخترانه">دخترانه</option>
                            <option value="بجه گانه">بچه گانه</option>
                            <option value="نوجوان بچه گانه">نوجوان بچه گانه</option>
                            <option value="نوجوان دخترانه">نوجوان دخترانه </option>
                            <option value="مردانه">مردانه</option>
                            <option value="زنانه">زنانه</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category"> کتگوری جنس <span class="text-danger">*</span></label>
                        <select class="select2 custom-select block" name="category" style="width:100%" id="edit_category">
                            <option selected disabled>اتنخاب کردن کتگوری </option>
                            @foreach ($goodsCategory as $item)
                            <option value="{{$item->id}}" >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="size"> سایز جنس <span class="text-danger">*</span></label>
                                <input type="text" class="form-control size" name="size"  placeholder="سایز " id="edit_size">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="color"> رنگ جنس <span class="text-danger">*</span></label>
                                <input type="text" class="form-control color" name="color"  placeholder="رنگ " id="edit_color">
                            </div>
                        </div>
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
    <script src="{{asset('public/assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#goodsTable').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
        } );
        $('.alert').hide();
        $('.size').inputmask('9');
        $('.color').inputmask('9');
    </script>



    {{-- create item --}}
    <script>
        $('body').on('click', '.create', function() {
            $('#createform').trigger("reset");
            $('.alert-create').hide();
            $('#name').removeClass(' is-invalid');
            $('#type_of').removeClass('  border-danger');
            $('#category').removeClass('  border-danger');
            $('#size').removeClass(' is-invalid');
            $('#color').removeClass(' is-invalid');
        });
        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#name').removeClass(' is-invalid');
            $('#type_of').removeClass('  border-danger');
            $('#category').removeClass('  border-danger');
            $('#size').removeClass(' is-invalid');
            $('#color').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("goods") }}',
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
                        if(key=='name'){
                            $('#name').addClass(' is-invalid');
                        }
                        if(key=='type_of'){
                            $('#type_of').addClass(' border-danger');
                        }
                        if(key=='category'){
                            $('#category').addClass(' border-danger');
                        }
                        if(key=='size'){
                            $('#size').addClass(' is-invalid');
                        }
                        if(key=='color'){
                            $('#color').addClass(' is-invalid');
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
        $('#name').on('keypress',function(){
            $('#name').removeClass(' is-invalid');
        });
        $('#type_of').on('keypress',function(){
            $('#type_of').removeClass(' border-danger');
        });
        $('#category').on('keypress',function(){
            $('#category').removeClass(' border-danger');
        });
        $('#size').on('keypress',function(){
            $('#size').removeClass(' is-invalid');
        });
        $('#color').on('change',function(){
            $('#color').removeClass(' is-invalid');
        }); 
    </script>{{-- create item --}}



    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert-edit').hide();
            $('#editform').trigger("reset");
            $('#edit_name').removeClass(' is-invalid');
            $('#edit_type_of').removeClass('  border-danger');
            $('#edit_category').removeClass('  border-danger');
            $('#edit_size').removeClass(' is-invalid');
            $('#edit_color').removeClass(' is-invalid');
            var id=$(this).attr('data-id');
            var url ='{{url("goods")}}/'+id+'/edit';
            $.get(url,function(data){
                console.log(data);
                $('#edit_name').val(data.name);
                $('#edit_type_of').val(data.type_of);
                $('#edit_category').val(data.category_id);
                $('#edit_size').val(data.size);
                $('#edit_color').val(data.color);
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
            $('#edit_name').removeClass(' is-invalid');
            $('#edit_type_of').removeClass('  border-danger');
            $('#edit_category').removeClass('  border-danger');
            $('#edit_size').removeClass(' is-invalid');
            $('#edit_color').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("goods_update") }}',
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
                        if(key=='name'){
                            $('#edit_name').addClass(' is-invalid');
                        }
                        if(key=='type_of'){
                            $('#edit_type_of').addClass(' border-danger');
                        }
                        if(key=='category'){
                            $('#edit_category').addClass(' border-danger');
                        }
                        if(key=='size'){
                            $('#edit_size').addClass(' is-invalid');
                        }
                        if(key=='color'){
                            $('#edit_color').addClass(' is-invalid');
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
        $('#edit_name').on('keypress',function(){
            $('#edit_name').removeClass(' is-invalid');
        });
        $('#edit_type_of').on('keypress',function(){
            $('#edit_type_of').removeClass(' border-danger');
        });
        $('#edit_category').on('keypress',function(){
            $('#edit_category').removeClass(' border-danger');
        });
        $('#edit_size').on('keypress',function(){
            $('#edit_size').removeClass(' is-invalid');
        });
        $('#edit_color').on('change',function(){
            $('#edit_color').removeClass(' is-invalid');
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
                        url:'{{url("goods")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                            Swal.fire(
                                'موفقانه حذف شد !',
                                'فایل شما حذف شده است.',
                                'success'
                            )
                            $('#row'+id).hide(1500);
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
