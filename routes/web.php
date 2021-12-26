<?php

use App\Http\Controllers\Auth\TwoFactorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CustomerProfileRequestController, Department\CS\NewCustomerController};
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

Route::view('/', 'welcome')->name('welcome');
Route::get('/test-event', function(){
    event(new \App\Events\MyTestEvent('Shavindu'));
});
Auth::routes();
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
Route::resource('verify',TwoFactorController::class)->only(['index', 'store']);
Route::group(['middleware' => ['auth', 'twofactor'],'namespace'=>'App\Http\Controllers'],function(){
    Route::group(['namespace'=>'Admin', 'prefix'=>'admin'],function(){

        //Permission
        Route::resource('permission','PermissionController');
        Route::get('permission/delete/{id}','PermissionController@delete')->name('permission.delete');

        //Role
        Route::resource('role','RoleController');
        Route::get('role/delete/{id}','RoleController@delete')->name('role.delete');

        //User
        Route::resource('user','UserController');
        Route::put('user/update-profile/{id}', 'UserController@updateProfile')->name('user.updateProfile');
        Route::put('user/update-password/{id}', 'UserController@updatePassword')->name('user.updatePassword');
        Route::get('user/profile-change/{id}', 'UserController@changeProfile')->name('user.changeProfile');
        Route::get('user/delete/{id}','UserController@delete')->name('user.delete');


        //Customer
        Route::resource('customer','CustomerController')->except('edit');
        Route::get('customer/delete/{id}','CustomerController@delete')->name('customer.delete');

        //Customer Request Info
        Route::resource('customer-profile-request','CustomerProfileRequestController')->only('index', 'show', 'update');

        //Department
        Route::resource('department','DepartmentController');
        Route::get('department/delete/{id}','DepartmentController@delete')->name('department.delete');

        //Designation
        Route::resource('designation','DesignationController');
        Route::get('designation/delete/{id}','DesignationController@delete')->name('designation.delete');

        //Employee
        Route::resource('employee','EmployeeController');
        Route::get('employee/delete/{id}','DesignationController@delete')->name('employee.delete');

        //Orders
        Route::resource('order','OrderController');
        Route::get('order/cs/confirmation/{id}','OrderController@cs_confirmation_view')->name('order.cs.confirmation');
        Route::get('order/cs/confirm/{id}','OrderController@cs_confirmation')->name('order.cs.confirm');
        Route::get('order/cs/concerns','OrderController@concerns')->name('order.concerns');

        //Statuses
        Route::resource('status','StatusController');
        Route::get('status/delete/{id}','StatusController@delete')->name('status.delete');

        //Errors
        Route::get('error/index', 'ErrorController@index')->name('error.index');
        Route::get('error/delete-all', 'ErrorController@deleteAll')->name('error.deleteall');

        //Priority types
        Route::resource('prioritytype','PriorityTypeController');
        Route::get('prioritytype/delete/{id}','PriorityTypeController@delete')->name('prioritytype.delete');
        //Label

            //Type
        Route::resource('labeltype','LabelTypeController');
        Route::get('label/type/delete/{id}','LabelTypeController@delete')->name('labeltype.delete');

            //Style
        Route::resource('labelstyle','LabelStyleController');
        Route::get('label/style/delete/{id}','LabelStyleController@delete')->name('labelstyle.delete');

            //Sizes
        Route::resource('labelsize','LabelSizeController');
        Route::get('label/size/delete/{id}','LabelSizeController@delete')->name('labelsize.delete');

        //Dashboard
        Route::get('dashboard','DashboardController@index')->name('dashboard.index');
        Route::get('dashboard/my-jobs','DashboardController@myjobs')->name('dashboard.myjobs');

        //Reports
        Route::group(['namespace'=>'Report', 'prefix'=>'report'],function() {
            Route::get('orders/export/{id}', 'OrderController@export')->name('orders.export');
        });
    });

    Route::group(['namespace'=>'Department','prefix'=>'department'],function(){
        //Planning
        Route::group(['namespace'=>'Planning','prefix'=>'planning'],function(){
            Route::get('planning','PlanningController@index')->name('planning.index');
            Route::get('planning/board','PlanningController@planningBoard')->name('planning.board');
            Route::get('planning/scan', 'PlanningController@scanView')->name('planning.scan.view');
            Route::put('planning/{id}','PlanningController@priorityUpdate')->name('planning.scanUpdate');
            Route::post('planning','PlanningController@scan')->name('planning.scan');
        });

        //Manufacturing
        Route::group(['namespace'=>'Manufacturing','prefix'=>'manufacturing'],function(){
            Route::post('manufacturing','ManufacturingController@scan')->name('manufacturing.scan');
            Route::get('manufacturing/scan', 'ManufacturingController@scanView')->name('manufacturing.scan.view');
            Route::get('manufacturing/mr', 'ManufacturingController@mrIndex')->name('manufacturing.mrindex');
            Route::resource('smart_production', 'SmartProductionController');
        });

        //QA
        Route::group(['namespace'=>'QA','prefix'=>'qa'],function(){
            Route::post('qa','QAController@scan')->name('qa.scan');
            Route::get('qa/scan', 'QAController@scanView')->name('qa.scan.view');
        });

        //Dispatch
        Route::group(['namespace'=>'Dispatch','prefix'=>'dispatch'],function(){
            Route::post('dispatch','DispatchController@scan')->name('dispatch.scan');
            Route::get('dispatch/scan', 'DispatchController@scanView')->name('dispatch.scan.view');
            Route::post('dispatch/scandone','DispatchController@scanDone')->name('dispatch.scandone');
            Route::get('dispatch/scandone/view','DispatchController@scanDoneView')->name('dispatch.scandoneview');
        });

        //Customer Service
        Route::group(['namespace'=>'CS','prefix'=>'cs'],function(){
            Route::resource('new_customer', 'NewCustomerController')->except('edit', 'destroy');
        });

        //Stores - include suppliers, materials, metrics, transactions, request logs
        Route::group(['namespace'=>'Store','prefix'=>'store'],function(){

            //Supplier
            Route::group(['namespace' => 'Supplier', 'prefix' => 'supplier'], function (){
                Route::resource('supplier','SupplierController');
                Route::get('supplier/delete/{id}','SupplierController@delete')->name('supplier.delete');
            });

            // Material
            Route::group(['namespace' => 'Material'], function() {
                Route::resource('material','MaterialController');
                Route::get('material/delete/{id}','MaterialController@delete')->name('material.delete');

                // Transactions
                Route::resource('material-transactions','TransactionController')->only('index');

                // Order
                Route::group(['namespace' => 'Order', 'prefix' => 'm_order'], function(){
                    Route::resource('m_order', 'OrderController');
                });

                // Metric
                Route::group(['namespace' => 'Metric', 'prefix' => 'metric'], function (){
                    Route::resource('metric', 'MetricController');
                    Route::get('metric/delete/{id}','MetricController@delete')->name('metric.delete');
                });

                //MRN Request
                Route::group(['namespace' => 'Request', 'prefix' => 'request'], function(){
                    Route::post('smart-request','RequestController@smartStore')->name('material.smart.request');
                    Route::resource('request', 'RequestController');
                    Route::get('log/fullindex', 'LogsController@fullIndex')->name('log.fullindex');
                    Route::resource('log', 'LogsController');
                    Route::get('log/accept/{id}', 'LogsController@accept')->name('log.accept');
                });
            });
        });
        //
    });
    //Concerns
    Route::get('concerns', 'ConcernController@index')->name('concerns.index');
    Route::get('concerns/inform', 'ConcernController@informConcern')->name('concerns.inform');
    Route::post('concern/production','ConcernController@productionInsert')->name('concern.productioninsert');
    Route::put('concern/{id}/customer-care','ConcernController@csInsert')->name('concern.csinsert');

    //Exports
    Route::group(['namespace' => 'Exports', 'prefix' => 'exports'], function(){
        Route::get('material-transactions/pdf', 'MaterialTransactionController@downloadPdf')->name('material-transactions.downloadPdf');
        Route::get('material-transactions/filter-date/pdf', 'MaterialTransactionController@downloadDateFilterPdf')->name('material-transactions.downloadDateFilterPdf');
    });
});
