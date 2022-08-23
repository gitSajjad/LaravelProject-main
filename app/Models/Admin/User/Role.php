<?php

namespace App\Models\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

     public function Users()
    {
       return $this->belongsToMany(User::class);
    }


    public function permissions()
    {
       return $this->belongsToMany(Permission::class);
    }

}
