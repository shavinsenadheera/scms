<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model{
    use HasFactory;
    protected $fillable = ['name', 'created_at', 'updated_at'];
}
