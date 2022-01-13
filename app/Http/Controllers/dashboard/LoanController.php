<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Loan;
use App\Models\Bills;
use App\Models\Purchases;
use App\Models\Goods;
use App\Models\PurchaseDocument;
use App\Models\GoodsCategory;
use App\Models\Companies;
use App\Models\Customers;
use App\Models\BillDocuments;
use App\Models\StockHistory;
use App\Models\Stock;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getLoan()
    {
        $loans=Loan::join('purchases','purchases.id','=','loans.purchase_id')
        ->join('companies','companies.id','=','purchases.company_id')
        ->select('companies.company_name','companies.id as company_id','purchases.bill_number','purchases.currency','loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('status','گرفته')
        ->orderBy('loans.created_at','DESC')
        ->get();
        return view('dashboard.loan.getLoan',compact('loans'));
    }


    public function giveLoan()
    {
        $loans=Loan::join('bills','bills.id','=','loans.bill_id')
        ->join('customers','customers.id','=','bills.customer_id')
        ->select('customers.firstname','customers.lastname','customers.province','bills.bill_num','bills.currency','loans.id as id','loans.quantity_loan','loans.status','loans.created_at')
        ->where('loans.status','داده')
        ->orderBy('loans.created_at','DESC')
        ->get();
        return view('dashboard.loan.giveLoan',compact('loans'));
        
    }


    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy($loan)
    {
        Loan::destroy($loan);
        return  response()->json(['success'=>' قرض موفقانه حذف شد']);
    }
}
