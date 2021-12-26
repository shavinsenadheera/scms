<?php

namespace App\Models;

use App\Models\Admin\Industry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCustomer extends Model{
    use HasFactory;
    protected $table = "new_customers";
    protected $fillable = [
        'name', 'industry', 'email', 'contactNo', 'message'
    ];
    public function industrySelector(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Industry::class, 'industry');
    }
}
