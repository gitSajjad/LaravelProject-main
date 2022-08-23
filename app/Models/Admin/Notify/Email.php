<?php

namespace App\Models\Admin\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    protected $table = 'public_mail' ;
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];



    public function files()
    {
        return $this->hasMany(EmailFile::class, 'public_mail_id');
    }


}
