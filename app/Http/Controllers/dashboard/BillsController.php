<?php
namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Bills;
use App\Models\Purchases;
use App\Models\Goods;
use App\Models\PurchaseDocument;
use App\Models\GoodsCategory;
use App\Models\Companies;
use App\Models\Customers;
use App\Models\Employees;
use App\Models\BillDocuments;
use App\Models\StockHistory;
use App\Models\Stock;
use App\Models\Loan;
use App\Models\Payments;
use App\Models\User;
use Helper;


class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id','bills.bill_num','bills.customer_id','bills.quantity_goods','bills.total_price',
        'bills.money_paid','bills.money_remaining','bills.currency','bills.status','bills.created_at',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province')
        ->orderBy('created_at','DESC')
        ->where('status','تکمیل')
        ->get();
        $incomplate=Bills::where('status','ناتکمیل')->count();
        return view('dashboard.bills.bills',compact('bills','incomplate'));
    }

    
    public function incomplateBill()
    {
        $bills=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id','bills.bill_num','bills.customer_id','bills.quantity_goods','bills.total_price',
        'bills.money_paid','bills.money_remaining','bills.currency','bills.status','bills.created_at',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province')
        ->orderBy('created_at','DESC')
        ->where('status','ناتکمیل')
        ->get();
        $incomplate=Bills::where('status','ناتکمیل')->count();
        return view('dashboard.bills.incomplateBills',compact('bills','incomplate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.id as id','goods.name as name','goods.type_of','goods.created_at')
        ->orderBy('goods.created_at','DESC')
        ->get();
        $customers=Customers::orderBy('created_at','DESC')->get();
        return view('dashboard.bills.addbill', compact('goods','customers'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function show(Bills $bills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as bill_id','bills.customer_id','bills.bill_num','bills.currency','customers.firstname','customers.lastname','customers.phone_number','customers.province')
        ->find($id);
        return response()->json($data);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $bill=Bills::find($id);
        $customer=Customers::find($bill->customer_id);
        Helper::addActivityLog('<span class="warning"> بل ناتکمیل را با مشخضات  (<span class="blue-grey"> بل نمبر : Bill-'.$bill->bill_num.' / مشخضات مستری : '.$customer->firstname.' '.$customer->lastname.' ( '.$customer->province.' ) / تعداد جنس : '.$bill->quantity_goods.' دانه  / مجموعه پول :   '.$bill->total_price.' '.$bill->currency.' / پول پرداخت شده : '.$bill->money_paid.' '.$bill->currency.'</span> ) حذف کرد </span>');


        Bills::destroy($id);
        return  response()->json(['success'=>'بل موفقانه حذف شد']);
    }

    public function deleteBill($id){

        $billDocuments=BillDocuments::where('bill_id',$id)->get();
        if(!empty($billDocuments[0])){

            foreach($billDocuments as $row)
            {
                $stock=Stock::where('goods_id',$row->goods_id)->get();
                $stock_quantity=$stock[0]->quantity_goods;
                $stock_id=$stock[0]->id;
                $quantity=($stock_quantity)+($row->quantity_goods);
                $stock_update=stock::find($stock_id);
                $stock_update->quantity_goods=$quantity;
                $stock_update->save();
            }

        }

        $bill=Bills::find($id);
        $customer=Customers::find($bill->customer_id);
        Helper::addActivityLog('<span class="danger"> بل را با مشخضات  (<span class="blue-grey"> بل نمبر : Bill-'.$bill->bill_num.' / مشخضات مستری : '.$customer->firstname.' '.$customer->lastname.' ( '.$customer->province.' ) / تعداد جنس : '.$bill->quantity_goods.' دانه  / مجموعه پول :   '.$bill->total_price.' '.$bill->currency.' / پول پرداخت شده : '.$bill->money_paid.' '.$bill->currency.'</span> ) حذف کرد </span>');

        Bills::destroy($id);
        return  response()->json(['success'=>'بل موفقانه حذف شد']);
    }


    public function CreateCustomer(Request $request)
    {
        if($request->checkbox==true){
            $valid=$request->validate([
                'customer_old'=>'required',
                'currency'=>'required'
            ]);
            $bill=new Bills();
            $bill->bill_num=$request->bill_num;
            $bill->customer_id=$request->customer_old;
            $bill->currency=$request->currency;
            $bill->status='ناتکمیل';
            $bill->save();
            $mycustomer=Bills::join('customers','customers.id','=','bills.customer_id')
            ->select('bills.id as bill_id','bills.customer_id as customer_id','bills.currency','customers.firstname','customers.lastname','customers.phone_number','customers.province')
            ->find($bill->id);
            return  response()->json(['success'=>'مشتری موفقانه اضافه شد','data'=>$mycustomer]);
        }
        $valid=$request->validate([
            'bill_num'=>'required',
            'firstname'=>'required',
            'lastname'=>'required',
            'phone_number'=>'required|unique:customers,phone_number',
            'province'=>'required',
            'currency'=>'required'
        ]);
        if($valid){
            $customer=new Customers();
            $customer->firstname=$request->firstname;
            $customer->lastname=$request->lastname;
            $customer->phone_number=$request->phone_number;
            $customer->province=$request->province;
            $customer->save();
            $bill=new Bills();
            $bill->bill_num=$request->bill_num;
            $bill->customer_id=$customer->id;
            $bill->currency=$request->currency;
            $bill->status='ناتکمیل';
            $bill->save();
            $mycustomer=Bills::join('customers','customers.id','=','bills.customer_id')
            ->select('bills.id as bill_id','bills.customer_id as customer_id','bills.currency','customers.firstname','customers.lastname','customers.phone_number','customers.province')
            ->find($bill->id);
            return  response()->json(['success'=>'مشتری موفقانه اضافه شد','data'=>$mycustomer]);
        }
    }


    public function updateCustomers(Request $request)
    {
        if($request->checkbox==true){
            $valid=$request->validate([
                'customer_old'=>'required',
                'currency'=>'required'
            ]);
            $bill=Bills::find($request->bill_hidden_id);


            $old_customer=Customers::find($bill->customer_id);
            $customer=Customers::find($request->customer_old);
            Helper::addActivityLog('<span  >  Bill-'.$bill->bill_num.'  مشخصات را از   (<span class="blue-grey"> مشخضات مستری : '.$old_customer->firstname.' '.$old_customer->lastname.' ( '.$old_customer->province.' ) /  واحد پولی : '.$bill->currency.' </span> ) به (<span class="blue-grey">  مشخضات مستری : '.$customer->firstname.' '.$customer->lastname.' ( '.$customer->province.' ) /  واحد پولی : '.$request->currency.'  </span> ) ویرایش کرد </span>   <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');

            $bill->customer_id=$request->customer_old;
            $bill->currency=$request->currency;
            $bill->save();
            $mycustomer=Bills::join('customers','customers.id','=','bills.customer_id')
            ->select('bills.id as bill_id','bills.customer_id as customer_id','bills.currency','customers.firstname','customers.lastname','customers.phone_number','customers.province')
            ->find($bill->id);
            
            return  response()->json(['success'=>'مشتری موفقانه ویرایش شد','data'=>$mycustomer]);
        }
        $customer=Customers::find($request->customer_hidden_id);
        $valid=$request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'phone_number'=>'required|min:10|unique:customers,phone_number,'.$customer->id.',id',
            'province'=>'required',
            'currency'=>'required'
        ]);
        if($valid){

            $bill=Bills::find($request->bill_hidden_id);
            $old_customer=Customers::find($bill->customer_id);

            $customer->firstname=$request->firstname;
            $customer->lastname=$request->lastname;
            $customer->phone_number=$request->phone_number;
            $customer->province=$request->province;
            $customer->save();
            
            Helper::addActivityLog('<span  >  Bill-'.$bill->bill_num.'  مشخصات را از   (<span class="blue-grey"> مشخضات مستری : '.$old_customer->firstname.' '.$old_customer->lastname.' ( '.$old_customer->province.' ) /  واحد پولی : '.$bill->currency.' </span> ) به (<span class="blue-grey">  مشخضات مستری : '.$customer->firstname.' '.$customer->lastname.' ( '.$customer->province.' ) /  واحد پولی : '.$request->currency.'  </span> ) ویرایش کرد </span>   <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


            $bill->customer_id=$request->customer_hidden_id;
            $bill->currency=$request->currency;
            $bill->save();
            $mycustomer=Bills::join('customers','customers.id','=','bills.customer_id')
            ->select('bills.id as bill_id','bills.customer_id as customer_id','bills.currency','customers.firstname','customers.lastname','customers.phone_number','customers.province')
            ->find($bill->id);
            return  response()->json(['success'=>'مشتری موفقانه ویرایش شد','data'=>$mycustomer]);
        }

    }



    public function billDetails(Request $request)
    {
        if(!empty($request->bills_hidden_id)){
            $bill=Bills::find($request->bills_hidden_id);
            $bill->quantity_goods=$request->total_goods;
            $bill->total_price=$request->total_money;
            $bill->money_paid=$request->money_paid;
            $bill->money_remaining=$request->total_remain;
            $bill->status='تکمیل';
            $bill->save();
            if($request->total_remain>0){
                $loan=new Loan();
                $loan->bill_id=$request->bills_hidden_id;
                $loan->quantity_loan=$request->total_remain;
                $loan->status='داده';
                $loan->save();
            }
            $billDocuments=BillDocuments::where('bill_id',$request->bills_hidden_id)->get();
            foreach($billDocuments as $row)
            {
                $stock=Stock::where('goods_id',$row->goods_id)->get();
                $stock_quantity=$stock[0]->quantity_goods;
                $stock_id=$stock[0]->id;
                if($stock_quantity>=$row->quantity_goods){
                    $quantity=($stock_quantity)-($row->quantity_goods);
                    $stock_update=stock::find($stock_id);
                    $stock_update->quantity_goods=$quantity;
                    $stock_update->save();

                    $stockHistory=new StockHistory();
                    $stockHistory->goods_id=$row->goods_id;
                    $stockHistory->quantity_goods=$row->quantity_goods;
                    $stockHistory->status='out';

                    $employee=User::join('employees','employees.user_id','=','users.id')
                    ->select('employees.id as employee_id')
                    ->find(Auth()->id());
                    $employee_id= $employee->employee_id;
                    $stockHistory->employee_id=$employee_id;
                    
                    $stockHistory->save();
                }
            }

            Helper::addActivityLog('<span class="success"> بل جدیدی را با  (<span class="blue-grey"> بل نمبر : Bill-'.$bill->bill_num.'   </span> ) اضافه کرد </span>  <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');
            return  redirect('bills');
        }

        return redirect()->back();
    }



    public function inComplatebillDetails(Request $request)
    {
        if(!empty($request->bills_hidden_id)){
            $billDocuments=BillDocuments::where('bill_id',$request->bills_hidden_id)->get();

            foreach($billDocuments as $row)
            {
                $stock=Stock::where('goods_id',$row->goods_id)->get();
                $stock_quantity=$stock[0]->quantity_goods;
                $stock_id=$stock[0]->id;
                if($stock_quantity<$row->quantity_goods){
                    return redirect()->back()->withErrors(['error'=> 'تعداد جنس ها زیاد میباشد یا به قدر کافی در گدام موجود نیست لطفا تعداد جنس ها ویا تعداد جنس موجود در گدام را برسی نماید']);
                }
            }


            foreach($billDocuments as $row)
            {
                $stock=Stock::where('goods_id',$row->goods_id)->get();
                $stock_quantity=$stock[0]->quantity_goods;
                $stock_id=$stock[0]->id;
                if($stock_quantity>=$row->quantity_goods){
                    $quantity=($stock_quantity)-($row->quantity_goods);
                    $stock_update=stock::find($stock_id);
                    $stock_update->quantity_goods=$quantity;
                    $stock_update->save();
                    $stockHistory=new StockHistory();
                    $stockHistory->goods_id=$row->goods_id;
                    $stockHistory->quantity_goods=$row->quantity_goods;
                    $stockHistory->status='out';

                    $employee=User::join('employees','employees.user_id','=','users.id')
                    ->select('employees.id as employee_id')
                    ->find(Auth()->id());
                    $employee_id= $employee->employee_id;

                    $stockHistory->employee_id=$employee_id;
                    $stockHistory->save();
                }
            }
            $bill=Bills::find($request->bills_hidden_id);
            $bill->quantity_goods=$request->total_goods;
            $bill->total_price=$request->total_money;
            $bill->money_paid=$request->money_paid;
            $bill->money_remaining=$request->total_remain;
            $bill->status='تکمیل';
            $bill->save();
            if($request->total_remain>0){
                $loan=new Loan();
                $loan->bill_id=$request->bills_hidden_id;
                $loan->quantity_loan=$request->total_remain;
                $loan->status='داده';
                $loan->save();
            }

            Helper::addActivityLog('<span class="success"> بل ناتکمیل را با  (<span class="blue-grey"> بل نمبر : Bill-'.$bill->bill_num.'   </span> ) تکمیل کرد </span>  <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');

            return  redirect('bills');
        }
        
        return redirect()->back();
    }



    public function infoBill($id)
    {
        $goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.id as id','goods.name as name','goods.type_of','goods.created_at')
        ->orderBy('goods.created_at','DESC')
        ->get();
        $customers=Customers::orderBy('created_at','DESC')->get();
        $bills=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id','bills.bill_num','bills.customer_id','bills.quantity_goods','bills.total_price','bills.money_paid','money_remaining','bills.currency','bills.created_at',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province')
        ->find($id);
        $billDocuments=BillDocuments::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','category_id')
        ->join('bills','bills.id','=','bill_id')
        ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
        ->where('bill_id',$id)
        ->get();
        
        

        $paymentsHistory=Payments::join('loans','loans.id','payments.loan_id')
        ->join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('payments.id as id',
        'bills.id as bill_id','bills.bill_num','bills.customer_id as customer_id','bills.currency',
        'loans.status','payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date')
        ->where('loans.status','داده')
        ->where('bills.id',$id)
        ->orderBy('payments.created_at','DESC')
        ->get();

        $loans=Loan::Where('bill_id',$id)->select('id')->where('loans.status','داده')->get();
        if(!empty($loans[0])){
            $loan_id=$loans[0]->id;
            $remain=Payments::where('loan_id',$loan_id)->sum('pay_quantity');
        }else{
            $remain=0;
        }

        return view('dashboard.bills.viewBills', compact('goods','customers','bills','billDocuments','paymentsHistory','remain'));
    }

    public function inComplateBills($id)
    {
        $goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.id as id','goods.name as name','goods.type_of','goods.created_at')
        ->orderBy('goods.created_at','DESC')
        ->get();
        $customers=Customers::orderBy('created_at','DESC')->get();
        $bills=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id','bills.bill_num','bills.customer_id','bills.quantity_goods','bills.total_price','bills.money_paid','money_remaining','bills.currency','bills.created_at',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province')
        ->find($id);
        $billDocuments=BillDocuments::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','category_id')
        ->join('bills','bills.id','=','bill_id')
        ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
        ->where('bill_id',$id)
        ->get();
        return view('dashboard.bills.infoBill', compact('goods','customers','bills','billDocuments'));
    }

    

    public function updateBill($id)
    {
        $goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.id as id','goods.name as name','goods.type_of','goods.created_at')
        ->orderBy('goods.created_at','DESC')
        ->get();
        $customers=Customers::orderBy('created_at','DESC')->get();
        $bills=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id','bills.bill_num','bills.customer_id','bills.quantity_goods','bills.total_price','bills.money_paid','money_remaining','bills.currency','bills.created_at',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province')
        ->find($id);
        $billDocuments=BillDocuments::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','category_id')
        ->join('bills','bills.id','=','bill_id')
        ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
        ->where('bill_id',$id)
        ->get();

        
        return view('dashboard.bills.updateBill', compact('goods','customers','bills','billDocuments'));
    }


    public function deleteAllBills()
    {
        Helper::addActivityLog('<span class="warning">  تمام بل های ناتکمیل را حذف کرد ');

        Bills::where('status','ناتکمیل')->delete();
        return  response()->json(['success'=>'تمام بل های ناتکمیل موفقانه حذق شد']);
    }


    public function updateBillDetails(Request $request)
    {

        if(!empty($request->bills_hidden_id)){
            $bill=Bills::find($request->bills_hidden_id);

            $customer=Customers::find($bill->customer_id);
            Helper::addActivityLog('<span >  Bill-'.$bill->bill_num.' را از   (<span class="blue-grey">  تعداد جنس : '.$bill->quantity_goods.' دانه  / مجموعه پول :   '.$bill->total_price.' '.$bill->currency.' / پول پرداخت شده : '.$bill->money_paid.' '.$bill->currency.'</span> ) به (<span class="blue-grey"> تعداد جنس : '.$request->total_goods.' دانه  / مجموعه پول :   '.$request->total_money.' '.$request->currency.' / پول پرداخت شده : '.$request->money_paid.' '.$bill->currency.'</span> ) ویرایش کرد </span>   <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');

            

            $bill->quantity_goods=$request->total_goods;
            $bill->total_price=$request->total_money;
            $bill->money_paid=$request->money_paid;
            $bill->money_remaining=$request->total_remain;
            $bill->status='تکمیل';
            $bill->save();

            $remain=$request->total_remain;
            if($remain>0){
                $loan=Loan::where('bill_id',$request->bills_hidden_id)->get();
                if(!empty($loan[0])){
                    $loan[0]->quantity_loan=$remain;
                    $loan[0]->save();
                }else{
                    $loan_new=new Loan();
                    $loan_new->bill_id=$request->bills_hidden_id;
                    $loan_new->quantity_loan=$remain;
                    $loan_new->status='داده';
                    $loan_new->save();
                }
            }else{
                $loan_old=Loan::where('bill_id',$request->bills_hidden_id)->get();
                if(!empty($loan_old[0])){
                    Loan::where('bill_id',$request->bills_hidden_id)->delete();
                }
            }


            return  redirect('bills');
        }
        return redirect()->back();
    }





}
