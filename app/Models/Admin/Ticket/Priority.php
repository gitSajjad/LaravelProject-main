<?php

namespace App\Models\Admin\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    protected $table = 'ticket_priorities';
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
}
