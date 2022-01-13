<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\employees;
use App\Models\User;
use App\Models\EmployeeSalary;
use App\Models\ActivityLog;
use Helper;

class EmployeesController extends Controller
{
    
    public function index()
    {
        $employees= DB::table('employees')
        ->join('users','users.id','=','employees.user_id')
        ->select('employees.id','users.id as user_id','users.name','users.lastname','users.role','users.email','employees.phone_number','users.profile_photo_path as photo','employees.created_at')
        ->orderBy('created_at','desc')
        ->get();
        return view('dashboard.employees.show',compact('employees'));
    }

   
    public function create()
    {
        return view('dashboard.employees.create');
    }

   
    public function store(Request $request)
    {
        $vlide=$request->validate([
            'name'=>'required|min:3',
            'lastname'=>'required|min:3',
            'username'=>'required|unique:users,username',
            'email'=>'required|email|unique:users,email',
            'role'=>'required',
            'password'=>'required|min:8',
            'confirm_password'=>'required|same:password',
            'phone_number'=>'required|min:10',
            'salary'=>'required',
            'photo'=>'nullable|mimes:jpeg,png,jpg|max:500',
        ]);
        
        if(empty($request->file('photo'))){
            $user=new User();
            $user->name=$request->name;
            $user->lastname=$request->lastname;
            $user->username=$request->username;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->role=$request->role;
            $user->email_verified_at=now();
            $user->save();

            $user_id=$user->id;
            $employee=new Employees();
            $employee->user_id=$user_id;
            $employee->phone_number=$request->phone_number;
            $employee->salary=$request->salary;
            $employee->save();
            
            Helper::addActivityLog('<span class="success" >  کارمند جدید اضافه کرد </span>    <br/><a href="employees/profile/'.$employee->id.'" target="_blank" > دیدن  پروفایل </a>');
            
            session()->flash('status', 'کارمند موفقانه اضافه شد');
            return redirect('employees');
        }else{
            $path=Storage::putFile('employees-img',$request->file('photo'));

            $user=new User();
            $user->name=$request->name;
            $user->lastname=$request->lastname;
            $user->username=$request->username;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->role=$request->role;
            $user->profile_photo_path=$path;
            $user->email_verified_at=now();
            $user->save();

            $user_id=$user->id;
            $employee=new Employees();
            $employee->user_id=$user_id;
            $employee->phone_number=$request->phone_number;
            $employee->salary=$request->salary;
            $employee->save();

            Helper::addActivityLog('<span class="success" >  کارمند جدید اضافه کرد </span>    <br/><a href="employees/profile/'.$employee->id.'" target="_blank" > دیدن  پروفایل </a>');

            session()->flash('status', 'کارمند موفقانه اضافه شد');
            return redirect('employees');
        }
    }

    public function show($id)
    {
        $employee_id=$id;
        $employee= employees::join('users','users.id','=','employees.user_id')->find($employee_id);
        return view('dashboard.employees.update',compact('employee','employee_id'));
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $user= employees::join('users','users.id','=','employees.user_id')->select('users.id')->find($id);
        $vlide=$request->validate([
            'name'=>'required|min:3',
            'lastname'=>'required|min:3',
            'username'=>'required|unique:users,username,'.$user->id.',id',
            'email'=>'required|email|unique:users,email,'.$user->id.',id',
            'role'=>'required',
            'phone_number'=>'required|min:10',
            'salary'=>'required',
            'photo'=>'nullable|mimes:jpeg,png,jpg|max:500',
        ]);
        if(empty($request->file('photo'))){
            employees::join('users','users.id','=','employees.user_id')
            ->where('employees.id',$id)
            ->update([
                'name' => $request->name,
                'lastname'=>$request->lastname,
                'username'=>$request->username,
                'email'=>$request->email,
                'role'=>$request->role,
                'phone_number'=>$request->phone_number,
                'salary'=>$request->salary,
            ]);

            Helper::addActivityLog('<span >  کارمند را ویرایش  کرد </span>    <br/><a href="employees/profile/'.$id.'" target="_blank" > دیدن  پروفایل </a>');

            session()->flash('status', 'کارمند موفقانه ویرایش شد');
            return redirect('employees');
        }else{
            $path=Storage::putFile('employees-img',$request->file('photo'));
            employees::join('users','users.id','=','employees.user_id')
            ->where('employees.id',$id)
            ->update([
                'name' => $request->name,
                'lastname'=>$request->lastname,
                'username'=>$request->username,
                'email'=>$request->email,
                'role'=>$request->role,
                'phone_number'=>$request->phone_number,
                'salary'=>$request->salary,
                'profile_photo_path'=>$path,
            ]);

            Helper::addActivityLog('<span >  کارمند را ویرایش  کرد </span>    <br/><a href="employees/profile/'.$id.'" target="_blank" > دیدن  پروفایل </a>');

            session()->flash('status', 'کارمند موفقانه ویرایش شد');
            return redirect('employees');
        }
    }

    public function resetPassword(Request $request)
    {
        $valid=$request->validate([
            'new_password'=>'required|min:8',
            'confirm_password'=>'required|same:new_password',
        ]);
       if($valid){
            $password= Hash::make($request->new_password);
            employees::join('users','users.id','=','employees.user_id')
            ->where('employees.id',$request->hidden_id)
            ->update([
                'password' =>$password,
            ]);

            Helper::addActivityLog('<span > رمز عبور ( پسورد ) کارمند را تغییر  داد </span>    <br/><a href="employees/profile/'.$request->hidden_id.'" target="_blank" > دیدن  پروفایل </a>');

            return  response()->json(['success'=>'رمز عبور موفقانه تغییر کرد']);
       }

    }

    public function profile($id){
        $employee= employees::join('users','users.id','=','employees.user_id')->find($id);
        $employeeSalary=EmployeeSalary::orderBy('created_at','desc')->where('employee_id',$id)->get();

        $activityLog=ActivityLog::join('users','users.id','activity_logs.user_id')
        ->join('employees','employees.user_id','users.id')
        ->select('activity_logs.activity_description','activity_logs.ip_address','activity_logs.user_agent','activity_logs.created_at')
        ->where('employees.id',$id)
        ->orderBy('activity_logs.created_at','DESC')
        ->get();

        return view('dashboard.employees.profile',compact('employee','employeeSalary','activityLog'));
    }

    
    public function destroy($id)
    {
        $employee= employees::join('users','users.id','=','employees.user_id')->find($id);
        Helper::addActivityLog('<span class="danger" >  کارمند را با مشخضات ( <span class="blue-grey"> نام کارمند : '.$employee->name.' '.$employee->lastname.' / نام کاربری : '.$employee->username.' / ایمل : '.$employee->email.' </span>) حذف  کرد </span>');

        User::join('employees','employees.user_id','=','users.id')
            ->where('employees.id',$id)
            ->delete();
        return response()->json(['success'=>'کارمند موفقانه حذف شد']);    
    }

}
