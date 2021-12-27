<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller{
    public function index(){
        $industries = Industry::select('id', 'name')->get();
        return response($industries, 200);
    }
}
