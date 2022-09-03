<?php

namespace App\Models\Admin\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = ['image' => 'array'];




    public static $positions = [
        0   =>  'اسلاید شو (صفحه اصلی)',
        1   =>  'کنار اسلاید شو (صفحه اصلی)',
        2   =>  'دو بنر تبلیغی بین دو اسلایدر  (صفحه اصلی)',
        3   =>  'بنر تبلیغی بزرگ پایین دو اسلایدر  (صفحه اصلی)'
    ];

}
