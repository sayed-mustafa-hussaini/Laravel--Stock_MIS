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



class ReportsController extends Controller
{
    
    public function weeklyReport()
    {
        // $purchase_price = Bills::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_price');
        // $purchase_goods=DB::select('SELECT sum(quantity_goods) as total_purchase_goods FROM purchases WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)');
        // $purchase_goods = Purchases::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->sum('quantity_goods');


        // Purchases
        $purchase_goods = Purchases::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('quantity_goods');
        $purchase_price_doller = Purchases::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('currency','دالر')->sum('total_price');
        $purchase_price_af = Purchases::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('currency','افغانی')->sum('total_price');

        // Bills
        $bill_goods =Bills::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('quantity_goods');
        $bill_price_doller = Bills::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('currency','دالر')->sum('total_price');
        $bill_price_af = Bills::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('currency','افغانی')->sum('total_price');
        // Bills Loans
        $loan_price_doller = Loan::join('bills','bills.id','bill_id')->where('bills.currency','دالر')->whereBetween('loans.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('loans.status','داده')->sum('loans.quantity_loan');
        $loan_price_af = Loan::join('bills','bills.id','bill_id')->where('bills.currency','افغانی')->whereBetween('loans.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('loans.status','داده')->sum('loans.quantity_loan');
        // Payments
        $payment_price_doller = Loan::join('bills','bills.id','bill_id')
        ->join('payments','payments.loan_id','loans.id')
        ->where('bills.currency','دالر')->whereBetween('payments.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('loans.status','داده')->sum('payments.pay_quantity');
        $payment_price_af = Loan::join('bills','bills.id','bill_id')
        ->join('payments','payments.loan_id','loans.id')
        ->where('bills.currency','افغانی')->whereBetween('payments.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('loans.status','داده')->sum('payments.pay_quantity');

        // General
        $company = Companies::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $customer = Customers::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $purchase = Purchases::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $bill = Bills::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        
        return view('dashboard.all-reports.weeklyReport',compact('purchase_goods','purchase_price_doller','purchase_price_af',
                                                                'bill_goods','bill_price_doller','bill_price_af',
                                                                'loan_price_doller','loan_price_af',
                                                                'payment_price_doller','payment_price_af',
                                                                'company','customer','purchase','bill'));
    }





    public function monthlyReport()
    {
        // General
        $company = Companies::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $customer = Customers::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $purchase = Purchases::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $bill = Bills::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
         
        
         // Purchases
         $purchase_goods = Purchases::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('quantity_goods');
         $purchase_price_doller = Purchases::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('currency','دالر')->sum('total_price');
         $purchase_price_af = Purchases::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('currency','افغانی')->sum('total_price');
           // Bills Loans
            $purchase_loan_price_doller = Loan::join('purchases','purchases.id','loans.purchase_id')->where('purchases.currency','دالر')->whereBetween('loans.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','گرفته')->sum('loans.quantity_loan');
            $purchase_loan_price_af = Loan::join('purchases','purchases.id','loans.purchase_id')->where('purchases.currency','افغانی')->whereBetween('loans.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','گرفته')->sum('loans.quantity_loan');
            // Payments
            $receipt_price_doller = Loan::join('purchases','purchases.id','loans.purchase_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('purchases.currency','دالر')->whereBetween('payments.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','گرفته')->sum('payments.pay_quantity');
            $receipt_price_af = Loan::join('purchases','purchases.id','loans.purchase_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('purchases.currency','افغانی')->whereBetween('payments.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','گرفته')->sum('payments.pay_quantity');
   

         // Bills
         $bill_goods =Bills::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('quantity_goods');
         $bill_price_doller = Bills::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('currency','دالر')->sum('total_price');
         $bill_price_af = Bills::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('currency','افغانی')->sum('total_price');
         // Bills Loans
        
            $loan_price_doller = Loan::join('bills','bills.id','bill_id')->where('bills.currency','دالر')->whereBetween('loans.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','داده')->sum('loans.quantity_loan');
            $loan_price_af = Loan::join('bills','bills.id','bill_id')->where('bills.currency','افغانی')->whereBetween('loans.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','داده')->sum('loans.quantity_loan');
            // Payments
            $payment_price_doller = Loan::join('bills','bills.id','bill_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('bills.currency','دالر')->whereBetween('payments.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','داده')->sum('payments.pay_quantity');
            $payment_price_af = Loan::join('bills','bills.id','bill_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('bills.currency','افغانی')->whereBetween('payments.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('loans.status','داده')->sum('payments.pay_quantity');
 
        // Financial
        $employee_salary =EmployeeSalary::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('salary_quantity');
        $rent =Rent::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('money_quantity');
        $financialExpenses =FinancialExpenses::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('money_quantity');
        

        return view('dashboard.all-reports.monthlyReport',compact('purchase_goods','purchase_price_doller','purchase_price_af',
                                                                 'purchase_loan_price_doller','purchase_loan_price_af',
                                                                 'receipt_price_doller','receipt_price_af',
                                                                 'bill_goods','bill_price_doller','bill_price_af',
                                                                 'loan_price_doller','loan_price_af',
                                                                 'payment_price_doller','payment_price_af',
                                                                 'company','customer','purchase','bill',
                                                                'employee_salary','rent','financialExpenses'));
    }

    public function yearlyReport()
    {

        // General
        $company = Companies::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        $customer = Customers::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        $purchase = Purchases::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        $bill = Bills::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        
        
        // Purchases
        $purchase_goods = Purchases::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('quantity_goods');
        $purchase_price_doller = Purchases::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('currency','دالر')->sum('total_price');
        $purchase_price_af = Purchases::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('currency','افغانی')->sum('total_price');
            // Bills Loans
            $purchase_loan_price_doller = Loan::join('purchases','purchases.id','loans.purchase_id')->where('purchases.currency','دالر')->whereBetween('loans.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','گرفته')->sum('loans.quantity_loan');
            $purchase_loan_price_af = Loan::join('purchases','purchases.id','loans.purchase_id')->where('purchases.currency','افغانی')->whereBetween('loans.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','گرفته')->sum('loans.quantity_loan');
            // Payments
            $receipt_price_doller = Loan::join('purchases','purchases.id','loans.purchase_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('purchases.currency','دالر')->whereBetween('payments.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','گرفته')->sum('payments.pay_quantity');
            $receipt_price_af = Loan::join('purchases','purchases.id','loans.purchase_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('purchases.currency','افغانی')->whereBetween('payments.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','گرفته')->sum('payments.pay_quantity');
    

        // Bills
        $bill_goods =Bills::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('quantity_goods');
        $bill_price_doller = Bills::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('currency','دالر')->sum('total_price');
        $bill_price_af = Bills::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('currency','افغانی')->sum('total_price');
        // Bills Loans
        
            $loan_price_doller = Loan::join('bills','bills.id','bill_id')->where('bills.currency','دالر')->whereBetween('loans.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','داده')->sum('loans.quantity_loan');
            $loan_price_af = Loan::join('bills','bills.id','bill_id')->where('bills.currency','افغانی')->whereBetween('loans.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','داده')->sum('loans.quantity_loan');
            // Payments
            $payment_price_doller = Loan::join('bills','bills.id','bill_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('bills.currency','دالر')->whereBetween('payments.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','داده')->sum('payments.pay_quantity');
            $payment_price_af = Loan::join('bills','bills.id','bill_id')
            ->join('payments','payments.loan_id','loans.id')
            ->where('bills.currency','افغانی')->whereBetween('payments.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('loans.status','داده')->sum('payments.pay_quantity');

        // Financial
        $employee_salary =EmployeeSalary::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('salary_quantity');
        $rent =Rent::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('money_quantity');
        $financialExpenses =FinancialExpenses::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('money_quantity');
        

        return view('dashboard.all-reports.yearlyReport',compact('purchase_goods','purchase_price_doller','purchase_price_af',
                                                                'purchase_loan_price_doller','purchase_loan_price_af',
                                                                'receipt_price_doller','receipt_price_af',
                                                                'bill_goods','bill_price_doller','bill_price_af',
                                                                'loan_price_doller','loan_price_af',
                                                                'payment_price_doller','payment_price_af',
                                                                'company','customer','purchase','bill',
                                                                'employee_salary','rent','financialExpenses'));
    }


    public function publicReport()
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
        
        return view('dashboard.all-reports.publicReport',compact('purchase_loan_price_doller','purchase_loan_price_af',
                                                                'loan_price_doller','loan_price_af',
                                                                'company','customer','goods','employees'));
    }

}
