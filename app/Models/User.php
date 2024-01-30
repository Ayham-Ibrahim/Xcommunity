<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'user_interests');
    }

    public function userlists()
    {
        return $this->hasMany(UserList::class, 'user_id', 'id');
    }


    public function providers()
    {
        return $this->hasMany(Provider::class, 'user_id', 'id');
    }


    public function verificationCode()
    {
        return $this->hasOne(verificationCode::class, 'user_id', 'id');
    }
}
