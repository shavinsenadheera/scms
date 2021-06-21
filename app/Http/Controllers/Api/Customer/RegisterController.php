<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        try {
            $name = $request->data['name'];
            $email = $request->data['email'];
            $phoneno = $request->data['phoneno'];
            $telno = $request->data['telno'];
            $faxno = $request->data['faxno'];
            $address_line_1 = $request->data['address_line_1'];
            $address_line_2 = $request->data['address_line_2'];
            $city = $request->data['city'];
            $zipcode = $request->data['zipcode'];
            $password = Hash::make($request->data['password']);

            $customer = new Customer();
            $customer->name = $name;
            $customer->email = $email;
            $customer->telephone_no = $phoneno;
            $customer->telephone_land = $telno;
            $customer->telephone_fax = $faxno;
            $customer->address_line_1 = $address_line_1;
            $customer->address_line_2 = $address_line_2;
            $customer->city = $city;
            $customer->zipcode = $zipcode;
            $customer->password = $password;
            $customer->save();

            return response('Successfully registered!', 204);

        }catch (ModelNotFoundException $error){
            return response('Not found', 404);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
