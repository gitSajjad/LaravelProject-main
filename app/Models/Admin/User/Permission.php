<?php

namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
    

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
