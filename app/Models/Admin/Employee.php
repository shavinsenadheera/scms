<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employee";
    protected $fillable = [
        "name",
        'epfno',
        'contact_no',
        'department_id',
        'designation_id',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'employee_id');
    }
}
