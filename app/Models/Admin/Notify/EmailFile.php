<?php

namespace App\Models\Admin\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailFile extends Model
{
    protected $table = 'public_mail_files';

    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];


    public function email()
    {
        return $this->belongsTo(Email::class,'public_mail_id');
    }

}
