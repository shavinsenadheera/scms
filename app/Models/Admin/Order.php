<?php

namespace App\Models\Admin;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'order_no',
        'order_date',
        'delivery_date',
        'customer_id',
        'label_type',
        'style_no',
        'reference_document',
        'size_no',
        'quantity'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function labeltype()
    {
        return $this->belongsTo(LabelType::class,'label_type');
    }

    public function labelstyle()
    {
        return $this->belongsTo(LabelStyle::class,'style_no');
    }

    public function labelsize()
    {
        return $this->belongsTo(LabelSize::class,'size_no');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'current_status_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'taken_by');
    }

    public function orderstatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function priority()
    {
        return $this->belongsTo(PriorityType::class, 'priority_id');
    }
}
