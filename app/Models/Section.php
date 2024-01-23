<?php

namespace App\Models;

use App\Models\Supplement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'section_id', 'id');
    }

    public function advertismaents()
    {
        return $this->hasMany(Advertismaent::class, 'section_id', 'id');
    }

    public function articls()
    {
        return $this->hasMany(Article::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
    public function supplements()
    {
        return $this->hasMany(Supplement::class);
    }
}
