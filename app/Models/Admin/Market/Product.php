<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes,Sluggable;


    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return[

            'slug'=>[

                'source' => 'name'
            ]

        ];


    }

    protected $casts = ['image' => 'array'];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }


    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }


      public function values()
    {
        return $this->hasMany(PropertyValue::class);
    }

}