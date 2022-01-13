<?php
namespace App\Http\Controllers\dashboard;

use App\Models\FinancialExpenses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Helper;

class FinancialExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financialExpenses= FinancialExpenses::orderBy('created_at','DESC')->get();
        return view('dashboard.financial.financialExpenses',compact('financialExpenses'));
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
            'type_of_work'=>'required',
            'money_quantity'=>'required',
            'currency'=>'required',
            'payment_date'=>'required',
        ]);

        if($valid){
            $employeeSalary=new FinancialExpenses();
            $employeeSalary->type_of_work=$request->type_of_work;
            $employeeSalary->money_quantity=$request->money_quantity;
            $employeeSalary->currency=$request->currency;
            $employeeSalary->payment_date=$request->payment_date;
            $employeeSalary->description=$request->description;
            $employeeSalary->save();

            Helper::addActivityLog('<span class="success"> مصارف مالی جدیدی را با مشخضات  (<span class="blue-grey"> نوعیت کار : '.$employeeSalary->type_of_work.' / مقدار پول  : '. $employeeSalary->money_quantity.' '.$employeeSalary->currency.'  / تاریخ پرداخت شده  : '.$employeeSalary->payment_date.'  </span> ) اضافه کرد </span>');

            return  response()->json(['success'=>'مصرف مالی موفقانه اضافه شد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinancialExpenses  $financialExpenses
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialExpenses $financialExpenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinancialExpenses  $financialExpenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $financialExpenses=FinancialExpenses::find($id);
        return response()->json($financialExpenses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinancialExpenses  $financialExpenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'type_of_work'=>'required',
            'money_quantity'=>'required',
            'currency'=>'required',
            'payment_date'=>'required',
        ]);

        if($valid){
            $employeeSalary=FinancialExpenses::find($request->hidden_id);

            Helper::addActivityLog('<span> مصارف مالی را از   (<span class="blue-grey"> نوعیت کار : '.$employeeSalary->type_of_work.' / مقدار پول  : '. $employeeSalary->money_quantity.' '.$employeeSalary->currency.'  / تاریخ پرداخت شده  : '.$employeeSalary->payment_date.'  </span> ) به (<span class="blue-grey"> نوعیت کار : '.$request->type_of_work.' / مقدار پول  : '. $request->money_quantity.' '.$request->currency.'  / تاریخ پرداخت شده  : '.$request->payment_date.'  </span> ) ویرایش کرد </span>');

            $employeeSalary->type_of_work=$request->type_of_work;
            $employeeSalary->money_quantity=$request->money_quantity;
            $employeeSalary->currency=$request->currency;
            $employeeSalary->payment_date=$request->payment_date;
            $employeeSalary->description=$request->description;
            $employeeSalary->save();
            return  response()->json(['success'=>'مصرف مالی موفقانه ویرایش شد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinancialExpenses  $financialExpenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employeeSalary=FinancialExpenses::find($id);
        Helper::addActivityLog('<span class="danger"> مصارف مالی را با مشخضات  (<span class="blue-grey"> نوعیت کار : '.$employeeSalary->type_of_work.' / مقدار پول  : '. $employeeSalary->money_quantity.' '.$employeeSalary->currency.'  / تاریخ پرداخت شده  : '.$employeeSalary->payment_date.'  </span> ) حذف کرد </span>');

        FinancialExpenses::destroy($id);
        return  response()->json(['success'=>'مصرف مالی موفقانه حذف شد']);
    }
}
