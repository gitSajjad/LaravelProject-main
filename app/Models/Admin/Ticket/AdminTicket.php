<?php

namespace App\Models\Admin\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminTicket extends Model
{

    protected $table = 'ticket_admins';
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];



    public function user()
    {
    return $this->belongsTo(User::class);

    }



}
