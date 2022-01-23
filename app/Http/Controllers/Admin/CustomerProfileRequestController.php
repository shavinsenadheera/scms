<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\Industry;
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
            $customerDetail = Customer::findOrFail($customerProfileRequest->customerID);
            $cities = City::select('id', 'name')->get();
            $industries = Industry::select('id', 'name')->get();
            $changes=array();
            if($customerProfileRequest->name!=null && $customerDetail->name!=$customerProfileRequest->name){
                array_push($changes, 'name');
            }else if($customerProfileRequest->address_line_1!=null  && $customerDetail->address_line_1!=$customerProfileRequest->address_line_1){
                array_push($changes, 'address_line_1');
            }else if($customerProfileRequest->address_line_2!=null && $customerDetail->address_line_2!=$customerProfileRequest->address_line_2){
                array_push($changes, 'address_line_2');
            }else if($customerProfileRequest->city!=null && $customerDetail->city!=$customerProfileRequest->city){
                array_push($changes, 'city');
            }else if($customerProfileRequest->zipcode!=null && $customerDetail->zipcode!=$customerProfileRequest->zipcode){
                array_push($changes, 'zipcode');
            }else if($customerProfileRequest->telephone_no!=null && $customerDetail->telephone_no!=$customerProfileRequest->telephone_no){
                array_push($changes, 'telephone_no');
            }else if($customerProfileRequest->telephone_fax!=null && $customerDetail->telephone_fax!=$customerProfileRequest->telephone_fax){
                array_push($changes, 'telephone_fax');
            }else if($customerProfileRequest->email!=null && $customerDetail->email!=$customerProfileRequest->email){
                array_push($changes, 'email');
            }else if($customerProfileRequest->industry!=null && $customerDetail->industry!=$customerProfileRequest->industry){
                array_push($changes, 'industry');
            }
            $params = ['customerProfileRequest'  => $customerProfileRequest, 'cities'  => $cities, 'changes' => $changes, 'industries' => $industries];
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
