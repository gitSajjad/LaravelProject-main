<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmazingSale extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



}
