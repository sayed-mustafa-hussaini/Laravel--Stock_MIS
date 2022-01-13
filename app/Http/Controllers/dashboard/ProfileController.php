<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Customers;
use App\Models\User;
use App\Models\Rent;
use App\Models\Employees;
use App\Rules\MatchOldPassword;
use Helper;
  

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $id=Auth()->id();
        $profile= User::join('employees','employees.user_id','=','users.id')
        ->select('users.id as user_id','users.name','users.lastname','users.username','users.email','users.profile_photo_path','users.role','employees.id','employees.phone_number','employees.salary','employees.created_at')
        ->find($id);
        $rents= Rent::orderBy('created_at','DESC')->get();
        return view('dashboard.profile.profile',compact('rents','profile'));
    }

    

    public function resetPassword(Request $request)
    {
        $valid=$request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password'=>'required|min:8',
            'confirm_password'=>'required|same:new_password',
        ]);
       if($valid){
            $user= User::find($request->hidden_id);
            $password= Hash::make($request->new_password);
            $user->password=$password;
            $user->save();

            $employee=User::join('employees','employees.user_id','=','users.id')
            ->select('employees.id as employee_id')
            ->find(Auth()->id());
            Helper::addActivityLog('<span> رمز عبور ( پسورد ) خود را تغییر داد </span>    <br/><a href="employees/profile/'.$employee->employee_id.'" target="_blank" > دیدن  پروفایل </a>');


            return  response()->json(['success'=>'رمز عبور موفقانه تغییر کرد']);
       }
    }

    public function generalUpdate(Request $request)
    {
        $user= employees::join('users','users.id','=','employees.user_id')->select('users.id')->find($request->hidden_id);
        $valid=$request->validate([
            'name'=>'required|min:3',
            'lastname'=>'required|min:3',
            'username'=>'required|unique:users,username,'.$user->id.',id',
            'phone_number'=>'required|min:10',
        ]);
        if($valid){
            employees::join('users','users.id','=','employees.user_id')
            ->where('employees.id',$request->hidden_id)
            ->update([
                'name' => $request->name,
                'lastname'=>$request->lastname,
                'username'=>$request->username,
                'phone_number'=>$request->phone_number,
            ]);

            $employee=User::join('employees','employees.user_id','=','users.id')
            ->select('employees.id as employee_id')
            ->find(Auth()->id());
            Helper::addActivityLog('<span>  مشخضات پروفایل خود را تغییر داد </span>    <br/><a href="employees/profile/'.$employee->employee_id.'" target="_blank" > دیدن  پروفایل </a>');

            return  response()->json(['success'=>'مشخصات موفقانه ویرایش شد']);
        }
    }

    public function changePhoto(Request $request)
    {
        $valid=$request->validate([
            'photo'=>'mimes:jpeg,png,jpg|max:400',
        ]);
        if($valid)
        {
            $path=Storage::putFile('employees-img',$request->file('photo'));
            $user=User::find($request->hidden_id);
            $user->profile_photo_path=$path;
            $user->save();

            $employee=User::join('employees','employees.user_id','=','users.id')
            ->select('employees.id as employee_id')
            ->find(Auth()->id());
            Helper::addActivityLog('<span> عکس پروفایل خود را تغییر داد </span>    <br/><a href="employees/profile/'.$employee->employee_id.'" target="_blank" > دیدن  پروفایل </a>');

            return  response()->json(['success'=>'عکس موفقانه تبدیل شد']);
        }else{

            $employee=User::join('employees','employees.user_id','=','users.id')
            ->select('employees.id as employee_id')
            ->find(Auth()->id());
            Helper::addActivityLog('<span> عکس پروفایل خود را تغییر داد </span>    <br/><a href="employees/profile/'.$employee->employee_id.'" target="_blank" > دیدن  پروفایل </a>');

            return  response()->json(['success'=>'عکس موفقانه تبدیل شد']);
        }
    }

    public function deletePhoto($id)
    {
        $employee=User::join('employees','employees.user_id','=','users.id')
        ->select('employees.id as employee_id')
        ->find(Auth()->id());
        Helper::addActivityLog('<span class="danger" > عکس پروفایل خود را حذف کرد </span>    <br/><a href="employees/profile/'.$employee->employee_id.'" target="_blank" > دیدن  پروفایل </a>');


        $user=User::find($id);
        $user->profile_photo_path='';
        $user->save();
    }



}
