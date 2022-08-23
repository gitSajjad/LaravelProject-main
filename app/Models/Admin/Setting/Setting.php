<?php

namespace App\Models\Admin\Setting;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = ['image' => 'array'];
}
