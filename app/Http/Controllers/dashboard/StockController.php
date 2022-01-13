<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Stock;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\Companies;
use App\Models\Purchases;
use App\Models\employees;
use App\Models\Users;
use Helper;
use App\Models\StockHistory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.id as id','goods.name as name','goods.type_of','goods.created_at','goods_categories.name as category_name')
        ->orderBy('goods.created_at','DESC')
        ->get();
        $employees=employees::join('users','users.id','=','user_id')
        ->select('employees.id as id','users.email as email','employees.created_at','users.name','users.lastname')
        ->orderBy('employees.created_at','DESC')
        ->get();
        $stocks=Stock::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','goods.category_id')
        ->select('stocks.id as id','stocks.quantity_goods','stocks.created_at','goods.name as goods_name','goods.type_of','goods_categories.name as category_name')
        ->orderBy('stocks.created_at','DESC')
        ->get();
        $total_goods_type=Stock::count();
        $total_goods=Stock::sum('quantity_goods');


        $stockHistory= StockHistory::join('employees','employees.id','stock_histories.employee_id')
        ->join('users','users.id','employees.user_id')
        ->join('goods','goods.id','=','stock_histories.goods_id')
        ->join('goods_categories','goods_categories.id','=','goods.category_id')
        ->select('stock_histories.id as id','stock_histories.quantity_goods','stock_histories.created_at','goods.name as goods_name','goods.type_of','goods_categories.name as category_name','users.name as username','users.email as user_email','users.lastname as user_lastname',)
        ->where('status','store')
        ->orderBy('stock_histories.created_at','DESC')
        ->get();
    
        return view('dashboard.stock.stock',compact('stocks','goods','employees','total_goods_type','total_goods','stockHistory'));
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
            'quantity_goods'=>'required',
            'emoloyee_name'=>'required',
        ]);
        if($valid){
            $stock_goods=Stock::where('goods_id',$request->goods_name)->get();
            $quantity= ($stock_goods[0]->quantity_goods)+$request->quantity_goods;
            $stock=Stock::where('goods_id',$request->goods_name)
            ->update([
                'quantity_goods'=>$quantity,
                'updated_at'=>now(),
            ]);


            $goods=Goods::find($request->goods_name);
            $goods_category=GoodsCategory::find($goods->category_id);
            Helper::addActivityLog('<span class="success"> جنس جدیدی را در گدام  (<span class="blue-grey">'. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' / تعداد جنس : '.$request->quantity_goods.' دانه  </span> ) اضافه کرد </span> <br/><a href="stock" target="_blank" >  دیدن گدام </a>');
            

            $stockHistory=new StockHistory();
            $stockHistory->goods_id=$request->goods_name;
            $stockHistory->quantity_goods=$request->quantity_goods;
            $stockHistory->status='store';
            $stockHistory->employee_id=$request->emoloyee_name;
            $stockHistory->save();

            return  response()->json(['success'=>'جنس در گدام موفقانه اضافه شد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'quantity_goods'=>'required',
        ]);
        if($valid){
            $stock=Stock::find($request->hidden_id);

            $goods=Goods::find($stock->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            $activity='<span class=""> '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' را در گدام  (<span class="blue-grey">  '.$stock->quantity_goods.' دانه  </span> ) ';

            $stock->quantity_goods=$request->quantity_goods;
            $stock->save();

            $activity.=' به (<span class="blue-grey">'.$request->quantity_goods.' دانه  </span> ) ویرایش کرد </span> <br/><a href="stock" target="_blank" >  دیدن گدام </a>';
            Helper::addActivityLog($activity);
            
            return  response()->json(['success'=>'تعداد جنس در گدام موفقانه ویرایش شد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Stock=StockHistory::find($id);
        $goods=Goods::find($Stock->goods_id);
        $goods_category=GoodsCategory::find($goods->category_id);
        Helper::addActivityLog('<span class="danger"> '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' را از گدام به  (<span class="blue-grey"> تعداد '.$Stock->quantity_goods.' دانه  </span> ) حذف کرد </span> <br/><a href="stock" target="_blank" >  دیدن گدام </a>');
        

        StockHistory::destroy($id);
        return  response()->json(['success'=>'موفقانه حذف شد']);
    }



}
