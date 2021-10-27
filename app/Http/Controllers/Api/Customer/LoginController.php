<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller{
    public function checkCredentials(Request $request){
        $username = $request->data['email'];
        $password = $request->data['password'];
        $user = Customer::where('email','=',$username)->get();
        $customer = Customer::where('email','=',$username)->first();
        if(count($user)==1) {
            if(Hash::check($password, $user[0]->password)) {
                return response()->json($customer,'200');
            } else {
                return response()->json('User exist. Password does not correct!','400');
            }
        } else {
            return response()->json('User does not exist','400');
        }
    }
}
