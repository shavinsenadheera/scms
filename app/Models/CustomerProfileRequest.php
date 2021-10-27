<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProfileRequest extends Model
{
    use HasFactory;
    protected $table = 'customer_profile_requests';
    protected $fillable = [
        'customerID',
        'name',
        'address_line_1',
        'address_line_2',
        'city',
        'zipcode',
        'telephone_no',
        'telephone_land',
        'telephone_fax',
        'email',
        'status',
        'acceptedBy',
        'rejectedBy'
    ];
}
