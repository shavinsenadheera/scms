<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Customer\Customer;
use App\Models\CustomerProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerInfoController extends Controller{
   public function customerInfo($id){
       $customer = Customer::findOrFail($id);
       $cities = City::all();
       $params = ['customer'  => $customer, 'cities'    => $cities];
       return response($params, 200);
   }

   public function updateInfo($id, Request $request){
       $checkAlreadyExist = CustomerProfileRequest::where('status', 'LIKE', '%pending%')->where('customerID', '=', $id)->count();
       if($checkAlreadyExist > 0) {
           $message = 'Already have pending profile request!';
       }
       else {
           $customerRequest = new CustomerProfileRequest();
           $customerRequest->customerID = $id;
           $customerRequest->name = $request->name;
           $customerRequest->address_line_1 = $request->address_line_1;
           $customerRequest->address_line_2 = $request->address_line_2;
           $customerRequest->city = $request->city;
           $customerRequest->zipcode = $request->zipcode;
           $customerRequest->telephone_no = $request->telephone_no;
           $customerRequest->telephone_land = $request->telephone_land;
           $customerRequest->telephone_fax = $request->telephone_fax;
           $customerRequest->email = $request->email;
           $customerRequest->save();
           $message = 'Requested Send Success!';
       }
       return response($message,200);
   }

   public function changePassword($id, Request $request){
       $customer = Customer::findOrFail($id);
       if(password_verify($request->current_password, $customer->password)) {
           if($request->password===$request->confirm_password) {
               $customer->password = Hash::make($request->password);
               $customer->save();
               $message = 'Password Changed Success!';
           }else{
               $message = 'Passwords Not Matched!';
           }
       }else{
           $message = 'Current Password Does Not Matched!';
       }
       return response($message,200);
   }
}
