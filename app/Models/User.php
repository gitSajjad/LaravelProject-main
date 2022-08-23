<?php

namespace App\Models;

use App\Models\Admin\Content\Comment;
use App\Models\Admin\Market\Payment;
use App\Models\Admin\Ticket\AdminTicket;
use App\Models\Admin\Ticket\Ticket;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function getFullNameAttribute()
{
    return "{$this->first_name} {$this->last_name}";
}

public function adminTicket()
{
    return $this->hasOne(AdminTicket::class);

}

public function tickets()
{
    return $this->hasMany(Ticket::class);

}

public function roles()
{
    return $this->belongsToMany(Role::class);
}

public function payments()
{
    return $this->hasMany(Payment::class);

}


// public function comments()
// {
//     return $this->hasMany(Comment::class);

// }



}
