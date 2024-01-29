<?php

namespace App\Models;

use App\Models\Follow;
use App\Http\Traits\FollowTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleGroup extends Model
{
    use HasFactory,SoftDeletes,FollowTrait;

    protected $fillable = [
        'name',
        'image',
        'group_info',
        'child_category_id',
    ];

    public function childCategory(): BelongsTo
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function followers()
    {
        return $this->morphMany(Follow::class, 'followable');
    }
}
