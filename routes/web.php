<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BillingStatusController;
use App\Http\Controllers\BillPaymentController;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserTypeController;



use App\Http\Controllers\StaffAreaController;
use App\Http\Controllers\PaymentDueController;

use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\ProjectItemController;
use App\Http\Controllers\BillGenerateController;
use App\Http\Controllers\LineCategoryController;

use App\Http\Controllers\ProductBrandController;




use App\Http\Controllers\BillMultiMonthController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\PaymentOptionController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\ProductCategoryController;



use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\UnitMeasurementController;

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

Route::get('/', function () {
    return view('backend.dashboard');
})->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


// admin dashboard
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


// user
Route::get('/all-user', [UserController::class, 'index'])->name('all-user');
Route::get('/all-admin', [UserController::class, 'all_admin'])->name('all_admin');
Route::get('/create-user', [UserController::class, 'create'])->name('create-user');
Route::post('/store-user/{id}', [UserController::class, 'store'])->name('store-user');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update-user');
Route::get('/destroy-user/{id}', [UserController::class, 'destroy'])->name('destroy-user');
Route::get('/deactive-user/{id}', [UserController::class, 'deactive'])->name('deactive-user');
Route::get('/active-user/{id}', [UserController::class, 'active'])->name('active-user');
Route::post('/get/type/id', [UserController::class, 'getTypeId_ajax'])->name('getTypeId_ajax');


// staff
Route::get('/all-staff', [StaffController::class, 'index'])->name('all-staff');
Route::get('/create-staff', [StaffController::class, 'create'])->name('create-staff');
Route::post('/store-staff', [StaffController::class, 'store'])->name('store-staff');
Route::get('/edit-staff/{id}', [StaffController::class, 'edit'])->name('edit-staff');
Route::post('/update-staff/{id}', [StaffController::class, 'update'])->name('update-staff');
Route::get('/destroy-staff/{id}', [StaffController::class, 'destroy'])->name('destroy-staff');
Route::get('/deactive-staff/{id}', [StaffController::class, 'deactive'])->name('deactive-staff');
Route::get('/active-staff/{id}', [StaffController::class, 'active'])->name('active-staff');

// area-setting
Route::get('/all-area', [AreaController::class, 'index'])->name('all-area');
Route::get('/create-area', [AreaController::class, 'create'])->name('create-area');
Route::post('/store-area', [AreaController::class, 'store'])->name('store-area');
Route::get('/edit-area/{id}', [AreaController::class, 'edit'])->name('edit-area');
Route::post('/update-area/{id}', [AreaController::class, 'update'])->name('update-area');
Route::get('/destroy-area/{id}', [AreaController::class, 'destroy'])->name('destroy-area');
Route::get('/deactive-area/{id}', [AreaController::class, 'deactive'])->name('deactive-area');
Route::get('/active-area/{id}', [AreaController::class, 'active'])->name('active-area');

// line-category
Route::get('/all-line-category', [LineCategoryController::class, 'index'])->name('all-line-category');
Route::get('/create-line-category', [LineCategoryController::class, 'create'])->name('create-line-category');
Route::post('/store-line-category', [LineCategoryController::class, 'store'])->name('store-line-category');
Route::get('/edit-line-category/{id}', [LineCategoryController::class, 'edit'])->name('edit-line-category');
Route::post('/update-line-category/{id}', [LineCategoryController::class, 'update'])->name('update-line-category');
Route::get('/destroy-line-category/{id}', [LineCategoryController::class, 'destroy'])->name('destroy-line-category');
Route::get('/deactive-line-category/{id}', [LineCategoryController::class, 'deactive'])->name('deactive-line-category');
Route::get('/active-line-category/{id}', [LineCategoryController::class, 'active'])->name('active-line-category');

// payment-option
Route::get('/all-payment-option', [PaymentOptionController::class, 'index'])->name('all-payment-option');
Route::get('/create-payment-option', [PaymentOptionController::class, 'create'])->name('create-payment-option');
Route::post('/store-payment-option', [PaymentOptionController::class, 'store'])->name('store-payment-option');
Route::get('/edit-payment-option/{id}', [PaymentOptionController::class, 'edit'])->name('edit-payment-option');
Route::post('/update-payment-option/{id}', [PaymentOptionController::class, 'update'])->name('update-payment-option');
Route::get('/destroy-payment-option/{id}', [PaymentOptionController::class, 'destroy'])->name('destroy-payment-option');
Route::get('/deactive-payment-option/{id}', [PaymentOptionController::class, 'deactive'])->name('deactive-payment-option');
Route::get('/active-payment-option/{id}', [PaymentOptionController::class, 'active'])->name('active-payment-option');

// transaction-type
Route::get('/all-transaction-type', [TransactionTypeController::class, 'index'])->name('all-transaction-type');
Route::get('/create-transaction-type', [TransactionTypeController::class, 'create'])->name('create-transaction-type');
Route::post('/store-transaction-type', [TransactionTypeController::class, 'store'])->name('store-transaction-type');
Route::get('/edit-transaction-type/{id}', [TransactionTypeController::class, 'edit'])->name('edit-transaction-type');
Route::post('/update-transaction-type/{id}', [TransactionTypeController::class, 'update'])->name('update-transaction-type');
Route::get('/destroy-transaction-type/{id}', [TransactionTypeController::class, 'destroy'])->name('destroy-transaction-type');
Route::get('/deactive-transaction-type/{id}', [TransactionTypeController::class, 'deactive'])->name('deactive-transaction-type');
Route::get('/active-transaction-type/{id}', [TransactionTypeController::class, 'active'])->name('active-transaction-type');


// customer
Route::get('/all-customer', [CustomerController::class, 'index'])->name('all-customer');
Route::get('/create-customer', [CustomerController::class, 'create'])->name('create-customer');
Route::post('/store-customer', [CustomerController::class, 'store'])->name('store-customer');
Route::get('/edit-customer/{id}', [CustomerController::class, 'edit'])->name('edit-customer');
Route::post('/update-customer/{id}', [CustomerController::class, 'update'])->name('update-customer');
Route::get('/destroy-customer/{id}', [CustomerController::class, 'destroy'])->name('destroy-customer');
Route::get('/deactive-customer/{id}', [CustomerController::class, 'deactive'])->name('deactive-customer');
Route::get('/active-customer/{id}', [CustomerController::class, 'active'])->name('active-customer');
Route::get('/active-all-customer', [CustomerController::class, 'active_customer'])->name('active-all-customer');
Route::get('/inactive-all-customer', [CustomerController::class, 'inactive_customer'])->name('inactive-all-customer');
Route::get('/customer-transaction/{id}', [CustomerController::class, 'transaction'])->name('customer-transaction');
// customer for staff
Route::get('/active-all-customer/staff/{id}', [CustomerController::class, 'active_customer_staff'])->name('active-all-customer-staff');
Route::get('/inactive-all-customer/staff/{id}', [CustomerController::class, 'inactive_customer_staff'])->name('inactive-all-customer-staff');
// customer search
Route::get('active/customer/search', [CustomerController::class, 'active_customer_search'])->name('active_customer_search');
Route::get('inactive/customer/search', [CustomerController::class, 'inactive_customer_search'])->name('inactive_customer_search');














// company-info
Route::get('/all-company-info', [CompanyInfoController::class, 'index'])->name('all-company-info');
Route::post('/all-company-info', [CompanyInfoController::class, 'store'])->name('store-company-info');






// Generate Bill
Route::get('/all-bill-generate', [BillGenerateController::class, 'index'])->name('all-bill-generate');
Route::get('/all-bill-generate-get', [BillGenerateController::class, 'index'])->name('all-bill-generate-get');
Route::post('/store-bill-generate', [BillGenerateController::class, 'store'])->name('store-bill-generate');
Route::post('/get/generate/data', [BillGenerateController::class, 'getGenerate_ajax'])->name('getGenerate_ajax');







/*
|--------------------------------------------------------------------------
| BillMultiMonthController
|--------------------------------------------------------------------------
*/
Route::get('/all-bill-month-wise', [BillMultiMonthController::class, 'index'])->name('all-bill-month-wise');
Route::get('/all-bill-month-wise-get', [BillMultiMonthController::class, 'index'])->name('all-bill-month-wise-get');
Route::post('/multipleupdate-bill-month-wise', [BillMultiMonthController::class, 'multiple_bill_update'])->name('multipleupdate-bill-month-wise');
Route::get('/create-bill-month-wise', [BillMultiMonthController::class, 'create'])->name('create-bill-month-wise');
Route::post('/store-bill-month-wise', [BillMultiMonthController::class, 'store'])->name('store-bill-month-wise');
Route::get('/view-bill-month-wise', [BillMultiMonthController::class, 'view_bill'])->name('view-bill-month-wise');
Route::get('/view-bill-month-wise-get', [BillMultiMonthController::class, 'view_bill'])->name('view-bill-month-wise-get');
Route::get('/single_destroy-bill-month-wise/{id}', [BillMultiMonthController::class, 'single_destroy'])->name('single_destroy-bill-month-wise');
Route::get('/destroy_all-bill-month-wise', [BillMultiMonthController::class, 'destroy_all'])->name('destroy_all-bill-month-wise');
    // ajax methods For [Bill Multi Month wise]
Route::post('/get/id/data', [BillMultiMonthController::class, 'getID_ajax'])->name('getID_ajax');
Route::post('/get/paid/id/data', [BillMultiMonthController::class, 'getPaidID_ajax'])->name('getPaidID_ajax');
Route::post('/get/customer/name', [BillMultiMonthController::class, 'getName_ajax'])->name('getName_ajax');
Route::post('/get/customer/details', [BillMultiMonthController::class, 'getCustomerDetails_ajax'])->name('getCustomerDetails_ajax');
Route::post('/get/payment/amount', [BillMultiMonthController::class, 'getPaymentAmount_ajax'])->name('getPaymentAmount_ajax');
Route::post('/get/payment/amounts', [BillMultiMonthController::class, 'getPaymentAmounts_ajax'])->name('getPaymentAmounts_ajax');
Route::post('/get/month/id', [BillMultiMonthController::class, 'getMonthId_ajax'])->name('getMonthId_ajax');










/*
|--------------------------------------------------------------------------
| BillPaymentController
|--------------------------------------------------------------------------
*/
Route::get('/view-all-paid-bill-payment', [BillPaymentController::class, 'view_all_paid_bill'])->name('view-all-paid-bill-payment');
Route::get('/view-all-due-bill-payment', [BillPaymentController::class, 'view_all_due_bill'])->name('view-all-due-bill-payment');
Route::get('/destroy-payment/{id}', [BillPaymentController::class, 'destroy_payment'])->name('destroy-payment');
Route::get('/paid_search_bill_payment', [BillPaymentController::class, 'paid_search_bill_payment'])->name('paid_search_bill_payment');
Route::get('/due_search_bill_payment', [BillPaymentController::class, 'due_search_bill_payment'])->name('due_search_bill_payment');
Route::get('/make/voucher/{id}', [BillPaymentController::class, 'make_voucher'])->name('make_voucher');
Route::get('/edit-payment/{id}', [BillPaymentController::class, 'edit_payment'])->name('edit_payment');
Route::post('/update-payment/{id}', [BillPaymentController::class, 'update_payment'])->name('update-bill-payment');


// Billing Status
Route::get('/all-bill-status', [BillingStatusController::class, 'index'])->name('all-bill-status');
Route::get('/all-bill-status-get', [BillingStatusController::class, 'index'])->name('all-bill-status-get');









// Billing Report
Route::get('/all-bill-report', [DailyReportController::class, 'index'])->name('all-bill-report');
Route::get('/all-bill-report-get', [DailyReportController::class, 'index'])->name('all-bill-report-get');











// Line Payment Due paid
Route::get('/all-bill-payment-due', [PaymentDueController::class, 'index'])->name('all-bill-payment-due');
Route::get('/create-bill-payment-due', [PaymentDueController::class, 'create'])->name('create-bill-payment-due');
Route::post('/store-bill-payment-due', [PaymentDueController::class, 'store'])->name('store-bill-payment-due');
Route::get('/edit-bill-payment-due/{id}', [PaymentDueController::class, 'edit'])->name('edit-bill-payment-due');
Route::post('/update-bill-payment-due/{id}', [PaymentDueController::class, 'update'])->name('update-bill-payment-due');
Route::get('/destroy-bill-payment-due/{id}', [PaymentDueController::class, 'destroy'])->name('destroy-bill-payment-due');
Route::get('/deactive-bill-payment-due/{id}', [PaymentDueController::class, 'deactive'])->name('deactive-bill-payment-due');
Route::get('/active-bill-payment-due/{id}', [PaymentDueController::class, 'active'])->name('active-bill-payment-due');




// // category
// Route::get('/all-category', [CategoryController::class, 'index'])->name('all-category');
// Route::get('/create-category', [CategoryController::class, 'create'])->name('create-category');
// Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');
// Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
// Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
// Route::get('/destroy-category/{id}', [CategoryController::class, 'destroy'])->name('destroy-category');
// Route::get('/deactive-category/{id}', [CategoryController::class, 'deactive'])->name('deactive-category');
// Route::get('/active-category/{id}', [CategoryController::class, 'active'])->name('active-category');


// // staff-area
// Route::get('/all-staff-area', [StaffAreaController::class, 'index'])->name('all-staff-area');
// Route::get('/create-staff-area', [StaffAreaController::class, 'create'])->name('create-staff-area');
// Route::post('/store-staff-area', [StaffAreaController::class, 'store'])->name('store-staff-area');
// Route::get('/edit-staff-area/{id}', [StaffAreaController::class, 'edit'])->name('edit-staff-area');
// Route::post('/update-staff-area/{id}', [StaffAreaController::class, 'update'])->name('update-staff-area');
// Route::get('/destroy-staff-area/{id}', [StaffAreaController::class, 'destroy'])->name('destroy-staff-area');
// Route::get('/deactive-staff-area/{id}', [StaffAreaController::class, 'deactive'])->name('deactive-staff-area');
// Route::get('/active-staff-area/{id}', [StaffAreaController::class, 'active'])->name('active-staff-area');






// // account
// Route::get('/all-account', [AccountController::class, 'index'])->name('all-account');
// Route::get('/create-account', [AccountController::class, 'create'])->name('create-account');
// Route::post('/store-account', [AccountController::class, 'store'])->name('store-account');
// Route::get('/edit-account/{id}', [AccountController::class, 'edit'])->name('edit-account');
// Route::post('/update-account/{id}', [AccountController::class, 'update'])->name('update-account');
// Route::get('/destroy-account/{id}', [AccountController::class, 'destroy'])->name('destroy-account');
// Route::get('/deactive-account/{id}', [AccountController::class, 'deactive'])->name('deactive-account');
// Route::get('/active-account/{id}', [AccountController::class, 'active'])->name('active-account');







// // address
// Route::get('/all-address', [AddressController::class, 'index'])->name('all-address');
// Route::get('/create-address', [AddressController::class, 'create'])->name('create-address');
// Route::post('/store-address', [AddressController::class, 'store'])->name('store-address');
// Route::get('/edit-address/{id}', [AddressController::class, 'edit'])->name('edit-address');
// Route::post('/update-address/{id}', [AddressController::class, 'update'])->name('update-address');
// Route::get('/destroy-address/{id}', [AddressController::class, 'destroy'])->name('destroy-address');
// Route::get('/deactive-address/{id}', [AddressController::class, 'deactive'])->name('deactive-address');
// Route::get('/active-address/{id}', [AddressController::class, 'active'])->name('active-address');









// // client
// Route::get('/all-client', [ClientController::class, 'index'])->name('all-client');
// Route::get('/create-client', [ClientController::class, 'create'])->name('create-client');
// Route::post('/store-client', [ClientController::class, 'store'])->name('store-client');
// Route::get('/edit-client/{id}', [ClientController::class, 'edit'])->name('edit-client');
// Route::post('/update-client/{id}', [ClientController::class, 'update'])->name('update-client');
// Route::get('/destroy-client/{id}', [ClientController::class, 'destroy'])->name('destroy-client');
// Route::get('/deactive-client/{id}', [ClientController::class, 'deactive'])->name('deactive-client');
// Route::get('/active-client/{id}', [ClientController::class, 'active'])->name('active-client');








// project-item
// Route::get('/all-project-item', [ProjectItemController::class, 'index'])->name('all-project-item');
// Route::get('/create-project-item', [ProjectItemController::class, 'create'])->name('create-project-item');
// Route::post('/store-project-item', [ProjectItemController::class, 'store'])->name('store-project-item');
// Route::get('/edit-project-item/{id}', [ProjectItemController::class, 'edit'])->name('edit-project-item');
// Route::post('/update-client/{id}', [ProjectItemController::class, 'update'])->name('update-project-item');
// Route::get('/destroy-project-item/{id}', [ProjectItemController::class, 'destroy'])->name('destroy-project-item');
// Route::get('/deactive-project-item/{id}', [ProjectItemController::class, 'deactive'])->name('deactive-project-item');
// Route::get('/active-project-item/{id}', [ProjectItemController::class, 'active'])->name('active-project-item');










// // user-type
// Route::get('/all-user-type', [UserTypeController::class, 'index'])->name('all-user-type');
// Route::get('/create-user-type', [UserTypeController::class, 'create'])->name('create-user-type');
// Route::post('/store-user-type', [UserTypeController::class, 'store'])->name('store-user-type');
// Route::get('/edit-user-type/{id}', [UserTypeController::class, 'edit'])->name('edit-user-type');
// Route::post('/update-user-type/{id}', [UserTypeController::class, 'update'])->name('update-user-type');
// Route::get('/destroy-user-type/{id}', [UserTypeController::class, 'destroy'])->name('destroy-user-type');
// Route::get('/deactive-user-type/{id}', [UserTypeController::class, 'deactive'])->name('deactive-user-type');
// Route::get('/active-user-type/{id}', [UserTypeController::class, 'active'])->name('active-user-type');









// // unit-measurement
// Route::get('/all-unit-measurement', [UnitMeasurementController::class, 'index'])->name('all-unit-measurement');
// Route::get('/create-unit-measurement', [UnitMeasurementController::class, 'create'])->name('create-unit-measurement');
// Route::post('/store-unit-measurement', [UnitMeasurementController::class, 'store'])->name('store-unit-measurement');
// Route::get('/edit-unit-measurement/{id}', [UnitMeasurementController::class, 'edit'])->name('edit-unit-measurement');
// Route::post('/update-unit-measurement/{id}', [UnitMeasurementController::class, 'update'])->name('update-unit-measurement');
// Route::get('/destroy-unit-measurement/{id}', [UnitMeasurementController::class, 'destroy'])->name('destroy-unit-measurement');
// Route::get('/deactive-unit-measurement/{id}', [UnitMeasurementController::class, 'deactive'])->name('deactive-unit-measurement');
// Route::get('/active-unit-measurement/{id}', [UnitMeasurementController::class, 'active'])->name('active-unit-measurement');











// // product-brand
// Route::get('/all-product-brand', [ProductBrandController::class, 'index'])->name('all-product-brand');
// Route::get('/create-product-brand', [ProductBrandController::class, 'create'])->name('create-product-brand');
// Route::post('/store-product-brand', [ProductBrandController::class, 'store'])->name('store-product-brand');
// Route::get('/edit-product-brand/{id}', [ProductBrandController::class, 'edit'])->name('edit-product-brand');
// Route::post('/update-product-brand/{id}', [ProductBrandController::class, 'update'])->name('update-product-brand');
// Route::get('/destroy-product-brand/{id}', [ProductBrandController::class, 'destroy'])->name('destroy-product-brand');
// Route::get('/deactive-product-brand/{id}', [ProductBrandController::class, 'deactive'])->name('deactive-product-brand');
// Route::get('/active-product-brand/{id}', [ProductBrandController::class, 'active'])->name('active-product-brand');








// // product-category
// Route::get('/all-product-category', [ProductCategoryController::class, 'index'])->name('all-product-category');
// Route::get('/create-product-category', [ProductCategoryController::class, 'create'])->name('create-product-category');
// Route::post('/store-product-category', [ProductCategoryController::class, 'store'])->name('store-product-category');
// Route::get('/edit-product-category/{id}', [ProductCategoryController::class, 'edit'])->name('edit-product-category');
// Route::post('/update-product-category/{id}', [ProductCategoryController::class, 'update'])->name('update-product-category');
// Route::get('/destroy-product-category/{id}', [ProductCategoryController::class, 'destroy'])->name('destroy-product-category');
// Route::get('/deactive-product-category/{id}', [ProductCategoryController::class, 'deactive'])->name('deactive-product-category');
// Route::get('/active-product-category/{id}', [ProductCategoryController::class, 'active'])->name('active-product-category');










// // terms-condition
// Route::get('/all-terms-condition', [TermsConditionController::class, 'index'])->name('all-terms-condition');
// Route::post('/all-terms-condition', [TermsConditionController::class, 'store'])->name('store-terms-condition');


