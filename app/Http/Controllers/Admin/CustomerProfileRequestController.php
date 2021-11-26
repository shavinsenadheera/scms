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
            $customerDetail = Customer::findOrFail(decrypt($id));
            $cities = City::select('id', 'name')->get();
            $changes=array();
            if($customerDetail->name!=$customerProfileRequest->name){
                array_push($changes, 'name');
            }else if($customerDetail->address_line_1!=$customerProfileRequest->address_line_1){
                array_push($changes, 'address_line_1');
            }else if($customerDetail->address_line_2!=$customerProfileRequest->address_line_2){
                array_push($changes, 'address_line_2');
            }else if($customerDetail->city!=$customerProfileRequest->city){
                array_push($changes, 'city');
            }else if($customerDetail->zipcode!=$customerProfileRequest->zipcode){
                array_push($changes, 'zipcode');
            }else if($customerDetail->telephone_no!=$customerProfileRequest->telephone_no){
                array_push($changes, 'telephone_no');
            }else if($customerDetail->telephone_fax!=$customerProfileRequest->telephone_fax){
                array_push($changes, 'telephone_fax');
            }else if($customerDetail->email!=$customerProfileRequest->email){
                array_push($changes, 'email');
            }
            $params = ['customerProfileRequest'  => $customerProfileRequest, 'cities'  => $cities, 'changes' => $changes];
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
