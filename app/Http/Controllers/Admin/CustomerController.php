<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewCustomer\NewCustomerStatusAlert;
use App\Models\Admin\City;
use App\Models\Admin\Industry;
use App\Models\Customer\Customer;
use App\Models\NewCustomer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller{
    public $title = "Customer handling";

    public function __construct(){
        $this->middleware(['role:super_admin|cs_manager|cs_coordinator','permission:customer_handling']);
    }

    public $admin_statuses = [
        ['id'    => 0, 'name'  => 'Deactivate',],
        ['id'    => 1, 'name'  => 'Activate',],
        ['id'    => 2, 'name'  => 'Suspended',],
    ];

    public function index(){
        try {
            $customers = Customer::select(['id', 'name', 'email', 'telephone_no', 'telephone_land', 'telephone_fax', 'admin_status'])->get();
            $params = ['customers' => $customers, 'title' => $this->title,];
            return view('admin.customer.index')->with($params);
        } catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, '404');
        }
    }

    public function create(){
        $newCustomer = [];
        if(isset($_GET['newCustomer'])){
            $newCustomer = NewCustomer::findOrFail($_GET['newCustomer']);
        }
        $cities = City::select(['id', 'name'])->get();
        $industries = Industry::select(['id', 'name'])->get();
        $params = ['admin_statuses'=> $this->admin_statuses, 'title' => $this->title, 'cities' => $cities, 'newCustomer' => $newCustomer, 'industries'=>$industries];
        return view('admin.customer.create')->with($params);
    }

    public function store(Request $request){
        try {
            $request->validate([
                'name'              => 'required|unique:customer,name',
                'email'             => 'required|unique:customer,email',
                'telephone_no'      => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'telephone_land'    => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'telephone_fax'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'address_line_1'    => 'required',
                'cities_id'         => 'required',
                'zipcode'           => 'required',
                'password'          => 'required',
                'admin_status'      => 'required',
                'industry'          => 'required'
            ]);
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->telephone_no = $request->telephone_no;
            $customer->telephone_land = $request->telephone_land;
            $customer->telephone_fax = $request->telephone_fax;
            $customer->address_line_1 = $request->address_line_1;
            $customer->address_line_2 = $request->address_line_2;
            $customer->city = $request->cities_id;
            $customer->zipcode = $request->zipcode;
            $customer->password = Hash::make($request->password);
            $customer->admin_status = $request->admin_status;
            $customer->save();
            $details = [
                'status' => 'Register',
                'name' => $request->name
            ];
            Mail::to($request->email)->cc('newcustomers@abctl.com')->send(new NewCustomerStatusAlert($details));
            return back()->with('success_msg', 'Successfully added new customer ' . $request->name);
        } catch (ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, '404');
        }
    }

    public function show($id){
        try {
            $customer = Customer::findOrFail(decrypt($id));
            $params = ['customer' => $customer, 'admin_statuses' => $this->admin_statuses, 'title' => $this->title];
            return view('admin.customer.show')->with($params);
        } catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, '404');
        }
    }

    public function update(Request $request, $id){
        try {
            $customer = Customer::findOrFail(decrypt($id));
            $name = $customer->name;
            $customer->admin_status = $request->admin_status;
            $customer->save();
            return back()->with('success_msg', 'Successfully updated customer ' . $name);
        } catch(ModelNotFoundException $exception) {
            abort_if($exception instanceof ModelNotFoundException, '404');
        }
    }
}
