<?php
namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Bills;
use App\Models\Purchases;
use App\Models\Goods;
use App\Models\PurchaseDocument;
use App\Models\GoodsCategory;
use App\Models\Companies;
use App\Models\Customers;
use App\Models\Employees;
use App\Models\BillDocuments;
use App\Models\Stock;
use App\Models\StockHistory;
use Helper;
use App\Models\User;


class BillDocumentsController extends Controller
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
        if(!empty($request->goods_name)){
            $stock=Stock::where('goods_id',$request->goods_name)->get();
            $stock_quantity=$stock[0]->quantity_goods;
            $valid=$request->validate([
                'goods_name'=>'required',
                'quantity_goods'=>'required|integer|max:'.$stock_quantity.'',
                'goods_price'=>'required',
                'hidden_id'=>'required',
            ]);
        }else{
            $valid=$request->validate([
                'goods_name'=>'required',
                'quantity_goods'=>'required|integer',
                'goods_price'=>'required',
                'hidden_id'=>'required',
            ]);
        }

        if($valid)
        {
            $bill_documents=new BillDocuments();
            $bill_documents->bill_id=$request->hidden_id;
            $bill_documents->goods_id=$request->goods_name;
            $bill_documents->goods_price=$request->goods_price;
            $bill_documents->quantity_goods=$request->quantity_goods;
            $bill_documents->save();
            $data=BillDocuments::join('goods','goods.id','=','goods_id')
            ->join('goods_categories','goods_categories.id','=','category_id')
            ->join('bills','bills.id','=','bill_id')
            ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
            ->where('bill_id',$request->hidden_id)
            ->get();

            $bill=Bills::find($request->hidden_id);
            $customer=Customers::find($bill->customer_id);
            $goods=Goods::find($bill_documents->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            Helper::addActivityLog('<span class="success"> برای بل نمبر Bill-'.$bill->bill_num.' جنس جدیدی با مشخضات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.'  / قیمت جنس :   '.$bill_documents->goods_price.' '.$bill->currency.' / تعداد جنس : '.$bill_documents->quantity_goods.' دانه </span> ) اضافه کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


            return  response()->json(['success'=>'جنس  موفقانه اضافه شد','data'=>$data]);
        }
    }



    public function editStore(Request $request)
    {
        if(!empty($request->goods_name)){
            $stock=Stock::where('goods_id',$request->goods_name)->get();
            $stock_quantity=$stock[0]->quantity_goods;
            $valid=$request->validate([
                'goods_name'=>'required',
                'quantity_goods'=>'required|integer|max:'.$stock_quantity.'',
                'goods_price'=>'required',
                'hidden_id'=>'required',
            ]);
        }else{
            $valid=$request->validate([
                'goods_name'=>'required',
                'quantity_goods'=>'required|integer',
                'goods_price'=>'required',
                'hidden_id'=>'required',
            ]);
        }

        if($valid)
        {
            $bill_documents=new BillDocuments();
            $bill_documents->bill_id=$request->hidden_id;
            $bill_documents->goods_id=$request->goods_name;
            $bill_documents->goods_price=$request->goods_price;
            $bill_documents->quantity_goods=$request->quantity_goods;
            $bill_documents->save();

            $bill=Bills::find($request->hidden_id);
            $customer=Customers::find($bill->customer_id);
            $goods=Goods::find($bill_documents->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            Helper::addActivityLog('<span class="success"> برای بل نمبر Bill-'.$bill->bill_num.' جنس جدیدی با مشخضات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.'  / قیمت جنس :   '.$bill_documents->goods_price.' '.$bill->currency.' / تعداد جنس : '.$bill_documents->quantity_goods.' دانه </span> ) اضافه کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


            $data=BillDocuments::join('goods','goods.id','=','goods_id')
            ->join('goods_categories','goods_categories.id','=','category_id')
            ->join('bills','bills.id','=','bill_id')
            ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
            ->where('bill_id',$request->hidden_id)
            ->get();
            
            $stock=Stock::where('goods_id',$request->goods_name)->get();
            $stock_quantity=$stock[0]->quantity_goods;
            $stock_id=$stock[0]->id;
            if($stock_quantity>=$request->quantity_goods){
                $quantity=($stock_quantity)-($request->quantity_goods);
                $stock_update=stock::find($stock_id);
                $stock_update->quantity_goods=$quantity;
                $stock_update->save();  
            }

            $stockHistory=new StockHistory();
            $stockHistory->goods_id=$request->goods_name;
            $stockHistory->quantity_goods=$request->quantity_goods;
            $stockHistory->status='out';


            $employee=User::join('employees','employees.user_id','=','users.id')
            ->select('employees.id as employee_id')
            ->find(Auth()->id());
            $employee_id= $employee->employee_id;
            $stockHistory->employee_id=$employee_id;

            $stockHistory->save();

            return  response()->json(['success'=>'جنس  موفقانه اضافه شد','data'=>$data]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillDocuments  $billDocuments
     * @return \Illuminate\Http\Response
     */
    public function show(BillDocuments $billDocuments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillDocuments  $billDocuments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=BillDocuments::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillDocuments  $billDocuments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $stock=Stock::where('goods_id',$request->goods_name)->get();
        $stock_quantity=$stock[0]->quantity_goods;
        $valid=$request->validate([
            'goods_name'=>'required',
            'quantity_goods'=>'required|integer|max:'.$stock_quantity.'',
            'goods_price'=>'required',
            'bill_hidden_id'=>'required',
        ]);
        
        if($valid){
            $bill_documents=BillDocuments::find($request->hidden_id);

            $bill=Bills::find($request->bill_hidden_id);
            $customer=Customers::find($bill->customer_id);
            $goods=Goods::find($bill_documents->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            $new_goods=Goods::find($request->goods_name);
            $new_goods_category=GoodsCategory::find($new_goods->category_id);
            Helper::addActivityLog('<span > برای بل نمبر Bill-'.$bill->bill_num.' جنس را با مشخضات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.'  / قیمت جنس :   '.$bill_documents->goods_price.' '.$bill->currency.' / تعداد جنس : '.$bill_documents->quantity_goods.' دانه </span> ) به (<span class="blue-grey">  نام جنس : '. $new_goods_category->name.' '. $new_goods->name.' '. $new_goods->type_of.'  / قیمت جنس :   '.$request->goods_price.' '.$bill->currency.' / تعداد جنس : '.$request->quantity_goods.' دانه </span> )      ویرایش کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');

            $bill_documents->goods_id=$request->goods_name;
            $bill_documents->goods_price=$request->goods_price;
            $bill_documents->quantity_goods=$request->quantity_goods;
            $bill_documents->save();
            $data=BillDocuments::join('goods','goods.id','=','goods_id')
            ->join('goods_categories','goods_categories.id','=','category_id')
            ->join('bills','bills.id','=','bill_id')
            ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
            ->where('bill_id',$request->bill_hidden_id)
            ->get();
            return  response()->json(['success'=>'جنس موفقانه ویرایش شد','data'=>$data]);
        }
    }



    public function editUpdate(Request $request)
    {
        $stock=Stock::where('goods_id',$request->goods_name)->get();
        $stock_quantity=$stock[0]->quantity_goods;
        $valid=$request->validate([
            'goods_name'=>'required',
            'quantity_goods'=>'required|integer',
            'goods_price'=>'required',
            'bill_hidden_id'=>'required',
        ]);
        if($valid){
            $bill_documents=BillDocuments::find($request->hidden_id);
            if($bill_documents->goods_id==$request->goods_name){
                $stock=Stock::where('goods_id',$request->goods_name)->get();
                $stock_quantity=$stock[0]->quantity_goods;
                $stock_id=$stock[0]->id;
                $quantity=($stock_quantity+$bill_documents->quantity_goods)-($request->quantity_goods);
                $stock_update=stock::find($stock_id);
                $stock_update->quantity_goods=$quantity;
                $stock_update->save();  
                
            }else{
                $edit_stock=Stock::where('goods_id',$bill_documents->goods_id)->get();
                $edit_stock_quantity=$edit_stock[0]->quantity_goods;
                $edit_stock_id=$edit_stock[0]->id;
                $edit_quantity=($edit_stock_quantity)+($bill_documents->quantity_goods);
                $edit_stock_update=stock::find($edit_stock_id);
                $edit_stock_update->quantity_goods=$edit_quantity;
                $edit_stock_update->save(); 

                $stock=Stock::where('goods_id',$request->goods_name)->get();
                $stock_quantity=$stock[0]->quantity_goods;
                $stock_id=$stock[0]->id;
                if($stock_quantity>=$request->quantity_goods){
                    $quantity=($stock_quantity)-($request->quantity_goods);
                    $stock_update=stock::find($stock_id);
                    $stock_update->quantity_goods=$quantity;
                    $stock_update->save();  
                }
            }

            $bill=Bills::find($request->bill_hidden_id);
            $customer=Customers::find($bill->customer_id);
            $goods=Goods::find($bill_documents->goods_id);
            $goods_category=GoodsCategory::find($goods->category_id);
            $new_goods=Goods::find($request->goods_name);
            $new_goods_category=GoodsCategory::find($new_goods->category_id);
            Helper::addActivityLog('<span > برای بل نمبر Bill-'.$bill->bill_num.' جنس را با مشخضات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.'  / قیمت جنس :   '.$bill_documents->goods_price.' '.$bill->currency.' / تعداد جنس : '.$bill_documents->quantity_goods.' دانه </span> ) به (<span class="blue-grey">  نام جنس : '. $new_goods_category->name.' '. $new_goods->name.' '. $new_goods->type_of.'  / قیمت جنس :   '.$request->goods_price.' '.$bill->currency.' / تعداد جنس : '.$request->quantity_goods.' دانه </span> )      ویرایش کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


            
            $bill_documents->goods_id=$request->goods_name;
            $bill_documents->goods_price=$request->goods_price;
            $bill_documents->quantity_goods=$request->quantity_goods;
            $bill_documents->save();
            $data=BillDocuments::join('goods','goods.id','=','goods_id')
            ->join('goods_categories','goods_categories.id','=','category_id')
            ->join('bills','bills.id','=','bill_id')
            ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
            ->where('bill_id',$request->bill_hidden_id)
            ->get();
            return  response()->json(['success'=>'جنس موفقانه ویرایش شد','data'=>$data]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillDocuments  $billDocuments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill_documents=BillDocuments::find($id);
        $bill_id=$bill_documents->bill_id;

        $bill=Bills::find($bill_id);
        $customer=Customers::find($bill->customer_id);
        $goods=Goods::find($bill_documents->goods_id);
        $goods_category=GoodsCategory::find($goods->category_id);
        Helper::addActivityLog('<span class="danger"> برای بل نمبر Bill-'.$bill->bill_num.' جنس را با مشخضات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.'  / قیمت جنس :   '.$bill_documents->goods_price.' '.$bill->currency.' / تعداد جنس : '.$bill_documents->quantity_goods.' دانه </span> ) حذف کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


        BillDocuments::destroy($id);
        $data=BillDocuments::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','category_id')
        ->join('bills','bills.id','=','bill_id')
        ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
        ->where('bill_id',$bill_id)
        ->get();
        return  response()->json(['success'=>'جنس موفقانه حذف شد','data'=>$data]);
    }


    public function deleteBillDocuments($id)
    {
        $bill_documents=BillDocuments::find($id);
        $bill_id=$bill_documents->bill_id;

        
        $bill=Bills::find($bill_id);
        $customer=Customers::find($bill->customer_id);
        $goods=Goods::find($bill_documents->goods_id);
        $goods_category=GoodsCategory::find($goods->category_id);
        Helper::addActivityLog('<span class="danger"> برای بل نمبر Bill-'.$bill->bill_num.' جنس را با مشخضات (<span class="blue-grey">  نام جنس : '. $goods_category->name.' '. $goods->name.' '. $goods->type_of.'  / قیمت جنس :   '.$bill_documents->goods_price.' '.$bill->currency.' / تعداد جنس : '.$bill_documents->quantity_goods.' دانه </span> ) حذف کرد </span>    <br/><a href="bills/info_bill/'.$bill->id.'" target="_blank" > دیدن  بل </a>');


        $stock=Stock::where('goods_id',$bill_documents->goods_id)->get();
        $stock_quantity=$stock[0]->quantity_goods;
        $stock_id=$stock[0]->id;
        $quantity=($stock_quantity+$bill_documents->quantity_goods);
        $stock_update=stock::find($stock_id);
        $stock_update->quantity_goods=$quantity;
        $stock_update->save();  

        BillDocuments::destroy($id);
        $data=BillDocuments::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','category_id')
        ->join('bills','bills.id','=','bill_id')
        ->select('bill_documents.id as id','bill_documents.goods_price','bill_documents.quantity_goods','bill_documents.created_at','bill_documents.goods_id','goods.name as goods_name','goods.id as goodId','goods_categories.name as category_name','goods.type_of','bills.currency')
        ->where('bill_id',$bill_id)
        ->get();
        return  response()->json(['success'=>'جنس موفقانه حذف شد','data'=>$data]);
    }
    



    public function getGoods($id)
    {
        $data_goods=BillDocuments::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','category_id')
        ->join('bills','bills.id','=','bill_id')
        ->select('bill_documents.goods_id')
        ->where('bill_id',$id)
        ->distinct()
        ->get();
        $array=array();
        foreach($data_goods as $key){
           $array[]= $key->goods_id;
        }
        $data_goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.name as goods_name','goods.id as good_id','goods_categories.name as category_name','goods.type_of')
        ->whereNotIn('goods.id', $array)
        ->orwhere('goods.created_at','DESC')
        ->get();
        return  response()->json($data_goods);
    }

    public function UpdategetGoods($id,$myid)
    {
        $data_goods=BillDocuments::join('goods','goods.id','=','goods_id')
        ->join('goods_categories','goods_categories.id','=','category_id')
        ->join('bills','bills.id','=','bill_id')
        ->select('bill_documents.goods_id')
        ->where('bill_id',$id)
        ->distinct()
        ->get();
        $array=array();
        foreach($data_goods as $key){
           if($key->goods_id!=$myid){
                $array[]= $key->goods_id;
           }
        }
        $data_goods=Goods::join('goods_categories','goods_categories.id','=','category_id')
        ->select('goods.name as goods_name','goods.id as good_id','goods_categories.name as category_name','goods.type_of')
        ->whereNotIn('goods.id', $array)
        ->orwhere('goods.created_at','DESC')
        ->get();
        return  response()->json($data_goods);
    }





}
