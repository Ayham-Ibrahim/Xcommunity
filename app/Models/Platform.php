<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'rss_feed',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_platforms');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_platforms');
    }

}
