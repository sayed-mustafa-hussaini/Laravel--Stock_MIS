<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Stock;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\Companies;
use App\Models\Purchases;
use App\Models\employees;
use App\Models\Users;
use App\Models\Bills;
use App\Models\Loan;
use App\Models\Customers;
use App\Models\StockHistory;
use App\Models\EmployeeSalary;
use App\Models\Rent;
use App\Models\FinancialExpenses;
use Helper;

class DashboardController extends Controller
{
    public function index()
    {
        // General
        $company = Companies::count();
        $customer = Customers::count();
        $goods = goods::join('stocks','stocks.goods_id','=','goods.id')->select('stocks.quantity_goods')->sum('stocks.quantity_goods');
        $employees = Employees::count();
        // Bills Loans
        $purchase_loan_price_doller = Loan::join('purchases','purchases.id','loans.purchase_id')->where('purchases.currency','دالر')->where('loans.status','گرفته')->sum('loans.quantity_loan');
        $purchase_loan_price_af = Loan::join('purchases','purchases.id','loans.purchase_id')->where('purchases.currency','افغانی')->where('loans.status','گرفته')->sum('loans.quantity_loan');
            $loan_price_doller = Loan::join('bills','bills.id','bill_id')->where('bills.currency','دالر')->where('loans.status','داده')->sum('loans.quantity_loan');
            $loan_price_af = Loan::join('bills','bills.id','bill_id')->where('bills.currency','افغانی')->where('loans.status','داده')->sum('loans.quantity_loan');
        
        return view('dashboard.dashboard',compact('purchase_loan_price_doller','purchase_loan_price_af',
                                                                'loan_price_doller','loan_price_af',
                                                                'company','customer','goods','employees'));
    }
}


