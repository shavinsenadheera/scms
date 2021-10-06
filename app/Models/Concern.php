<?php

namespace App\Models;

use App\Models\Admin\Employee;
use App\Models\Admin\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concern extends Model
{
    use HasFactory;
    protected $table = 'concerns';
    protected $fillable = [
        'orderId',
        'concern',
        'status',
        'reason',
        'concernedBy',
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }

    public function concernedFrom()
    {
        return $this->belongsTo(Employee::class, 'concernedBy');
    }

    public function concernedTo()
    {
        return $this->belongsTo(Employee::class, 'replyBy');
    }
}
