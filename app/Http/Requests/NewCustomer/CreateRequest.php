<?php

namespace App\Http\Requests\NewCustomer;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest{
    public function authorize(): bool{
        return false;
    }
    public function rules(): array{
        return [
            'customerName'      => 'required',
            'customerIndustry'  => 'required',
            'emailAddress'      => 'required',
            'contactNo'         => 'required',
            'message'           => 'required'
        ];
    }
}
