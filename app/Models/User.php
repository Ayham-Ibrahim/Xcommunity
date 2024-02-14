<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Like;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'role_name',
        'device_token',
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
        // 'roles_name' => 'array',
    ];

    public function canAccessPanel(Panel $panel): bool {
        // return str_ends_with($this->email, '@admin.com' );
        return $this->is_admin === 1;

    }

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

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'users_platforms');
    }
}
