<?php

use Illuminate\Support\Facades\Route;

use App\Models\GoodsCategory;

use App\Models\Purchases;
use App\Models\Goods;
use App\Models\PurchaseDocument;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::middleware(['auth:sanctum', 'verified'])->get('/jetstream-dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::get('/test', function () {
    return view('dashboard.test');
});

Route::get('/index', function () {
    return view('dashboard.index');
});




// Auth Route
Route::group(['middleware' => 'auth:sanctum','verified'], function () {
    Route::group(['middleware' => ['verified']], function () {

    
        // Dashoard
        Route::get('dashboard','dashboard\DashboardController@index');
        Route::get('/','dashboard\DashboardController@index');



        // Employees
        Route::resource('employees', dashboard\EmployeesController::class);
        Route::get('employees/update/{id}','dashboard\EmployeesController@show');
        Route::post('employees/reset_password','dashboard\EmployeesController@resetPassword');
        Route::get('employees/profile/{id}','dashboard\EmployeesController@profile');

        // Customers
        Route::resource('customers', dashboard\CustomersController::class);
        Route::post('customers_update','dashboard\CustomersController@update');
        Route::get('customers/info/{id?}','dashboard\CustomersController@info')->name('customerInfo');
        Route::post('change_photo','dashboard\CustomersController@changePhoto');

        // Goods
        Route::resource('goods', dashboard\GoodsController::class);
        Route::post('goods_update','dashboard\GoodsController@update');

        // Goods Category
        Route::resource('goods_category', dashboard\GoodsCategoryController::class);
        Route::post('goodsCategory_update','dashboard\GoodsCategoryController@update');

        // Companies
        Route::resource('companies', dashboard\CompaniesController::class);
        Route::post('companies_update','dashboard\CompaniesController@update');
        Route::get('companies/info/{id?}','dashboard\CompaniesController@info');
        
        // Purchases
        Route::resource('purchases', dashboard\PurchasesController::class);
        Route::post('purchase_update','dashboard\PurchasesController@update');
        Route::get('purchases/info-item/{id?}','dashboard\PurchasesController@infoItem');

        // Purchase Documents
        Route::resource('purchase_documents', dashboard\PurchaseDocumentController::class);
        Route::post('purchase_documents_update','dashboard\PurchaseDocumentController@update');

        //--- Stock
        Route::resource('stock', dashboard\StockController::class);
        Route::post('stock_update','dashboard\StockController@update');

        // Stock Out
        Route::resource('stock_out', dashboard\StockHistoryController::class);
        Route::post('stock_out_update','dashboard\StockHistoryController@update');
        Route::get('stock_out/{goods_id?}/get_quantity','dashboard\StockHistoryController@getQuantity');

        
        // Employee Salary
        Route::resource('employees_salary', dashboard\EmployeeSalaryController::class);
        Route::post('employees_salary_update','dashboard\EmployeeSalaryController@update');

        // Financial Expenses
        Route::resource('financial_expenses', dashboard\FinancialExpensesController::class);
        Route::post('financial_expenses_update','dashboard\FinancialExpensesController@update');

        // Financial Expenses
        Route::resource('rent', dashboard\RentController::class);
        Route::post('rent_update','dashboard\RentController@update');


        // Bills
        Route::get('bills/add_bill', 'dashboard\BillsController@create');
        Route::get('bills/incomplate_bill', 'dashboard\BillsController@incomplateBill');
        Route::get('bills/info_bill/{id?}', 'dashboard\BillsController@infoBill');
        Route::get('bills/incomplate_bill/{id?}', 'dashboard\BillsController@inComplateBills');
        Route::get('bills/update/{id?}', 'dashboard\BillsController@updateBill');
        Route::resource('bills', dashboard\BillsController::class);
        Route::post('create_customer','dashboard\BillsController@CreateCustomer');
        Route::post('bill_details','dashboard\BillsController@billDetails');

        Route::post('incomplate_bill_details','dashboard\BillsController@inComplatebillDetails');
        
        Route::post('update_bill_details','dashboard\BillsController@updateBillDetails');
        Route::post('update_customer','dashboard\BillsController@updateCustomers');
        Route::delete('delete_all_bills','dashboard\BillsController@deleteAllBills');
        Route::delete('delete_bill/{id}','dashboard\BillsController@deleteBill');
        
        // Bill Documents
        Route::resource('bill_documents', dashboard\BillDocumentsController::class);
        Route::post('bill_documents_update','dashboard\BillDocumentsController@update');
        Route::get('bill_documents/get_goods/{id?}','dashboard\BillDocumentsController@getGoods');
        Route::get('bill_documents/update_get_goods/{id?}/{myid}','dashboard\BillDocumentsController@UpdategetGoods');
        // bill Document Edit
        Route::post('edit_bill_documents','dashboard\BillDocumentsController@editStore');
        Route::post('edit_bill_documents_update','dashboard\BillDocumentsController@editUpdate');
        Route::delete('delete_bill_documents/{id}','dashboard\BillDocumentsController@deleteBillDocuments');

        

        // Sales
        Route::resource('sales', dashboard\SalesController::class);

        // Loan
        Route::get('loan/get_loan','dashboard\LoanController@getLoan');
        Route::get('loan/give_loan','dashboard\LoanController@giveLoan');
        Route::resource('loans', dashboard\LoanController::class);

         // Payments
         Route::resource('payments', dashboard\PaymentsController::class);
         Route::post('payments_update','dashboard\PaymentsController@update');
         route::get('payments/get_loan_quantity/{id}','dashboard\PaymentsController@loanQuantity');
         route::get('payments/get_loan_quantity/{loan_id}/edit/{payment}','dashboard\PaymentsController@loanQuantityUpdate');
         route::get('payments/get_loans/all','dashboard\PaymentsController@allLoan');
         route::get('payments/get_loans/all_update/{id}','dashboard\PaymentsController@allLoanUpdate');


         // Receipts
         Route::resource('receipts', dashboard\ReceiptsController::class);
         Route::post('receipts_update','dashboard\ReceiptsController@update');
         route::get('receipts/get_loan_quantity/{id}','dashboard\ReceiptsController@loanQuantity');
         route::get('receipts/get_loan_quantity/{loan_id}/edit/{payment}','dashboard\ReceiptsController@loanQuantityUpdate');
         route::get('receipts/get_loans/all','dashboard\ReceiptsController@allLoan');
         route::get('receipts/get_loans/all_update/{id}','dashboard\ReceiptsController@allLoanUpdate');
         
         // Profile
        Route::get('profile','dashboard\ProfileController@index');
        Route::post('profile/reset_password','dashboard\ProfileController@resetPassword');
        Route::post('profile/general_update','dashboard\ProfileController@generalUpdate');
        Route::post('profile/change_photo','dashboard\ProfileController@changePhoto');
        Route::delete('profile/delete_photo/{id}','dashboard\ProfileController@deletePhoto');

        // Activity Log
        Route::get('activity_log','dashboard\ActivityLogController@index');

        // Reports
        Route::get('reports/weekly_report','dashboard\ReportsController@weeklyReport');
        Route::get('reports/monthly_report','dashboard\ReportsController@monthlyReport');
        Route::get('reports/yearly_report','dashboard\ReportsController@yearlyReport');
        Route::get('reports/public_report','dashboard\ReportsController@publicReport');



        
        


        


    });
});