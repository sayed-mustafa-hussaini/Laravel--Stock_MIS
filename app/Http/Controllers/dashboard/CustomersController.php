<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Customers;
use App\Models\User;
use App\Models\Bills;

use App\Models\Purchases;
use App\Models\Goods;
use App\Models\PurchaseDocument;
use App\Models\GoodsCategory;
use App\Models\Companies;
use App\Models\BillDocuments;
use App\Models\StockHistory;
use App\Models\Stock;
use App\Models\Loan;
use App\Models\Payments;
use Helper;


class CustomersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $customers=Customers::orderBy('created_at','DESC')->get();
        return view('dashboard.customers.show',compact('customers'));
    }

    public function store(Request $request)
    {
        $valid=$request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'phone_number'=>'required|unique:customers,phone_number',
            'province'=>'required'
        ]);
        if($valid){
            if(empty($request->file('photo'))){
                $customer=new Customers();
                $customer->firstname=$request->firstname;
                $customer->lastname=$request->lastname;
                $customer->phone_number=$request->phone_number;
                $customer->province=$request->province;
                $customer->save();
                Helper::addActivityLog('<span class="success" >مشتری جدیدی را با مشخصات (<span class="blue-grey">  نام : '. $customer->firstname.' '. $customer->lastname.' / شماره تماس : '. $customer->phone_number.' / ولایت :'. $customer->province.'</span> ) اضافه کرد </span> <br/><a href="customers/info/'.$customer->id.' " target="_blank" > دیدن مشتری </a>');
                return  response()->json(['success'=>'مشتری موفقانه اضافه شد']);
            }else{
                $path=Storage::putFile('customers-img',$request->file('photo'));
                $customer=new Customers();
                $customer->firstname=$request->firstname;
                $customer->lastname=$request->lastname;
                $customer->phone_number=$request->phone_number;
                $customer->province=$request->province;
                $customer->photo=$path;
                $customer->save();
                Helper::addActivityLog('<span class="success" >مشتری جدیدی را با مشخصات (<span class="blue-grey">  نام : '. $customer->firstname.' '. $customer->lastname.' / شماره تماس : '. $customer->phone_number.' / ولایت :'. $customer->province.'</span> ) اضافه کرد </span> <br/><a href="customers/info/'.$customer->id.' " target="_blank" > دیدن مشتری </a>');
                return  response()->json(['success'=>'مشتری موفقانه اضافه شد']);
            }
        } 
    }

    public function edit($id)
    {
        $customer=Customers::find($id);
        return response()->json($customer);
    }

    public function update(Request $request)
    {
        $customer=Customers::find($request->hidden_id);
        $valid=$request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'phone_number'=>'required|min:10|unique:customers,phone_number,'.$customer->id.',id',
            'province'=>'required'
        ]);
        if($valid){
            Helper::addActivityLog('مشتری را با مشخصات (<span class="blue-grey">  نام : '. $customer->firstname.' '. $customer->lastname.' / شماره تماس : '. $customer->phone_number.' / ولایت :'. $customer->province.'</span> ) ویرایش کرد <br/><a href="customers/info/'.$customer->id.' " target="_blank" > دیدن مشتری </a>');
            $customer->firstname=$request->firstname;
            $customer->lastname=$request->lastname;
            $customer->phone_number=$request->phone_number;
            $customer->province=$request->province;
            $customer->save();
            return  response()->json(['success'=>'مشتری موفقانه ویرایش شد']);
        }
    }

    public function info($id)
    {
        $bills=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id','bills.bill_num','bills.customer_id','bills.quantity_goods','bills.total_price',
        'bills.money_paid','bills.money_remaining','bills.currency','bills.status','bills.created_at')
        ->where('status','تکمیل')
        ->Where('bills.customer_id',$id)
        ->orderBy('created_at','DESC')
        ->get();
        $customer=Customers::find($id);
        $loans=Loan::join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('bills.bill_num','bills.currency','loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->where('customers.id',$id)
        ->orderBy('loans.created_at','DESC')
        ->get();
        $paymentsHistory=Payments::join('loans','loans.id','payments.loan_id')
        ->join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('payments.id as id','bills.bill_num','bills.currency','loans.status',
          'payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number',
          'payments.pay_date as pay_date','customers.id as customers_id')
        ->where('loans.status','داده')
        ->where('customers.id',$id)
        ->orderBy('loans.created_at','DESC')
        ->get();


        $total_price_af=bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as id','bills.total_price','bills.currency')
        ->where('customers.id',$id)
        ->where('bills.currency','افغانی')
        ->sum('bills.total_price');
        $total_price_daller=bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as id','bills.quantity_goods','bills.total_price','bills.currency')
        ->where('customers.id',$id)
        ->where('bills.currency','دالر')
        ->sum('bills.total_price');

        $total_goods=bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as id','bills.quantity_goods','bills.total_price','bills.currency')
        ->where('customers.id',$id)
        ->sum('bills.quantity_goods');


        $total_paid_doller=bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as id','bills.money_paid','bills.currency')
        ->where('customers.id',$id)
        ->where('bills.currency','دالر')
        ->sum('bills.money_paid');
        $total_paid_af=bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as id','bills.money_paid','bills.currency')
        ->where('customers.id',$id)
        ->where('bills.currency','افغانی')
        ->sum('bills.money_paid');

        $payments_money_doller=Payments::join('loans','loans.id','payments.loan_id')
        ->join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('payments.id as id','bills.bill_num','bills.currency','loans.status',
                 'payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date','customers.id as customer_id')
        ->where('loans.status','گرفته')
        ->where('customers.id',$id)
        ->where('loans.status','گرفته')
        ->where('bills.currency','دالر')
        ->sum('pay_quantity');
        $payments_money_af=Payments::join('loans','loans.id','payments.loan_id')
        ->join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('payments.id as id','bills.bill_num','bills.currency','loans.status',
                 'payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date','customers.id as customer_id')
        ->where('loans.status','گرفته')
        ->where('customers.id',$id)
        ->where('loans.status','گرفته')
        ->where('bills.currency','افغانی')
        ->sum('pay_quantity');


        $get_total_loans_dollar=Loan::join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->where('bills.currency','دالر')
        ->where('customers.id',$id)
        ->orderBy('loans.created_at','DESC')
        ->get();
        $total_loans_dollar=0; 
        foreach ($get_total_loans_dollar as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id)){
                $total_loans_dollar+=$item->quantity_loan-(Helper::getPayments($item->id));
            } 
        }
        $get_total_loans_af=Loan::join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->where('bills.currency','افغانی')
        ->where('customers.id',$id)
        ->orderBy('loans.created_at','DESC')
        ->get();
        $total_loans_af=0; 
        foreach ($get_total_loans_af as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id)){
                $total_loans_af+=$item->quantity_loan-(Helper::getPayments($item->id));
            } 
        }


        return view('dashboard.customers.info',compact('customer','bills','loans','paymentsHistory','total_price_af','total_price_daller','total_goods','total_paid_doller','total_paid_af','payments_money_doller','payments_money_af','total_loans_dollar','total_loans_af'));
    }

    public function changePhoto(Request $request){
        $valid=$request->validate([
            'photo'=>'required',
        ]);
        if($valid){
            $path=Storage::putFile('customers-img',$request->file('photo'));
            $customer=Customers::find($request->hidden_id);
            $customer->photo=$path;
            $customer->save();
            Helper::addActivityLog('عکس مشتری را با مشخصات (<span class="blue-grey">  نام : '. $customer->firstname.' '. $customer->lastname.' / شماره تماس : '. $customer->phone_number.' / ولایت :'. $customer->province.'</span> ) تبدیل کرد <br/><a href="customers/info/'.$customer->id.' " target="_blank" > دیدن مشتری </a>');
            return  response()->json(['success'=>'عکس مشتری موفقانه تبدیل شد']);
        }
    }

    public function destroy($id)
    {
        $customer=Customers::find($id);
        Helper::addActivityLog('<span class="danger lighten-1"> مشتری را با مشخصات (<span class="blue-grey" >  نام : '. $customer->firstname.' '. $customer->lastname.' / شماره تماس : '. $customer->phone_number.' / ولایت :'. $customer->province.'</span> ) حذف کرد </span>');
        Customers::destroy($id);
        return  response()->json(['success'=>'مشتری موفقانه حذف شد']);
    }
}
