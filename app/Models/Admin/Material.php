<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = "materials";
    protected $fillable = [
        'name',
        'supplier_id'
    ];

    public function metrics()
    {
        return $this->belongsTo(MMetric::class, 'm_metrics_id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }
}
