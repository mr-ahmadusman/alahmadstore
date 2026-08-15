<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterContact extends Model
{
    use HasFactory;
    protected $fillable = ['address', 'phone', 'mail'];
    // Agar aapko koi aur cheez add karni ho to yahan kar sakte hain
}
