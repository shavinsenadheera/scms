<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Api\Customer\LoginController;
use App\Http\Controllers\Api\Customer\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace'=>'App\Http\Controllers\Api\Customer'], function(){
    //Customer register api
    Route::apiResource('customer-register', 'RegisterController');
    //Customer login check api
    Route::post('customer-login','LoginController@checkCredentials')->name('customer.login');
    //Customer order
        //Make order
    Route::apiResource('make-order','MakeOrderController');
        //Get Orders
    Route::get('get-orders/{id}','OrderController@getOrders')->name('customer.orders');
    Route::get('get-all-orders/{id}','OrderController@getAllOrders')->name('customer.allorders');
    //Customer info
    Route::get('customer/info/{id}','CustomerInfoController@customerInfo')->name('customer.info');    //Customer info
    //
    Route::get('customer/concerns/{id}','OrderController@getConcerns')->name('customer.concerns');
});
