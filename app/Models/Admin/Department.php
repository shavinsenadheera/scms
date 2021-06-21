<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = "department";
    protected $fillable = [
        'code',
        'name',
        'departmenthead_id',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'departmenthead_id');
    }
}
