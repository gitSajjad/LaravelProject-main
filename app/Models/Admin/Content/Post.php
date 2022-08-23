<?php

namespace App\Models\Admin\Content;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return[

            'slug'=>[

                'source' => 'title'
            ]

        ];


    }

    ////image
    protected $casts = ['image' => 'array'];


////rabeteh

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }



    public function comments()
    {
        return $this->morphMany('App\Model\Admin\Content\Comment', 'commentable');
    }




}
