@extends('layouts.layout')

@section('site-title')
    Create Employee
@endsection
@section('header-title')
    <li class="breadcrumb-item"> <a href="{{url('employees')}}">کارمندان</a></li>
    <li class="breadcrumb-item"> اضافه کردن</li>
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

<section id="basic-form-layouts">
	<div class="row match-height">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">اضافه کردن کارمند</h4>
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
						<form class="form" method="POST" action="{{url('employees')}}" enctype="multipart/form-data" >
                            @csrf
							<div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">نام کارمند <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') border-danger  @enderror " name="name"  placeholder="نام " value="{{ old('name') }}" >
                                            @error('name')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">تخلص کارمند  <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('lastname') border-danger  @enderror" name="lastname"  placeholder="تخلص" value="{{ old('lastname') }}" >
                                            @error('lastname')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="username">نام کاربری <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('username') border-danger  @enderror" name="username" placeholder="نام کاربری" value="{{ old('username') }}" >
                                            @error('username')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">ایمل ادرس <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') border-danger  @enderror" name="email"  placeholder="ایمل ادرس" value="{{ old('email') }}" >
                                            @error('email')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="role"> وظیفه کارمند <span class="text-danger">*</span></label>
                                            <select class="custom-select block @error('role') border-danger  @enderror" name="role" >
                                                @if (empty(old('role')))
                                                    <option selected disabled>اتنخاب کردن وظیفه </option>
                                                    <option value="admin">ادمین</option>
                                                    <option value="manager">مدیر</option>
                                                    <option value="staff">کارگر</option>
                                                @elseif(old('role')=='admin')
                                                    <option  disabled>اتنخاب کردن وظیفه </option>
                                                    <option value="admin" selected>ادمین</option>
                                                    <option value="manager">مدیر</option>
                                                    <option value="staff">کارگر</option>
                                                @elseif(old('role')=='manager')
                                                    <option  disabled>اتنخاب کردن وظیفه </option>
                                                    <option value="admin" >ادمین</option>
                                                    <option value="manager" selected>مدیر</option>
                                                    <option value="staff">کارگر</option>
                                                @elseif(old('role')=='staff')
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
                                            <label for="password">رمز عبور ( پسورد ) <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('password') border-danger  @enderror" name="password"  placeholder="رمز عبور " value="{{ old('password') }}" >
                                            @error('password')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">تایید رمز عبور ( پسورد ) <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('confirm_password') border-danger  @enderror" name="confirm_password"  placeholder="تایید رمز عبور" value="{{ old('confirm_pasword') }}" >
                                            @error('confirm_password')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">شماره تماس <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control phone font @error('phone_number') border-danger  @enderror" name="phone_number"  placeholder="شماره تماس" value="{{ old('phone_number') }}" >
                                            @error('phone_number')
                                                <p class="text-danger error font" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="salary">معاش کارمند <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control font @error('salary') border-danger  @enderror" name="salary" max="500000" placeholder="معاش کارمند"  value="{{ old('salary') }}" >
                                            @error('salary')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">عکس کارمند <small>(اختیاری)</small> <small>( 500KB حداکثر)</small></label>
                                            <input type="file" class="form-control @error('photo') border-danger  @enderror  dropify" id="input-file-now"  data-max-file-size="0.5M" data-allowed-file-extensions="jepg png jpg"   name="photo"  data-default-file="{{old('photo')}}" placeholder="عکس کارمند"  >
                                            @error('photo')
                                                <p class="text-danger error" >{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
							</div>
							<div class="form-actions text-right py-2 mt-3" >
                               <div class="mt-1">
                                    <a href="{{url('employees')}}" type="button" class="btn btn-danger">لغو کردن</a>
                                    <button type="reset" class="btn btn-primary">تنظم مجدد</button>
                                    <button type="submit" class="btn btn-success">اضافه کردن</button> 
                               </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!--  layout section end -->


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
