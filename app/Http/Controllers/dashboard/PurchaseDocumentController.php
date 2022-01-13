<?php

namespace App\Http\Controllers\dashboard;

use App\Models\PurchaseDocument;
use App\Models\Purchases;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Helper;

class PurchaseDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'goods_name'=>'required',
            'goods_price'=>'required',
            'quantity_goods'=>'required',
        ]);

        if($valid){
            $purchaseDocument=new PurchaseDocument();
            $purchaseDocument->goods_id=$request->goods_name;
            $purchaseDocument->price=$request->goods_price;
            $purchaseDocument->purchase_id=$request->purchase_id;
            $purchaseDocument->goods_quantity=$request->quantity_goods;
            $purchaseDocument->save();

            $purchases=Purchases::find($purchaseDocument->purchase_id);
            $company=Companies::find($purchases->company_id);
            $goods=Goods::find($purchaseDocument->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            Helper::addActivityLog('<span class="success"> جنس جدیدی را در خرید با مشخصات (<span class="blue-grey"> بل نمبر :  Bill-'.$purchases->bill_number.' / برای شرکت : '.$company->company_name.' / نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' / تعداد جنس : '.$purchaseDocument->goods_quantity.' دانه  / قیمت جنس : '.$purchaseDocument->price.' '.$purchases->currency.'   </span> ) اضافه کرد </span> <br/><a href="purchases/info-item/'.$purchases->id.'" target="_blank" >  دیدن خرید </a>');
            
            return  response()->json(['success'=>' موفقانه اضافه شد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseDocument  $purchaseDocument
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseDocument $purchaseDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseDocument  $purchaseDocument
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseDocument=PurchaseDocument::find($id);
        return response()->json($purchaseDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseDocument  $purchaseDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'goods_name'=>'required',
            'goods_price'=>'required',
            'quantity_goods'=>'required',
        ]);

        if($valid){
            $purchaseDocument=PurchaseDocument::find($request->hidden_id);

            $purchases=Purchases::find($purchaseDocument->purchase_id);
            $company=Companies::find($purchases->company_id);
            $goods=Goods::find($purchaseDocument->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            $activity='<span> جنس را در خرید با  بل نمبر :  Bill-'.$purchases->bill_number.'  از شرکت : '.$company->company_name.' (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' / تعداد جنس : '.$purchaseDocument->goods_quantity.' دانه  / قیمت جنس : '.$purchaseDocument->price.' '.$purchases->currency.'   </span> )  به';

            $purchaseDocument->goods_id=$request->goods_name;
            $purchaseDocument->price=$request->goods_price;
            $purchaseDocument->goods_quantity=$request->quantity_goods;
            $purchaseDocument->save();

            $purchases=Purchases::find($purchaseDocument->purchase_id);
            $company=Companies::find($purchases->company_id);
            $goods=Goods::find($purchaseDocument->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            $activity.='<span> (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' / تعداد جنس : '.$purchaseDocument->goods_quantity.' دانه  / قیمت جنس : '.$purchaseDocument->price.' '.$purchases->currency.'   </span> )   ویرایش  کرد </span> <br/><a href="purchases/info-item/'.$purchases->id.'" target="_blank" >  دیدن خرید </a>';
            Helper::addActivityLog($activity);
            

            return  response()->json(['success'=>' موفقانه ویرایش شد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseDocument  $purchaseDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchaseDocument=PurchaseDocument::find($id);
        $purchases=Purchases::find($purchaseDocument->purchase_id);
        $company=Companies::find($purchases->company_id);
        $goods=Goods::find($purchaseDocument->goods_id);
        $goods_category=GoodsCategory::find($goods->category_id);
        Helper::addActivityLog('<span class="danger"> جنس را از خرید با  بل نمبر :  Bill-'.$purchases->bill_number.' از شرکت : '.$company->company_name.' (<span class="blue-grey"> نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' / تعداد جنس : '.$purchaseDocument->goods_quantity.' دانه  / قیمت جنس : '.$purchaseDocument->price.' '.$purchases->currency.'   </span> ) حذف کرد </span> <br/><a href="purchases/info-item/'.$purchases->id.'" target="_blank" >  دیدن خرید </a>');
        
        PurchaseDocument::destroy($id);
        return  response()->json(['success'=>' موفقانه حذف شد']);
    }
}
