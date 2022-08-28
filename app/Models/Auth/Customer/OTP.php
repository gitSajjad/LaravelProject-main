<?php

namespace App\Models\Auth\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;


    protected $guarded = ['id'];
    protected $table = 'otps';
}
