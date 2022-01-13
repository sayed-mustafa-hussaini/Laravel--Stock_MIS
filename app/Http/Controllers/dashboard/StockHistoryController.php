<?php
namespace App\Http\Controllers\dashboard;

use App\Models\Stock;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\Companies;
use App\Models\Purchases;
use App\Models\employees;
use App\Models\Users;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Helper;

class StockHistoryController extends Controller
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

        $stockHistory= StockHistory::join('employees','employees.id','stock_histories.employee_id')
        ->join('users','users.id','employees.user_id')
        ->join('goods','goods.id','=','stock_histories.goods_id')
        ->join('goods_categories','goods_categories.id','=','goods.category_id')
        ->select('stock_histories.id as id','stock_histories.quantity_goods','stock_histories.created_at','goods.name as goods_name','goods.type_of','goods_categories.name as category_name','users.name as username','users.email as user_email','users.lastname as user_lastname','stock_histories.goods_id','employees.id as employee_id')
        ->where('status','out')
        ->orderBy('stock_histories.created_at','DESC')
        ->get();

        return view('dashboard.stock.stock_out',compact('stockHistory','goods','employees'));
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
        if(!empty($request->goods_name)){
            $stock=Stock::where('goods_id',$request->goods_name)->get();
            $stock_quantity=$stock[0]->quantity_goods;
            $valid=$request->validate([
                'goods_name'=>'required',
                'quantity_goods'=>'required|integer|max:'.$stock_quantity.'',
                'emoloyee_name'=>'required',
            ]);

            $stock_id=$stock[0]->id;
            $quantity=($stock_quantity)-($request->quantity_goods);
            $stock_update=stock::find($stock_id);
            $stock_update->quantity_goods=$quantity;
            $stock_update->save();

        }else{
            $valid=$request->validate([
                'goods_name'=>'required',
                'quantity_goods'=>'required|integer',
                'emoloyee_name'=>'required',
            ]);
        }

        if($valid){
            $stockHistory=new StockHistory();
            $stockHistory->goods_id=$request->goods_name;
            $stockHistory->quantity_goods=$request->quantity_goods;
            $stockHistory->status='out';
            $stockHistory->employee_id=$request->emoloyee_name;
            $stockHistory->save();

            $goods=Goods::find($stockHistory->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            Helper::addActivityLog('<span class="success"> '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' را در قسمت خارج شده گدام به  (<span class="blue-grey"> تعداد '.$stockHistory->quantity_goods.' دانه  </span> ) اضافه کرد </span> <br/><a href="stock_out" target="_blank" >  دیدن جنس های خارج شده از گدام </a>');

            return  response()->json(['success'=>'جنس از گدام موفقانه خارج شد']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function show(StockHistory $stockHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(StockHistory $stockHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $StockHistory=StockHistory::find($request->hidden_id);
        $myQuantity=$StockHistory->quantity_goods;

        if($StockHistory->quantity_goods>$request->quantity_goods){
            $quantity=$StockHistory->quantity_goods-$request->quantity_goods;
            $stock_update=stock::where('goods_id',$StockHistory->goods_id)->get();
            $quantity_update=$stock_update[0]->quantity_goods+$quantity;
            $stock=Stock::find($stock_update[0]->id);
            $stock->quantity_goods=$quantity_update;
            $stock->save();
        }elseif ($StockHistory->quantity_goods<$request->quantity_goods){
            $quantity=$request->quantity_goods-$StockHistory->quantity_goods;

            $stock_update=stock::where('goods_id',$StockHistory->goods_id)->get();
            $total=$stock_update[0]->quantity_goods+$StockHistory->quantity_goods;
            $valid=$request->validate([
                'quantity_goods'=>'required|integer|max:'.$total.'',
            ]);
            if($valid){
                $quantity_update=$stock_update[0]->quantity_goods-$quantity;
                $stock=Stock::find($stock_update[0]->id);
                $stock->quantity_goods=$quantity_update;
                $stock->save();
            }
        }

        $valid=$request->validate([
            'quantity_goods'=>'required',
            'emoloyee_name'=>'required',
        ]);
        if($valid){
            $StockHistory->quantity_goods=$request->quantity_goods;
            $StockHistory->employee_id=$request->emoloyee_name;
            $StockHistory->save();

            $goods=Goods::find($StockHistory->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            Helper::addActivityLog('<span class=""> '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' را در قسمت خارج شده گدام از  (<span class="blue-grey"> تعداد '.$myQuantity.' دانه  </span> ) به  (<span class="blue-grey"> تعداد '.$StockHistory->quantity_goods.' دانه  </span> ) اضافه کرد </span> <br/><a href="stock_out" target="_blank" >  دیدن جنس های خارج شده از گدام </a>');
            
            return  response()->json(['success'=>'موفقانه ویرایش شد']);
        }
    }


    public function getQuantity($goods_id)
    {
        $stock=Stock::where('goods_id',$goods_id)->select('quantity_goods')->get();
        return  response()->json($stock);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $stockHistory=StockHistory::find($id);
        $goods=Goods::find($stockHistory->goods_id);
        $goods_category=GoodsCategory::find($goods->category_id);
        Helper::addActivityLog('<span class="danger"> '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' را از قسمت خارج شده گدام به  (<span class="blue-grey"> تعداد '.$stockHistory->quantity_goods.' دانه  </span> ) حذف کرد </span> <br/><a href="stock_out" target="_blank" >  دیدن جنس های خارج شده از گدام </a>');

        StockHistory::destroy($id);
        return  response()->json(['success'=>'موفقانه حذف شد']);

    }


   




}
