<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('Dashboard.index');
})->middleware('auth');

Route::get('/cache-clear', function(){
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
});

Auth::routes();

Route::group(['middleware' => 'auth','namespace'=>'App\Http\Controllers'],function(){
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
        Route::resource('customer','CustomerController');
        Route::get('customer/delete/{id}','CustomerController@delete')->name('customer.delete');

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
            Route::get('planning/scan', 'PlanningController@scanView')->name('planning.scanview');
            Route::put('planning/{id}','PlanningController@priorityUpdate')->name('planning.scanUpdate');
            Route::post('planning','PlanningController@scan')->name('planning.scan');
        });

        //Manufacturing
        Route::group(['namespace'=>'Manufacturing','prefix'=>'manufacturing'],function(){
            Route::post('manufacturing','ManufacturingController@scan')->name('manufacturing.scan');
            Route::get('manufacturing/scan', 'ManufacturingController@scanView')->name('manufacturing.scanview');
            Route::get('manufacturing/mr', 'ManufacturingController@mrIndex')->name('manufacturing.mrindex');
        });

        //QA
        Route::group(['namespace'=>'QA','prefix'=>'qa'],function(){
            Route::post('qa','QAController@scan')->name('qa.scan');
            Route::get('qa/scan', 'QAController@scanView')->name('qa.scanview');
        });

        //Dispatch
        Route::group(['namespace'=>'Dispatch','prefix'=>'dispatch'],function(){
            Route::post('dispatch','DispatchController@scan')->name('dispatch.scan');
            Route::get('dispatch/scan', 'DispatchController@scanView')->name('dispatch.scanview');
            Route::post('dispatch/scandone','DispatchController@scanDone')->name('dispatch.scandone');
            Route::get('dispatch/scandone/view','DispatchController@scanDoneView')->name('dispatch.scandoneview');
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
                    Route::resource('request', 'RequestController');
                    Route::get('log/fullindex', 'LogsController@fullIndex')->name('log.fullindex');
                    Route::resource('log', 'LogsController');
                    Route::get('log/accept/{id}', 'LogsController@accept')->name('log.accept');
                });
            });
        });
        //
    });
});
