<?php
namespace App\Http\Controllers\dashboard;

use App\Models\FinancialExpenses;

use App\Models\Rent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Helper;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents= Rent::orderBy('created_at','DESC')->get();
        return view('dashboard.financial.rent',compact('rents'));
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
            'location'=>'required',
            'money_quantity'=>'required',
            'currency'=>'required',
            'payment_date'=>'required',
        ]);

        if($valid){
            $employeeSalary=new Rent();
            $employeeSalary->location=$request->location;
            $employeeSalary->money_quantity=$request->money_quantity;
            $employeeSalary->currency=$request->currency;
            $employeeSalary->payment_date=$request->payment_date;
            $employeeSalary->save();

            Helper::addActivityLog('<span class="success"> کرایه جدیدی را با مشخضات  (<span class="blue-grey"> مکان : '.$employeeSalary->location.' / مقدار کرایه  : '. $employeeSalary->money_quantity.' '.$employeeSalary->currency.'  / تاریخ پرداخت کرایه  : '.$employeeSalary->payment_date.'  </span> ) اضافه کرد </span>');

            return  response()->json(['success'=>' کرایه موفقانه اضافه شد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rent=Rent::find($id);
        return response()->json($rent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'location'=>'required',
            'money_quantity'=>'required',
            'currency'=>'required',
            'payment_date'=>'required',
        ]);

        if($valid){
            $employeeSalary=Rent::find($request->hidden_id);

            Helper::addActivityLog('<span> مصارف مالی را از   (<span class="blue-grey"> مکان : '.$employeeSalary->location.' / مقدار پول  : '. $employeeSalary->money_quantity.' '.$employeeSalary->currency.'  / تاریخ پرداخت شده  : '.$employeeSalary->payment_date.'  </span> ) به (<span class="blue-grey"> مکان : '.$request->location.' / مقدار پول  : '. $request->money_quantity.' '.$request->currency.'  / تاریخ پرداخت شده  : '.$request->payment_date.'  </span> ) ویرایش کرد </span>');


            $employeeSalary->location=$request->location;
            $employeeSalary->money_quantity=$request->money_quantity;
            $employeeSalary->currency=$request->currency;
            $employeeSalary->payment_date=$request->payment_date;
            $employeeSalary->save();
            return  response()->json(['success'=>' کرایه موفقانه ویرایش شد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employeeSalary=Rent::find($id);
        Helper::addActivityLog('<span class="danger"> کرایه را با مشخضات  (<span class="blue-grey"> مکان : '.$employeeSalary->location.' / مقدار کرایه  : '. $employeeSalary->money_quantity.' '.$employeeSalary->currency.'  / تاریخ پرداخت کرایه  : '.$employeeSalary->payment_date.'  </span> ) حذف کرد </span>');

        Rent::destroy($id);
        return  response()->json(['success'=>' کرایه موفقانه حذف شد']);
    }
}
