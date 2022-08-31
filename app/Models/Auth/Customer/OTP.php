<?php

namespace App\Models\Auth\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OTP extends Model
{
    use HasFactory;


    protected $guarded = ['id'];
    protected $table = 'otps';

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
