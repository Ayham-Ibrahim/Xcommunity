<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Supplement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];


    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class, 'category_id', 'id');
    }

    public function supplements(): HasMany
    {
        return $this->hasMany(Supplement::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_interests');
    }

}
