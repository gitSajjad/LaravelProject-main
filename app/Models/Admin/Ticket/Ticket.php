<?php

namespace App\Models\Admin\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];


    public function reference()
    {
        return $this->belongsTo(Priority::class);
    }

 public function admin()
    {
        return $this->belongsTo(AdminTicket::class,'reference_id');
    }


 public function category()
    {
        return $this->belongsTo(CategoryTicket::class);
    }


 public function user()
    {
        return $this->belongsTo(User::class);
    }




    public function parent()
    {
        return $this->belongsTo($this, 'ticket_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'ticket_id')->with('children');
    }



}
