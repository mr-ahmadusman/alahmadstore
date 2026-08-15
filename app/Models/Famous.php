<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Famous extends Model
{
    use HasFactory;

    protected $table = 'famous';

    protected $fillable = [
        'title',
        'percentage',
        'image',
    ];
}
