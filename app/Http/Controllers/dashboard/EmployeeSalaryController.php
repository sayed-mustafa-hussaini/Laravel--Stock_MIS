<?php
namespace App\Http\Controllers\dashboard;

use App\Models\Stock;
use App\Models\employees;
use App\Models\User;
use App\Models\StockHistory;
use Helper;

use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees=employees::join('users','users.id','=','user_id')
        ->select('employees.id as id','users.email as email','employees.created_at','users.name','users.lastname')
        ->orderBy('employees.created_at','DESC')
        ->get();
        $employeeSalary= EmployeeSalary::join('employees','employees.id','employee_salaries.employee_id')
        ->join('users','users.id','employees.user_id')
        ->select('employee_salaries.id as id','employee_salaries.salary_quantity','employee_salaries.currency','employee_salaries.pay_date','employee_salaries.created_at','users.name as username','users.email as user_email','users.lastname as user_lastname','employees.id as employee_id')
        ->orderBy('employee_salaries.created_at','DESC')
        ->get();
        return view('dashboard.financial.employeeSalary',compact('employeeSalary','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid=$request->validate([
            'emoloyee_name'=>'required',
            'currency'=>'required',
            'pay_date'=>'required',
            'salary_quantity'=>'required',
        ]);

        if($valid){
            $employeeSalary=new EmployeeSalary();
            $employeeSalary->employee_id=$request->emoloyee_name;
            $employeeSalary->salary_quantity=$request->salary_quantity;
            $employeeSalary->currency=$request->currency;
            $employeeSalary->pay_date=$request->pay_date;
            $employeeSalary->save();

            $employee=Employees::findOrFail($employeeSalary->employee_id);
            $user=User::findOrFail($employee->user_id);
            Helper::addActivityLog('<span class="success"> ?????? ?????????? ????  ????????  (<span class="blue-grey"> ?????? ???????????? : '.$user->name.' '.$user->lastname.' / ???????? : '.$user->email.' / ?????????? ??????  : '. $employeeSalary->salary_quantity.' '.$employeeSalary->currency.'  / ?????????? ???????????? ??????  : '.$employeeSalary->pay_date.'  </span> ) ?????????? ?????? </span> <br/><a href="employees/profile/'.$employee->id.'" target="_blank" > ???????? ???????????? ???????????? </a>');

            return  response()->json(['success'=>'???????? ???????????? ?????????????? ?????????? ????']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employeeSalary=EmployeeSalary::find($id);
        return response()->json($employeeSalary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'emoloyee_name'=>'required',
            'currency'=>'required',
            'pay_date'=>'required',
            'salary_quantity'=>'required',
        ]);

        if($valid){
            $employeeSalary=EmployeeSalary::find($request->hidden_id);

            $employee=Employees::findOrFail($employeeSalary->employee_id);
            $user=User::findOrFail($employee->user_id);
            $new_employee=Employees::findOrFail($request->emoloyee_name);
            $new_user=User::findOrFail($employee->user_id);
            Helper::addActivityLog('<span class=""> ??????  ????  ????  (<span class="blue-grey">?????? ???????????? : '.$user->name.' '.$user->lastname.' / ???????? : '.$user->email.' /  ?????????? ??????  : '. $employeeSalary->salary_quantity.' '.$employeeSalary->currency.'  / ?????????? ???????????? ??????  : '.$employeeSalary->pay_date.'  </span> )  ???? (<span class="blue-grey"> ?????? ???????????? : '.$new_user->name.' '.$new_user->lastname.' / ???????? : '.$new_user->email.' / ?????????? ??????  : '. $request->salary_quantity.' '.$request->currency.'  / ?????????? ???????????? ??????  : '.$request->pay_date.'  </span> )  ???????????? ?????? </span> <br/><a href="employees/profile/'.$new_employee->id.'" target="_blank" > ???????? ???????????? ???????????? </a>');


            $employeeSalary->employee_id=$request->emoloyee_name;
            $employeeSalary->salary_quantity=$request->salary_quantity;
            $employeeSalary->currency=$request->currency;
            $employeeSalary->pay_date=$request->pay_date;
            $employeeSalary->save();
            return  response()->json(['success'=>'???????? ???????????? ?????????????? ???????????? ????']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $employeeSalary=EmployeeSalary::find($id);
        $employee=Employees::findOrFail($employeeSalary->employee_id);
        $user=User::findOrFail($employee->user_id);
        Helper::addActivityLog('<span class="danger"> ??????   '.$user->name.' '.$user->lastname.' ????  ????  (<span class="blue-grey"> ?????????? ??????  : '. $employeeSalary->salary_quantity.' '.$employeeSalary->currency.'  / ?????????? ???????????? ??????  : '.$employeeSalary->pay_date.'  </span> ) ?????? ?????? </span> <br/><a href="employees/profile/'.$employee->id.'" target="_blank" > ???????? ???????????? ???????????? </a>');


        EmployeeSalary::destroy($id);
        return  response()->json(['success'=>'???????? ???????????? ?????????????? ?????? ????']);
    }
}
