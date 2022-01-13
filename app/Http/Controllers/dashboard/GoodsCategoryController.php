<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\GoodsCategory;
use Helper;

class GoodsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goodsCategory=GoodsCategory::orderBy('created_at','DESC')->get();
        return view('dashboard.goods.category',compact('goodsCategory'));
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
            'name'=>'required'
        ]);

       if($valid){
            $category=new GoodsCategory();
            $category->name=$request->name;
            $category->save();
            Helper::addActivityLog('<span class="success" >کتگوری جدیدی را بنام  (<span class="blue-grey"> '. $category->name.' </span> ) اضافه کرد </span> <br/><a href="goods_category" target="_blank" > دیدن کتگوری جنس </a>');
            return  response()->json(['success'=>'کتگوری موفقانه اضافه شد']);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid=$request->validate([
            'name'=>'required'
        ]);

       if($valid){
            $category=GoodsCategory::find($request->hidden_id);
            $ativity='<span class="" >نام کتگوری را از (<span class="blue-grey"> '. $category->name.' ) به ';
            $category->name=$request->name;
            $category->save();
            $ativity.= ' ( '.$category->name.' ) </span>  ویرایش کرد </span> <br/><a href="goods_category" target="_blank" > دیدن کتگوری جنس </a>';
            Helper::addActivityLog($ativity);

            return  response()->json(['success'=>'کتگوری موفقانه ویرایش شد']);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=GoodsCategory::find($id);
        Helper::addActivityLog('<span class="danger" >کتگوری بنام  (<span class="blue-grey"> '. $category->name.' </span> ) را حذف کرد </span>');
        GoodsCategory::destroy($id);
        return  response()->json(['success'=>'کتگوری موفقانه ویرایش شد']);
    }
}
