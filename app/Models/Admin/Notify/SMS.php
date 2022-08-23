<?php

namespace App\Models\Admin\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SMS extends Model
{
    protected $table = 'public_sms' ;
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

}
