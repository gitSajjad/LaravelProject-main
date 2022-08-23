<?php

namespace App\Models\Admin\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoryTicket extends Model
{
    protected $table = 'ticket_categories';
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
}
