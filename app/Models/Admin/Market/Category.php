<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{


    use HasFactory,SoftDeletes,Sluggable;
    protected $table = 'product_categories';

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


    public function parent()
    {
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id')->with('children');
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function properties()
    {
        return $this->hasMany(Product::class);
    }


    public function CategoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }
}
