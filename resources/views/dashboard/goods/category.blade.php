@extends('layouts.layout')

@section('site-title')
    Goods Category
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('goods')}}">جنس</a></li>
    <li class="breadcrumb-item">کتگوری</li>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/plugins/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/extensions/sweetalert2.min.css')}}">
   
    <style>
        table tbody  tr:nth-child(odd) .counter{
            background-color: #f1f1f1 !important;
        }
        table tbody  tr:nth-child(even) .counter{
            background-color:#fafafa !important;
        }

        .table thead th{
            border-bottom:1px solid #E6E6E6 !important;
            font-size:13px !important;
        }
    </style>

@endsection
@section('body')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-head mb-25">
                    <div class="card-header">
                        <h4 class="card-title">کتگوری جنس</h4>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 col-sm-12">
                                 <!-- Task List table -->
                                <div class="table-responsive">
                                    <table id="table" class="table table-white-space table-striped display row-grouping  no-wrap icheck table-middle text-center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام کتگوری</th>
                                                <th>تعداد مجموعی کتگوری</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $counter=1; @endphp
                                            @foreach ($goodsCategory as $row)
                                                <tr id="row{{$row->id}}">
                                                    <td class="counter">{{$counter++}}</td>
                                                    <td> {{$row->name}} </td>
                                                    <td>
                                                        @if (Helper::getGoodsQuantity($row->id)<=0)
                                                            <span class="badge badge-danger badge-pill">0  دانه </span>
                                                        @else
                                                            <span class="font">{{Helper::getGoodsQuantity($row->id)}}</span> دانه
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a data-toggle="modal" data-target="#edit-item" class="primary edit mr-1" data-id="{{$row->id}}" data-name="{{$row->name}}" ><i class="fa fa-pencil"></i></a>
                                                        <a class="danger delete mr-1" data-id={{$row->id}}><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>
                                </div><!-- Task List table -->
                            </div>
                            <div class="col-md-1 col-sm-12"></div>
                            <div class="col-md-5 col-sm-12">
                                <form class="form pt-3 pr-md-5" id="createCategory">
                                    <div class="form-body">
                                        <h5 class="form-section"><i class="fa fa-paperclip"></i> اضافه کردن کتگوری</h5>
                                        <div class="pt-1 pb-25 ">
                                            <div class="form-group">
                                                <label for="nameCategory">نام کتگوری</label>
                                                <input type="text" id="nameCategory" class="form-control" placeholder="نام" name="name">
                                            </div>
                                            <div class="alert alert1 alert-danger">
                                                <ul id="error" class="p-0 m-0 px-2"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-right">
                                        <button type="reset" class="btn btn-warning mr-50">
                                            <i class="feather icon-x"></i> پاک کردن
                                        </button>
                                        <button type="submit" class="btn btn-primary"> اضافه کردن </button>
                                    </div>
                                </form>
                            </div>

                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--  layout section end -->

 <!-- Edit Modal -->
 <div class="modal fade text-left" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content p-1">
        <div class="modal-header">
          <h5 class="modal-title">ویرایش کردن کتگوری</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" id="editform">
            <div class="modal-body">
                <div class="form-body">
                    <div class="pt-1 pb-25 ">
                        <div class="alert alert-create alert-danger">
                            <ul id="error" class="p-0 m-0 px-2"></ul>
                        </div>
                        <div class="form-group">
                            <label for="nameCategory">نام کتگوری</label>
                            <input type="text" id="edit-nameCategory" class="form-control" placeholder="نام" name="name">
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

    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
           
            $('#color').DataTable({
                "language": {
                    "url": "{{asset('public/Persian.json')}}"
                }
            });
        } );
    </script>

    
    {{-- create goods category item --}}
    <script>
        $('.alert').css('display','none');
        $('#createCategory').trigger("reset");
        $('#nameCategory').removeClass(' is-invalid');


        $("#createCategory").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("goods_category") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('.alert').css('display','none');
                    $('#nameCategory').removeClass(' is-invalid');
                    $('#createCategory').trigger("reset");
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
                    $(".alert").find("ul").html('');
                    $(".alert").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert").find("ul").append('<li>' + value + '</li>');
                        if(key=='name'){
                            $('#nameCategory').addClass(' is-invalid');
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
        $('#nameCategory').on('keypress',function(){
            $('#nameCategory').removeClass(' is-invalid');
        });
    </script>    {{-- create goods category item --}}





    {{-- Edit item --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.alert2').css('display','none');
            $('#edit-nameCategory').removeClass(' is-invalid');
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            $('#hidden_id').val(id);
            $('#edit-nameCategory').val(name);
        });

        $("#editform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $('#edit-nameCategory').removeClass(' is-invalid');
            $.ajax({
                url: '{{ url("goodsCategory_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $('#edit-item').modal('hide');
                    $('#nameCategory').removeClass(' is-invalid');
                    $('#createCategory').trigger("reset");
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
                    $(".alert2").find("ul").html('');
                    $(".alert2").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert2").find("ul").append('<li>' + value + '</li>');
                        if(key=='lastname'){
                            $('#edit-nameCategory').addClass(' is-invalid');
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
        $('#edit-nameCategory').on('keypress',function(){
            $('#edit-nameCategory').removeClass(' is-invalid');
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
                       url:'{{url("goods_category")}}/'+id,
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
                               'کتگوری جنس دیتا های مرتبط دارد',
                               'error'
                           )
                       }
                   });
               }
           })
       });
</script>{{-- End delete form --}}



@endsection
