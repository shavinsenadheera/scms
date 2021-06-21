<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerInfoController extends Controller
{
   public function customerInfo($id)
   {
       $customer = Customer::findOrFail($id);
       $cities = City::all();
       $params =
       [
            'customer'  => $customer,
            'cities'    => $cities,
       ];
       return response($params, '200');
   }

   public function updateInfo($id, Request $request)
   {
       $customer = Customer::findOrFail($id);

   }
}
