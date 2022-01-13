<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Sales;
use App\Models\Bills;
use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Customers;
use App\Models\BillDocuments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills=Bills::join('customers','customers.id','=','bills.customer_id')
        ->select('bills.id as id','bills.bill_num','bills.customer_id','bills.quantity_goods','bills.total_price',
        'bills.money_paid','bills.money_remaining','bills.currency','bills.status','bills.created_at',
        'customers.firstname','customers.lastname','customers.phone_number','customers.province')
        ->orderBy('created_at','DESC')
        ->where('status','تکمیل')
        ->get();
        return view('dashboard.sales.sales',compact('bills'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
