<?php

namespace App\Http\Controllers\Department\CS;

use App\Http\Controllers\Controller;
use App\Mail\NewCustomer\NewCustomerStatusAlert;
use App\Models\Customer\Customer;
use App\Models\NewCustomer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewCustomerController extends Controller
{
    public function index(Request $request){
        $searchVal = "";
        $filterVal = "";
        try {
            $queryHandler = NewCustomer::with([
                'industrySelector' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->select('id', 'name', 'industry', 'email', 'contactNo', 'message', 'status', 'created_at');
            if ($request->input('query')) {
                $searchVal = $request->get('query');
                $queryHandler->where('name', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchVal . '%');
            }
            if ($request->input('filter')) {
                switch ($request->get('filter')) {
                    case "all":
                        $filterVal = 10;
                        break;
                    case "pending":
                        $filterVal = 0;
                        break;
                    case "review":
                        $filterVal = 1;
                        break;
                    case "completed":
                        $filterVal = 2;
                        break;
                    case "declined":
                        $filterVal = 3;
                    default:
                }
                if ($filterVal != 10)
                    $queryHandler->where('status', '=', $filterVal);
            }
            $params = [
                'newCustomers' => $queryHandler->paginate(6),
                'searchVal' => $searchVal
            ];
            return view('departments.cs.new-customers')->with($params);
        }catch(ModelNotFoundException $exception){
            return response()->view('errors.404');
        }
    }

    public function update(Request $request, $id){
        try{
            $status = "";
            $newCustomer = NewCustomer::findOrFail($id);
            if($request->post('complete')){
                $newCustomer->status=2;
                $status = "Completed";
            }else if($request->post('review')){
                $newCustomer->status=1;
                $status = "Under Review";
            }else if($request->post('decline')){
                $newCustomer->status=3;
                $status = "Declined";
            }else if($request->post('register')){
                $checkCustomerExist = Customer::where('email', 'LIKE', '%'.$newCustomer->email.'%')->count();
                if($checkCustomerExist > 0){
                    return back()->with('error_msg', 'Customer already registered!');
                }
                return redirect()->route('customer.create', ['newCustomer' => $newCustomer]);
            }
            $newCustomer->save();
            $details = [
                'status' => $status,
                'name' => $newCustomer->name
            ];
            Mail::to($newCustomer->email)->cc('newcustomers@abctl.com')->send(new NewCustomerStatusAlert($details));
            return back()->with('success_msg', 'Successfully updated the request status!');
        }catch(ModelNotFoundException $exception){
            return response()->view('errors.404');
        }
    }
}
