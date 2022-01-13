<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Helper;


class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.id as id','goods.name as name','goods.type_of','goods.size','goods.color','goods_categories.name as category_name','goods.created_at')
        ->orderBy('goods.created_at','DESC')
        ->get();

        $goodsCategory=GoodsCategory::get();
        return view('dashboard.goods.goods',compact('goodsCategory','goods'));
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
            'type_of'=>'required',
            'category'=>'required',
            'size'=>'required',
            'color'=>'required',
        ]);
        if($valid)
        {
            $goods=new Goods();
            $goods->name=$request->name;
            $goods->type_of=$request->type_of;
            $goods->category_id=$request->category;
            $goods->size=$request->size;
            $goods->color=$request->color;
            $goods->save();
            
            $goods_category=GoodsCategory::find($request->category);
            Helper::addActivityLog('<span class="success" >جنس جدیدی را با مشخصات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' /  سایز جنس : '. $goods->size.' / رنگ جنس :'. $goods->color.'</span> ) اضافه کرد </span> <br/><a href="goods" target="_blank" > دیدن جنس </a>');
           
            $stock=new Stock();
            $stock->goods_id=$goods->id;
            $stock->quantity_goods=0;
            $stock->save();
            
            return  response()->json(['success'=>'جنس موفقانه اضافه شد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show(Goods $goods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods=Goods::find($id);
        return response()->json($goods);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'name'=>'required',
            'type_of'=>'required',
            'category'=>'required',
            'size'=>'required',
            'color'=>'required',
        ]);
        if($valid){
            $goods=Goods::find($request->hidden_id);

            $goods_category=GoodsCategory::find($goods->category_id);
            Helper::addActivityLog('<span >جنس را با مشخصات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' /  سایز جنس : '. $goods->size.' / رنگ جنس :'. $goods->color.'</span> ) ویرایش کرد </span> <br/><a href="goods" target="_blank" > دیدن جنس </a>');
           
            $goods->name=$request->name;
            $goods->type_of=$request->type_of;
            $goods->category_id=$request->category;
            $goods->size=$request->size;
            $goods->color=$request->color;
            $goods->save();
            return  response()->json(['success'=>'جنس موفقانه ویرایش شد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goods=Goods::find($id);
        $goods_category=GoodsCategory::find($goods->category_id);
        Helper::addActivityLog('<span class="danger" >جنس را با مشخصات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.' /  سایز جنس : '. $goods->size.' / رنگ جنس :'. $goods->color.'</span> ) حذف کرد </span>');
           
        Goods::destroy($id);
        return  response()->json(['success'=>'جنس موفقانه حذف شد']);
    }
}
