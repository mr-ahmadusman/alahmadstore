<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title',
        'banner_image',
        'feature_description',
        't_name',
        't_title',
        't_description',
        't_image',
    ];
    use HasFactory;
}
