<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTransaction extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }

    public function materials()
    {
        return $this->belongsTo(Material::class, 'materials_id');
    }
}
