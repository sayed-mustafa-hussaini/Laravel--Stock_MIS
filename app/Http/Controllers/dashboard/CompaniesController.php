<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Companies;
use App\Models\Customers;
use App\Models\PurchaseDocument;
use App\Models\Purchases;
use App\Models\Payments;
use App\Models\Stock;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\employees;
use App\Models\Users;
use App\Models\StockHistory;
use App\Models\Loan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Helper;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=Companies::orderBy('created_at','DESC')->get();
        return view('dashboard.companies.show',compact('companies'));
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
            'name'=>'required',
            'location'=>'required',
        ]);
        if($valid){
            if(empty($request->file('photo'))){
                $company=new Companies();
                $company->company_name=$request->name;
                $company->phone_number=$request->phone_number;
                $company->location=$request->location;
                $company->save();
                
                Helper::addActivityLog('<span class="success" >شرکت جدیدی را بنام  (<span class="blue-grey"> '. $company->company_name.' </span> ) اضافه کرد </span> <br/><a href="companies/info/'.$company->id.'" target="_blank" >  دیدن شرکت </a>');
                return  response()->json(['success'=>'شرکت موفقانه اضافه شد']);
            }else{
                $path=Storage::putFile('companies-img',$request->file('photo'));
                $company=new Companies();
                $company->company_name=$request->name;
                $company->phone_number=$request->phone_number;
                $company->location=$request->location;
                $company->company_photo=$path;
                $company->save();
                Helper::addActivityLog('<span class="success" >شرکت جدیدی را بنام  (<span class="blue-grey"> '. $company->company_name.' </span> ) اضافه کرد </span> <br/><a href="companies/info/'.$company->id.'" target="_blank" >  دیدن شرکت </a>');
                return  response()->json(['success'=>'شرکت موفقانه اضافه شد']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=Companies::find($id);
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'name'=>'required',
            'location'=>'required',
        ]);
        if($valid){
            if(empty($request->file('photo'))){
                $company=Companies::find($request->hidden_id);
                Helper::addActivityLog('<span class="" > شرکت  (<span class="blue-grey"> '. $company->company_name.' </span> ) را ویرایش کرد </span> <br/><a href="companies/info/'.$company->id.'" target="_blank" >  دیدن شرکت </a>');
                $company->company_name=$request->name;
                $company->phone_number=$request->phone_number;
                $company->location=$request->location;
                $company->save();
                return  response()->json(['success'=>'شرکت موفقانه ویرایش شد']);
            }else{
                $path=Storage::putFile('companies-img',$request->file('photo'));
                $company=Companies::find($request->hidden_id);
                $company->company_name=$request->name;
                $company->phone_number=$request->phone_number;
                $company->location=$request->location;
                $company->company_photo=$path;
                $company->save();
                Helper::addActivityLog('<span class="" > شرکت  (<span class="blue-grey"> '. $company->company_name.' </span> ) را ویرایش کرد </span> <br/><a href="companies/info/'.$company->id.'" target="_blank" >  دیدن شرکت </a>');
                return  response()->json(['success'=>'شرکت موفقانه ویرایش شد']);
            }
        }
    }

    public function info($id)
    {
        $purchases=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.bill_number','purchases.quantity_goods','purchases.total_price','purchases.money_paid','purchases.purchase_date','purchases.currency','purchases.created_at','companies.company_name','companies.id as company_id')
        ->orderBy('purchases.created_at','DESC')
        ->where('companies.id',$id)
        ->get();

        $total_price_af=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.quantity_goods','purchases.total_price','purchases.currency')
        ->where('companies.id',$id)
        ->where('purchases.currency','افغانی')
        ->sum('purchases.total_price');
        $total_price_daller=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.quantity_goods','purchases.total_price','purchases.currency')
        ->where('companies.id',$id)
        ->where('purchases.currency','دالر')
        ->sum('purchases.total_price');

        $total_goods=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.quantity_goods','purchases.total_price','purchases.currency')
        ->where('companies.id',$id)
        ->sum('purchases.quantity_goods');

        $total_paid_doller=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.money_paid','purchases.total_price','purchases.currency')
        ->where('companies.id',$id)
        ->where('purchases.currency','دالر')
        ->sum('purchases.money_paid');
        $total_paid_af=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.money_paid','purchases.total_price','purchases.currency')
        ->where('companies.id',$id)
        ->where('purchases.currency','افغانی')
        ->sum('purchases.money_paid');

        $paymentsHistory=Payments::join('loans','loans.id','payments.loan_id')
        ->join('purchases','purchases.id','=','loans.purchase_id')
        ->join('companies','companies.id','=','purchases.company_id')
        ->select('payments.id as id','purchases.bill_number','purchases.currency','loans.status',
                 'payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date','companies.id as company_id')
        ->where('loans.status','گرفته')
        ->where('companies.id',$id)
        ->orderBy('payments.created_at','DESC')
        ->get();

        $get_total_loans_dollar=Loan::join('purchases','purchases.id','=','loans.purchase_id')
        ->join('companies','companies.id','=','purchases.company_id')
        ->select('loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','گرفته')
        ->where('purchases.currency','دالر')
        ->where('companies.id',$id)
        ->orderBy('loans.created_at','DESC')
        ->get();
        $total_loans_dollar=0; 
        foreach ($get_total_loans_dollar as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id)){
                $total_loans_dollar+=$item->quantity_loan-(Helper::getPayments($item->id));
            } 
        }
        $get_total_loans_af=Loan::join('purchases','purchases.id','=','loans.purchase_id')
        ->join('companies','companies.id','=','purchases.company_id')
        ->select('loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','گرفته')
        ->where('purchases.currency','افغانی')
        ->where('companies.id',$id)
        ->orderBy('loans.created_at','DESC')
        ->get();
        $total_loans_af=0; 
        foreach ($get_total_loans_af as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id)){
                $total_loans_af+=$item->quantity_loan-(Helper::getPayments($item->id));
            } 
        }


        $payments_money_doller=Payments::join('loans','loans.id','payments.loan_id')
        ->join('purchases','purchases.id','=','loans.purchase_id')
        ->join('companies','companies.id','=','purchases.company_id')
        ->select('payments.id as id','purchases.bill_number','purchases.currency','loans.status',
                 'payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date','companies.id as company_id')
        ->where('loans.status','گرفته')
        ->where('companies.id',$id)
        ->where('loans.status','گرفته')
        ->where('purchases.currency','دالر')
        ->sum('pay_quantity');

        $payments_money_af=Payments::join('loans','loans.id','payments.loan_id')
        ->join('purchases','purchases.id','=','loans.purchase_id')
        ->join('companies','companies.id','=','purchases.company_id')
        ->select('payments.id as id','purchases.bill_number','purchases.currency','loans.status',
                 'payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date','companies.id as company_id')
        ->where('loans.status','گرفته')
        ->where('companies.id',$id)
        ->where('loans.status','گرفته')
        ->where('purchases.currency','افغانی')
        ->sum('pay_quantity');


        $loans=Loan::join('purchases','purchases.id','=','loans.purchase_id')
        ->join('companies','companies.id','=','purchases.company_id')
        ->select('purchases.bill_number','purchases.currency','loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('status','گرفته')
        ->where('companies.id',$id)
        ->orderBy('loans.created_at','DESC')
        ->get();

        

        $company=Companies::find($id);
        return view('dashboard.companies.info',compact('company','purchases','total_price_af','total_price_daller','total_goods','total_paid_doller','total_paid_af','paymentsHistory','total_loans_dollar','total_loans_af','payments_money_doller','payments_money_af','loans'));
    }


    public function destroy($id)
    {
        $company=Companies::find($id);
        Helper::addActivityLog('<span class="danger" > شرکت با مشخضات (<span class="blue-grey"> نام شرکت : '. $company->company_name.' / شماره تماس شرکت : '.$company->phone_number.' / موقعیت شرکت : '.$company->location. ' </span> ) را حذف کرد </span>');
        $company=Companies::destroy($id);
        return  response()->json(['success'=>'شرکت موفقانه حذف شد']);
    }
}
