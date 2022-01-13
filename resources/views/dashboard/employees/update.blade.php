@extends('layouts.layout')

@section('site-title')
    Update Employee
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('employees')}}">کارمندان</a></li>
    <li class="breadcrumb-item"> ویرایش کردن </li>
@endsection
@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/dropify.min.css')}}">
<style>
    .error{
        font-size:12px;
        margin-top: 10px;
        margin-right:4px;
    }
</style>

@endsection
@section('body')

<section class="users-edit">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">ویرایش کردن کارمند</h4>
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
                <form class="form" method="POST" action="{{ url("employees") }}/{{$employee_id}}" enctype="multipart/form-data" id="myForm">
                  @csrf
                  @method('PATCH')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label for="name">نام کارمند <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') border-danger  @enderror " name="name"  placeholder="نام " value="{{ $employee->name }}" >
                                    @error('name')
                                        <p class="text-danger error" >{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastname">تخلص کارمند  <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lastname') border-danger  @enderror" name="lastname"  placeholder="تخلص" value="{{ $employee->lastname }}" >
                                    @error('lastname')
                                        <p class="text-danger error" >{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username">نام کاربری <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('username') border-danger  @enderror" name="username" placeholder="نام کاربری" value="{{ $employee->username }}" >
                                    @error('username')
                                        <p class="text-danger error" >{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label for="email">ایمل ادرس <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') border-danger  @enderror" name="email"  placeholder="ایمل ادرس" value="{{ $employee->email }}" >
                                    @error('email')
                                        <p class="text-danger error" >{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role"> وظیفه کارمند <span class="text-danger">*</span></label>
                                    <select class="custom-select block @error('role') border-danger  @enderror" name="role" >
                                        @if ($employee->role=='admin')
                                            <option  disabled>اتنخاب کردن وظیفه </option>
                                            <option value="admin" selected>ادمین</option>
                                            <option value="manager">مدیر</option>
                                            <option value="staff">کارگر</option>
                                        @elseif($employee->role=='manager')
                                            <option  disabled>اتنخاب کردن وظیفه </option>
                                            <option value="admin" >ادمین</option>
                                            <option value="manager" selected>مدیر</option>
                                            <option value="staff">کارگر</option>
                                        @elseif($employee->role=='staff')
                                            <option  disabled>اتنخاب کردن وظیفه </option>
                                            <option value="admin" >ادمین</option>
                                            <option value="manager">مدیر</option>
                                            <option value="staff" selected>کارگر</option>
                                        @endif
                                    </select>
                                    @error('role')
                                        <p class="text-danger error" >{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">شماره تماس <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control phone font @error('phone_number') border-danger  @enderror" name="phone_number"  placeholder="شماره تماس" value="{{ $employee->phone_number }}" >
                                    @error('phone_number')
                                        <p class="text-danger error font" >{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label for="salary">معاش کارمند <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control font @error('salary') border-danger  @enderror" name="salary" max="500000" placeholder="معاش کارمند"  value="{{ $employee->salary }}" >
                                    @error('salary')
                                        <p class="text-danger error" >{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="photo">عکس کارمند <small>(اختیاری)</small> <small>( 500KB حداکثر)</small></label>
                                    <input type="file" class="form-control @error('photo') border-danger  @enderror  dropify" id="input-file-now"  data-max-file-size="0.5M" data-allowed-file-extensions="jepg png jpg"   name="photo"  placeholder="عکس کارمند" data-default-file="{{asset('storage/app')}}/{{$employee->profile_photo_path}}" value="{{ old('photo') }}" >
                                    @error('photo')
                                        <p class="text-danger error" >{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-right py-2 mt-2" >
                        <div class="mt-1">
                            <a href="{{url('employees')}}" type="button" class="btn btn-danger">لغو کردن</a>
                            <button type="submit" class="btn btn-primary">ذخیره ویرایش</button>
                        </div>
                    </div>
				</form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('javascript')

<script src="{{asset('public/assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/dropify.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.phone').inputmask('0-999-999-999');

        $('.dropify').dropify({
            messages: {
                'default': 'یک فایل را در اینجا بکشید و یا کلیک کنید',
                'replace': 'فایل را اینجا بکشید یا کلیک کنید تا جایگزین شود',
                'remove':  'حذف',
                'error':   'اوه, مشکلی پیش آمده .'
            },
            error: {
                'fileSize': 'اندازه فایل بزرگ است (500KB حداکثر).',
            },
        });
    });
</script>

@endsection
