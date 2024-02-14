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

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_interests');
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'categories_platforms');
    }

}
