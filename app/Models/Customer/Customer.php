<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    use HasFactory;
    protected $table = 'customer';
    protected $hidden = ['password'];
    protected $fillable = [
        'name',
        'address_line_1',
        'address_line_2',
        'city',
        'zipcode',
        'telephone_no',
        'telephone_land',
        'telephone_fax',
        'email',
        'password',
        'admin_status',
        'industry'
    ];
}
