<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewCustomer\CreateRequest;
use App\Mail\Customer\OrderProcess;
use App\Mail\Internal\NewCustomerAlertSystem;
use App\Mail\NewCustomerAlert;
use App\Models\NewCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewCustomerController extends Controller{
    public function store(Request $request){
        if($request->name=="" || $request->industry=="" || $request->email=="" || $request->contactNo=="" || $request->message ==""){
            return response()->json(['message' => 'You have forgotten to fill some data!', 'success' => false], 200);
        }else{
            $checkCustomer = NewCustomer::where('email', 'LIKE', '%'.$request->email.'%')->count();
            if($checkCustomer > 0){
                return response()->json(['message' => 'You have already requested!', 'success' => false], 200);
            }else{
                $newCustomer = new NewCustomer();
                $newCustomer->name = $request->name;
                $newCustomer->industry = $request->industry;
                $newCustomer->email = $request->email;
                $newCustomer->contactNo = $request->contactNo;
                $newCustomer->message = $request->message;
                $newCustomer->save();
                $details = [
                    'name' => $request->name
                ];
                $detailsSystem = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'contactNo' => $request->contactNo,
                    'industry' => $request->industry,
                    'message' => $request->message
                ];
                Mail::to($request->email)->send(new NewCustomerAlert($details));
                Mail::to('customerservice@abctl.com')->send(new NewCustomerAlertSystem($detailsSystem));

                return response()->json(['message' => 'You have successfully make a request!', 'success' => true], 201);
            }
        }
    }
}
