<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'phone_number_priv',
        'facebook',
        'facebook_priv',
        'linkedin',
        'linkedin_priv',
        'gender',
        'birth_date',
        'birth_date_priv',
        'job',
        'job_priv',
        'education',
        'education_priv',
        'location',
        'location_priv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
