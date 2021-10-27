<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Customer\Customer;
use App\Models\CustomerProfileRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileRequestController extends Controller{
    public function index(Request $request){
        try{
            $query = CustomerProfileRequest::select(['id', 'name']);
            $searchVal = null;
            if($request->input('sort')){
                $searchVal = $request->get('sort');
                $customerProfileRequests = $query->where('status', 'LIKE', '%'.$searchVal.'%')->get();
            }else {
                $customerProfileRequests = $query->where('status', 'LIKE', '%pending%')->get();
            }
            $params = ['customerProfileRequests'  => $customerProfileRequests, 'searchVal' => $searchVal];
            return view('admin.customer.requests.index')->with($params);
        }catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function show($id){
        try{
            $customerProfileRequest = CustomerProfileRequest::findOrFail(decrypt($id));
            $cities = City::select('id', 'name')->get();
            $params = ['customerProfileRequest'  => $customerProfileRequest, 'cities'  => $cities];
            return view('admin.customer.requests.show')->with($params);
        }catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }

    public function update($id, Request $request){
        try{
            $customerProfileRequest = CustomerProfileRequest::findOrFail(decrypt($id));
            $customer = Customer::findOrFail($customerProfileRequest->customerID);
            $decision = $request->get('action');
            switch($request->input('action')) {
                case 'accepted':
                    $customerProfileRequest->status = 'accepted';
                    $customerProfileRequest->acceptedBy = Auth::id();
                    $customer->name = $customerProfileRequest->name;
                    $customer->address_line_1 = $customerProfileRequest->address_line_1;
                    $customer->address_line_2 = $customerProfileRequest->address_line_2;
                    $customer->city = $customerProfileRequest->city;
                    $customer->telephone_no = $customerProfileRequest->telephone_no;
                    $customer->telephone_land = $customerProfileRequest->telephone_land;
                    $customer->telephone_fax = $customerProfileRequest->telephone_fax;
                    $customer->save();
                    break;
                case 'rejected':
                    $customerProfileRequest->status = 'rejected';
                    $customerProfileRequest->rejectedBy = Auth::id();
                    break;
            }
            $customerProfileRequest->save();
            return back()->with('success_msg', 'Successfully '.$decision.' request!');
        }catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, 404);
        }
    }
}
