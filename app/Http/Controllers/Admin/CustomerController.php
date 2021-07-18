<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public $title = "Customer handling";

    public function __construct()
    {
        $this->middleware(['role:super_admin|cs_manager|cs_coordinator','permission:customer_handling']);
    }

    public $admin_statuses = [
        [
            'id'    => 0,
            'name'  => 'Deactivate',
        ],
        [
            'id'    => 1,
            'name'  => 'Activate',
        ],
        [
            'id'    => 2,
            'name'  => 'Suspended',
        ],
    ];

    public function index()
    {
        try
        {
            $customers = Customer::all();
            $params = [
                'customers' => $customers,
                'title'     => $this->title,
            ];
            return view('admin.customer.index')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors'.'404');
            }
        }
    }

    public function create()
    {
        $params = [
            'admin_statuses'    => $this->admin_statuses,
            'title'     => $this->title,
            'cities'    => City::all(),
        ];
        return view('admin.customer.create')->with($params);
    }

    public function store(Request $request)
    {
        try
        {
            $this->validate($request, [
                'name'              => 'required|unique:customer,name',
                'email'             => 'required|unique:customer,email',
                'telephone_no'      => 'required',
                'telephone_land'    => 'required',
                'telephone_fax'     => 'required',
                'address_line_1'    => 'required',
                'cities_id'         => 'required',
                'zipcode'           => 'required',
                'password'          => 'required',
            ]);
            $name = $request->name;
            $email = $request->email;
            $telephone_no = $request->telephone_no;
            $telephone_land = $request->telephone_land;
            $telephone_fax = $request->telephone_fax;
            $address_line_1 = $request->address_line_1;
            $address_line_2 = $request->address_line_2;
            $city = $request->cities_id;
            $zipcode = $request->zipcode;
            $admin_status = $request->admin_status;
            $password = Hash::make($request->password);

            $customer = new Customer();
            $customer->name = $name;
            $customer->email = $email;
            $customer->telephone_no = $telephone_no;
            $customer->telephone_land = $telephone_land;
            $customer->telephone_fax = $telephone_fax;
            $customer->address_line_1 = $address_line_1;
            $customer->address_line_2 = $address_line_2;
            $customer->city = $city;
            $customer->zipcode = $zipcode;
            $customer->password = $password;
            $customer->admin_status = $admin_status;
            $customer->save();

            return back()->with('success_msg', 'Successfully added new customer ' . $name);

        }
        catch (ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function show($id)
    {
        try
        {
            $customer = Customer::findOrFail(decrypt($id));
            $params = [
                'customer' => $customer,
                'admin_statuses' => $this->admin_statuses,
                'title'     => $this->title,
            ];
            return view('admin.customer.show')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        try
        {
            $customer = Customer::findOrFail(decrypt($id));
            $name = $customer->name;
            $customer->admin_status = $request->admin_status;
            $customer->save();
            return back()->with('success_msg', 'Successfully updated department ' . $name);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function destroy($id)
    {
        //
    }
}
