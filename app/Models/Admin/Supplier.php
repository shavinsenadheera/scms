<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "suppliers";
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'telephone_no',
        'fax_no',
        'address_line_1',
        'cities_id',
        'zipcode',
    ];

    public function cities()
    {
        return $this->belongsTo(City::class, 'cities_id');
    }
}
