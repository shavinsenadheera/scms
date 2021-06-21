<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelType extends Model
{
    use HasFactory;
    protected $table = "label_types";
    protected $fillable = [
        'code',
        'name'
    ];
}
