<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentOnline extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'online_payments';




    public function payments()
    {
        return $this->morphMany('App\Models\Admin\Market\Payment', 'paymentable');
    }
}
