<?php

namespace App\Http\Controllers\Department\Store\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\Supplier;
use App\Models\Customer\Customer;
use BaconQrCode\Common\Mode;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        try
        {
            $suppliers = Supplier::all();
            $cities = City::all();
            $params = [
                'suppliers' => $suppliers,
                'cities' => $cities,
            ];
            return view('departments.stores.supplier.index')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function create()
    {
        try
        {
            $cities = City::all();
            $params = [
                'cities' => $cities,
            ];
            return view('departments.stores.supplier.create')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function store(Request $request)
    {
        try
        {
            $this->validate($request,[
                'name'          => 'required',
                'email'         => 'required|unique:suppliers,email',
                'phone_no'      => 'required',
                'telephone_no'  => 'required',
                'fax_no'        => 'required',
                'address_line_1'=> 'required',
                'cities_id'     => 'required',
                'zipcode'       => 'required',
            ]);

            $new_supplier = new Supplier();
            $name = $request->name;
            $new_supplier->name = $name;
            $new_supplier->email = $request->email;
            $new_supplier->phone_no = $request->phone_no;
            $new_supplier->telephone_no = $request->telephone_no;
            $new_supplier->fax_no = $request->fax_no;
            $new_supplier->address_line_1 = $request->address_line_1;
            $new_supplier->address_line_2 = $request->address_line_2;
            $new_supplier->cities_id = $request->cities_id;
            $new_supplier->zipcode = $request->zipcode;
            $new_supplier->website = $request->website;
            $new_supplier->save();
            return back()->with('success_msg', 'Successfully added new supplier ' . $name);
        }
        catch(ModelNotFoundException $exception)
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
            $supplier = Supplier::findOrFail(decrypt($id));
            $cities = City::all();
            $params = [
                'supplier'  => $supplier,
                'cities'    => $cities,
            ];
            return view('departments.stores.supplier.show')->with($params);
        }
        catch (ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'name'          => 'required',
                'email'         => 'required',
                'phone_no'      => 'required',
                'telephone_no'  => 'required',
                'fax_no'        => 'required',
                'address_line_1'=> 'required',
                'cities_id'     => 'required',
                'zipcode'       => 'required',
            ]);
            $supplier = Supplier::findOrFail(decrypt($id));
            $name = $supplier->name;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone_no = $request->phone_no;
            $supplier->telephone_no = $request->telephone_no;
            $supplier->fax_no = $request->fax_no;
            $supplier->address_line_1 = $request->address_line_1;
            $supplier->address_line_2 = $request->address_line_2;
            $supplier->cities_id = $request->cities_id;
            $supplier->zipcode = $request->zipcode;
            $supplier->website = $request->website;
            $supplier->save();
            return back()->with('success_msg', 'Successfully updated supplier ' . $name);
        }
        catch (ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function delete($id)
    {
        try
        {
            $params = [
                'id'=>decrypt($id),
            ];
            return view('departments.stores.supplier.delete')->with($params);
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
        try
        {
            $supplier = Supplier::findOrFail(decrypt($id));
            $name = $supplier->name;
            $supplier->delete();
            return redirect()->route('supplier.index')->with('success_msg', 'Successfully deleted supplier ' . $name);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
