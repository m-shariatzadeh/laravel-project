<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function post()
//    {
//        return $this->hasOne(Post::class);
//    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function photos()
    {
        return $this->morphMany('App\Models\Photo','photo');
    }

    public function isAdmin()
    {
        foreach ($this->roles as $role)
        {
            if ($role->name == 'ادمین')
            {
                return true;
            }
        }
        return false;
    }

//    public function isAdmin($userRole)
//    {
//        foreach ($this->roles as $role)
//        {
//            if ($role->name == $userRole)
//            {
//                return true;
//            }
//        }
//        return false;
//    }
}
