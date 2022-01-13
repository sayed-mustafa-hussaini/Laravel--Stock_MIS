<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Payments;
use App\Models\Stock;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\Companies;
use App\Models\Purchases;
use App\Models\employees;
use App\Models\Users;
use App\Models\StockHistory;
use App\Models\Loan;
use App\Models\Customers;
use App\Models\Bills;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Helper;


class ReceiptsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $loans=Loan::join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as bill_id','bills.bill_num','bills.customer_id as customer_id','bills.currency',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province',
        'loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->orderBy('loans.created_at','DESC')
        ->get();    


        $paymentsHistory=Payments::join('loans','loans.id','payments.loan_id')
        ->join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('payments.id as id',
        'bills.id as bill_id','bills.bill_num','bills.customer_id as customer_id','bills.currency',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province',
        'loans.status','payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date','payments.created_at')
        ->where('loans.status','داده')
        ->orderBy('payments.created_at','DESC')
        ->get();


        $get_total_loans_dollar=Loan::join('bills','bills.id','=','loans.bill_id')
        ->select('loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->where('bills.currency','دالر')
        ->orderBy('loans.created_at','DESC')
        ->get();
        $total_NoPayments=0;
        $total_loans_dollar=0; 
        foreach ($get_total_loans_dollar as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id)){
                $total_loans_dollar+=$item->quantity_loan-(Helper::getPayments($item->id));
                $total_NoPayments++;
            } 
        }

        $get_total_loans=Loan::join('bills','bills.id','=','loans.bill_id')
        ->select('loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->where('bills.currency','افغانی')
        ->orderBy('loans.created_at','DESC')
        ->get();
        $total_loans_af=0; 
        foreach ($get_total_loans as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id)){
                $total_loans_af+=$item->quantity_loan-(Helper::getPayments($item->id));
                $total_NoPayments++;
            } 
        }


        return view('dashboard.receipts.receipts',compact('loans','paymentsHistory','total_loans_dollar','total_loans_af','total_NoPayments'));
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
        $valid = $request->validate([
            'loan_info' => 'required',
            'pay_quantity' => 'required',
            'pay_date' => 'required',
        ]);
        if($valid){
            $payments=new Payments();
            $payments->loan_id=$request->loan_info;
            $payments->pay_quantity=$request->pay_quantity;
            $payments->pay_date=$request->pay_date;
            $payments->referral_number=$request->referral_number;
            $payments->save();

            $loans=Loan::find($payments->loan_id);
            $bill=Bills::find($loans->bill_id);
            $customer=Customers::find($bill->customer_id);
            Helper::addActivityLog('<span class="success"> برای مشتری ( '.$customer->firstname.' '.$customer->lastname.' ) با بل نمبر Bill-'.$bill->bill_num.' رسید جدیدی با مشخضات (<span class="blue-grey">  مقدار پرداخت شده : '.$payments->pay_quantity.' '.$bill->currency.'   /  تاریخ پرداخت :   '.$payments->pay_date.' </span> ) اضافه کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


            return  response()->json(['success'=>' موفقانه اضافه شد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment=Payments::find($id);
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid = $request->validate([
            'loan_info' => 'required',
            'pay_quantity' => 'required',
            'pay_date' => 'required',
        ]);
        if($valid){
            $payments=Payments::find($request->hidden_id);

            $loans=Loan::find($payments->loan_id);
            $bill=Bills::find($loans->bill_id);
            $customer=Customers::find($bill->customer_id);

            $new_loans=Loan::find($request->loan_info);
            $new_bill=Bills::find($new_loans->bill_id);;
            $new_customer=Customers::find($new_bill->customer_id);

            Helper::addActivityLog('<span> برای مشتری ( '.$customer->firstname.' '.$customer->lastname.' ) با بل نمبر Bill-'.$bill->bill_num.' رسید  با مشخضات (<span class="blue-grey">  مقدار پرداخت شده : '.$payments->pay_quantity.' '.$bill->currency.'   /  تاریخ پرداخت :   '.$payments->pay_date.' </span> ) <span class="warning" >  به مشتری  ( '.$new_customer->firstname.' '.$new_customer->lastname.' ) با بل نمبر Bill-'.$new_bill->bill_num.' رسید با مشخضات  (<span class="warning">  مقدار پرداخت شده : '.$request->pay_quantity.' '.$new_bill->currency.'   /  تاریخ پرداخت :   '.$request->pay_date.' </span> ) را ویرایش کرد </span>    <br/><a href="bills/info_bill/'.$new_bill->id.'" target="_blank" > دیدن  بل </a>');


            $payments->loan_id=$request->loan_info;
            $payments->pay_quantity=$request->pay_quantity;
            $payments->pay_date=$request->pay_date;
            $payments->referral_number=$request->referral_number;
            $payments->save();
            return  response()->json(['success'=>' موفقانه ویرایش شد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $payments=Payments::find($id);
        $loans=Loan::find($payments->loan_id);
        $bill=Bills::find($loans->bill_id);
        $customer=Customers::find($bill->customer_id);
        Helper::addActivityLog('<span class="danger"> برای مشتری ( '.$customer->firstname.' '.$customer->lastname.' ) با بل نمبر Bill-'.$bill->bill_num.' رسید با مشخضات (<span class="blue-grey">  مقدار پرداخت شده : '.$payments->pay_quantity.' '.$bill->currency.'   /  تاریخ پرداخت :   '.$payments->pay_date.' </span> )  را حذف کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


        Payments::destroy($id);
        return  response()->json(['success'=>' موفقانه حذف شد']);
    }



    public function loanQuantity($id)
    {
        $loan =Loan::select('quantity_loan')->find($id);
        $loan= $loan->quantity_loan;
        $payments=Helper::getPayments($id);
        $data=$loan-$payments;
        return response()->json($data);
    }



    public function loanQuantityUpdate($loan_id,$payment_id)
    {
    //    $payment=Payments::find($payment_id);
    //    $payment_quantity=$payment->pay_quantity;

        $loan =Loan::select('quantity_loan')->find($loan_id);
        $loan= $loan->quantity_loan;
        $payment_loan=Helper::getPayments($loan_id);

    //    if($payment->loan_id==$loan_id){
    //         $data=($loan+$payment_quantity)-$payment_loan;
    //    }else{
            $data=$loan-$payment_loan;   
    //    }
        return response()->json($data);
    }




    public function allLoan()
    {
        $loans=Loan::join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('customers.firstname','customers.lastname','customers.phone_number','customers.province',
        'bills.id as bill_id','bills.bill_num','bills.customer_id as customer_id','bills.currency',
        'loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->orderBy('loans.created_at','DESC')
        ->get();    
        $data='<option  disabled  selected> اتنخاب کردن مقدار قرض </option>'; 
        foreach ($loans as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id)){
                $quantity=$item->quantity_loan-(Helper::getPayments($item->id));
                $data.= '<optgroup label="مشخضات"><option value="'.$item->id.'" data-currency="'.$item->currency.'" >Bill-'.$item->bill_num.' /   '.$item->firstname.' '.$item->lastname.' /'.$item->province.'/'. '<span> ('.$quantity.' '.$item->currency.') </span> </option></optgroup>';
            }
        }
        return response()->json($data);
    }



    public function allLoanUpdate($id)
    {
        $payment=Payments::find($id);
        $loan_id=$payment->loan_id;
        $payment_quantity=$payment->pay_quantity;
        $loans=Loan::join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as bill_id','bills.bill_num','bills.customer_id as customer_id','bills.currency',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province',
        'loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->orderBy('loans.created_at','DESC')
        ->get();
        $total_payment=0;
        $data='<option  disabled > اتنخاب کردن مقدار قرض </option>'; 
        foreach ($loans as $item){
            if ($item->quantity_loan>Helper::getPayments($item->id) || $item->id==$loan_id ){
                if($item->id==$loan_id ){
                    $quantity=($item->quantity_loan+$payment_quantity)-(Helper::getPayments($item->id));
                    $total_payment=$quantity;
                    $data.= '<optgroup label="مشخضات"><option value="'.$item->id.'" data-currency="'.$item->currency.'" selected >Bill-'.$item->bill_num.' /   '.$item->firstname.' '.$item->lastname.' /'.$item->province.'/'. '<span> ('.$quantity.' '.$item->currency.') </span> </option></optgroup>';
                }else{
                    $quantity=$item->quantity_loan-(Helper::getPayments($item->id));
                    $data.= '<optgroup label="مشخضات"><option value="'.$item->id.'" data-currency="'.$item->currency.'" >Bill-'.$item->bill_num.' /   '.$item->firstname.' '.$item->lastname.' /'.$item->province.'/'. '<span> ('.$quantity.' '.$item->currency.') </span> </option></optgroup>';
                }
            }
        }
        
        $currency=Payments::join('loans','loans.id','=','payments.loan_id')
        ->join('bills','bills.id','=','loans.bill_id')
        ->select('bills.currency','bills.id as id','loans.status as status')
        ->where('loans.status','داده')
        ->where('payments.id',$id)
        ->get();  
        return response()->json(['data'=>$data,'total_payment'=>$total_payment,'currency'=>$currency[0]->currency]);
    }





}
    