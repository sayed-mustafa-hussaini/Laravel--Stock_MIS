<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
use App\Models\PurchaseDocument;
use Helper;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.bill_number','purchases.quantity_goods','purchases.total_price','purchases.money_paid','purchases.purchase_date','purchases.currency','purchases.created_at','companies.company_name','companies.id as company_id')
        ->orderBy('purchases.created_at','DESC')
        ->get();
        $companies=Companies::select('id','company_name')->orderBy('company_name','ASC')->get();
        return view('dashboard.purchases.purchases',compact('purchases','companies'));
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
            'bill_number'=>'required',
            'company_name'=>'required',
            'quantity_goods'=>'required',
            'total_price'=>'required',
            'money_paid'=>'required',
            'purchase_date'=>'required',
            'currency'=>'required',
        ]);
        if($valid){
            if(empty($request->file('photo'))){
                $purchases=new Purchases();
                $purchases->bill_number=$request->bill_number;
                $purchases->company_id=$request->company_name;
                $purchases->total_price=$request->total_price;
                $purchases->quantity_goods=$request->quantity_goods;
                $purchases->money_paid=$request->money_paid;
                $purchases->purchase_date=$request->purchase_date;
                $purchases->currency=$request->currency;
                $purchases->save();

                $remain=$request->total_price-$request->money_paid;
                if($remain>0){
                    $loan=new Loan();
                    $loan->purchase_id=$purchases->id;
                    $loan->quantity_loan=$remain;
                    $loan->status='گرفته';
                    $loan->save();
                }

                $company=Companies::find($purchases->company_id);
                Helper::addActivityLog('<span class="success"> خرید جدیدی را با مشخصات (<span class="blue-grey"> بل نمبر :  Bill-'.$purchases->bill_number.' / برای شرکت : '.$company->company_name.' </span> ) اضافه کرد </span> <br/><a href="purchases/info-item/'.$purchases->id.'" target="_blank" >  دیدن خرید </a>');
                return  response()->json(['success'=>'خرید موفقانه اضافه شد']);
            }else{
                $path=Storage::putFile('customers-img',$request->file('photo'));
                $purchases=new Purchases();
                $purchases->bill_number=$request->bill_number;
                $purchases->company_id=$request->company_name;
                $purchases->total_price=$request->total_price;
                $purchases->quantity_goods=$request->quantity_goods;
                $purchases->money_paid=$request->money_paid;
                $purchases->purchase_date=$request->purchase_date;
                $purchases->currency=$request->currency;
                $purchases->photo=$path;
                $purchases->save();

                $remain=$request->total_price-$request->money_paid;
                if($remain>0){
                    $loan=new Loan();
                    $loan->purchase_id=$purchases->id;
                    $loan->quantity_loan=$remain;
                    $loan->status='گرفته';
                    $loan->save();
                }

                $company=Companies::find($purchases->company_id);
                Helper::addActivityLog('<span class="success"> خرید جدیدی را با مشخضات (<span class="blue-grey"> بل نمبر :  Bill-'.$purchases->bill_number.' / برای شرکت : '.$company->company_name.' </span> ) اضافه کرد </span> <br/><a href="purchases/info-item/'.$purchases->id.'" target="_blank" >  دیدن خرید </a>');
                return  response()->json(['success'=>'خرید موفقانه اضافه شد']);
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show(Purchases $purchases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase=Purchases::find($id);
        return response()->json($purchase);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'bill_number'=>'required',
            'company_name'=>'required',
            'quantity_goods'=>'required',
            'total_price'=>'required',
            'money_paid'=>'required',
            'purchase_date'=>'required',
            'currency'=>'required',
        ]);
        if($valid){
            if(empty($request->file('photo'))){
                $purchases=Purchases::find($request->hidden_id);
                $company=Companies::find($purchases->company_id);
                Helper::addActivityLog('<span class=""> خرید با مشخصات (<span class="blue-grey"> بل نمبر :  Bill-'.$purchases->bill_number.' / برای شرکت : '.$company->company_name.' </span> ) را ویرایش کرد </span> <br/><a href="purchases/info-item/'.$purchases->id.'" target="_blank" >  دیدن خرید </a>');
                $purchases->bill_number=$request->bill_number;
                $purchases->company_id=$request->company_name;
                $purchases->total_price=$request->total_price;
                $purchases->quantity_goods=$request->quantity_goods;
                $purchases->money_paid=$request->money_paid;
                $purchases->purchase_date=$request->purchase_date;
                $purchases->currency=$request->currency;
                $purchases->save();

                $remain=$request->total_price-$request->money_paid;
                if($remain>0){
                    $loan=Loan::where('purchase_id',$request->hidden_id)->get();
                    if(!empty($loan[0])){
                        $loan[0]->quantity_loan=$remain;
                        $loan[0]->save();
                    }else{
                        $loan_new=new Loan();
                        $loan_new->purchase_id=$request->hidden_id;
                        $loan_new->quantity_loan=$remain;
                        $loan_new->status='گرفته';
                        $loan_new->save();
                    }
                }else{
                    $loan_old=Loan::where('purchase_id',$request->hidden_id)->get();
                    if(!empty($loan_old[0])){
                        Loan::where('purchase_id',$request->hidden_id)->delete();
                    }
                }


                return  response()->json(['success'=>'خرید موفقانه ویرایش شد']);
            }else{
                $path=Storage::putFile('customers-img',$request->file('photo'));
                $purchases=Purchases::find($request->hidden_id);

                $company=Companies::find($purchases->company_id);
                Helper::addActivityLog('<span class=""> خرید با مشخصات (<span class="blue-grey"> بل نمبر :  Bill-'.$purchases->bill_number.' / برای شرکت : '.$company->company_name.' </span> ) را ویرایش کرد </span> <br/><a href="purchases/info-item/'.$purchases->id.'" target="_blank" >  دیدن خرید </a>');

                $purchases->bill_number=$request->bill_number;
                $purchases->company_id=$request->company_name;
                $purchases->total_price=$request->total_price;
                $purchases->quantity_goods=$request->quantity_goods;
                $purchases->money_paid=$request->money_paid;
                $purchases->purchase_date=$request->purchase_date;
                $purchases->currency=$request->currency;
                $purchases->photo=$path;
                $purchases->save();

                $remain=$request->total_price-$request->money_paid;
                if($remain>0){
                    $loan=Loan::where('purchase_id',$request->hidden_id)->get();
                    if(!empty($loan[0])){
                        $loan[0]->quantity_loan=$remain;
                        $loan[0]->save();
                    }else{
                        $loan_new=new Loan();
                        $loan_new->purchase_id=$request->hidden_id;
                        $loan_new->quantity_loan=$remain;
                        $loan_new->status='گرفته';
                        $loan_new->save();
                    }
                }else{
                    $loan_old=Loan::where('purchase_id',$request->hidden_id)->get();
                    if(!empty($loan_old[0])){
                        Loan::where('purchase_id',$request->hidden_id)->delete();
                    }
                }
                
                return  response()->json(['success'=>'خرید موفقانه ویرایش شد']);
            }
        } 
    }

    

    public function infoItem($id)
    {

        $purchase=Purchases::join('companies','companies.id','=','company_id')
        ->select('purchases.id as id','purchases.bill_number','purchases.quantity_goods','purchases.total_price','purchases.money_paid','purchases.purchase_date','purchases.currency','purchases.created_at','purchases.photo','companies.company_name','companies.company_photo','companies.id as company_id','purchases.photo as puchase_photo')
        ->orderBy('purchases.created_at','DESC')
        ->find($id);


        $goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.id as id','goods.name as name','goods.type_of','goods_categories.name as category_name','goods.created_at')
        ->orderBy('goods.created_at','DESC')
        ->get();


        $purchaseDocument=PurchaseDocument::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','category_id')
        ->join('purchases','purchases.id','purchase_id')
        ->select('purchase_documents.id as id','purchase_documents.goods_quantity','purchase_documents.price','purchase_documents.created_at','purchase_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of',)
        ->where('purchase_id',$id)
        ->orderBy('purchase_documents.created_at','DESC')
        ->get();

        
        $paymentsHistory=Payments::join('loans','loans.id','payments.loan_id')
        ->join('purchases','purchases.id','=','loans.purchase_id')
        ->select('payments.id as id','purchases.bill_number','purchases.currency','loans.status',
                 'payments.pay_quantity as pay_quantity','payments.pay_date','payments.referral_number','payments.pay_date as pay_date')
        ->where('loans.status','گرفته')
        ->where('purchases.id',$id)
        ->orderBy('payments.created_at','DESC')
        ->get();

        $loans=Loan::Where('purchase_id',$id)->select('id')->where('loans.status','گرفته')->get();
        if(!empty($loans[0])){
            $loan_id=$loans[0]->id;
            $remain=Payments::where('loan_id',$loan_id)->sum('pay_quantity');
        }else{
            $remain=0;
        }

        return view('dashboard.purchases.infoItem', compact('purchase','purchaseDocument','goods','paymentsHistory','remain'));
    }

    public function destroy($id)
    {
        $purchase=Purchases::find($id);
        $company=Companies::find($purchase->company_id);
        Helper::addActivityLog('<span class="danger"> خرید با مشخصات (<span class="blue-grey"> بل نمبر :  Bill-'.$purchase->bill_number.' / برای شرکت : '.$company->company_name.' / مقدار جنس : '.$purchase->quantity_goods.' دانه  / مجموعه پول : '.$purchase->total_price.' '.$purchase->currency.' / مقدار پرداخت شده : '.$purchase->money_paid.'  </span> ) را حذف کرد </span> <br/><a href="purchases/info-item/'.$purchase->id.'" target="_blank" >  دیدن خرید </a>');

        Purchases::destroy($id);
        return  response()->json(['success'=>'خرید موفقانه حذف شد']);
    }
}
