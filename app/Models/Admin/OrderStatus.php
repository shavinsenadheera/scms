<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $table = "order_statuses";

    protected $fillable = [
        'order_id',
        'status_1',
        'status_1_empid',
        'status_1_datetime',
    ];

    public function status1()
    {
        return $this->belongsTo(Status::class, 'status_1');
    }

    public function status1employee()
    {
        return $this->belongsTo(Employee::class, 'status_1_empid');
    }

    public function status2()
    {
        return $this->belongsTo(Status::class, 'status_2');
    }

    public function status2employee()
    {
        return $this->belongsTo(Employee::class, 'status_2_empid');
    }

    public function status3()
    {
        return $this->belongsTo(Status::class, 'status_3');
    }

    public function status3employee()
    {
        return $this->belongsTo(Employee::class, 'status_3_empid');
    }

    public function status4()
    {
        return $this->belongsTo(Status::class, 'status_4');
    }

    public function status4employee()
    {
        return $this->belongsTo(Employee::class, 'status_4_empid');
    }

    public function status5()
    {
        return $this->belongsTo(Status::class, 'status_5');
    }

    public function status5employee()
    {
        return $this->belongsTo(Employee::class, 'status_5_empid');
    }

    public function status6()
    {
        return $this->belongsTo(Status::class, 'status_6');
    }

    public function status6employee()
    {
        return $this->belongsTo(Employee::class, 'status_6_empid');
    }

    public function status7()
    {
        return $this->belongsTo(Status::class, 'status_7');
    }

    public function status7employee()
    {
        return $this->belongsTo(Employee::class, 'status_7_empid');
    }

    public function status8()
    {
        return $this->belongsTo(Status::class, 'status_8');
    }

    public function status8employee()
    {
        return $this->belongsTo(Employee::class, 'status_8_empid');
    }
}
