<?php

namespace App\Models\Admin\Content;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
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


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

  


}
