<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelStyle extends Model
{
    use HasFactory;
    protected $table = "label_styles";
    protected $fillable = [
        'code',
        'name'
    ];
}
