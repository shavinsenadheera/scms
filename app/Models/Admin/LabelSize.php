<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelSize extends Model
{
    use HasFactory;
    protected $table = "label_sizes";
    protected $fillable = [
        'code',
        'name',
        'width',
        'height'
    ];
}
