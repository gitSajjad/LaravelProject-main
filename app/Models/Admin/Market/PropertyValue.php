<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyValue extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'category_attribute_default_values';
    protected $guarded = ['id'];


    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class);
    }

  public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
