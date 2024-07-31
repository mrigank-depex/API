<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $table = 'otps'; // Ensure it matches the table name

    protected $fillable = [
        'phone',
        'otp',
    ];
}
