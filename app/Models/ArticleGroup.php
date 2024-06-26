<?php

namespace App\Models;

use App\Http\Traits\VisitorableTrait;
use App\Models\Follow;
use App\Http\Traits\FollowTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class ArticleGroup extends Model
{
    use HasFactory,SoftDeletes,VisitorableTrait,Searchable;
    use FollowTrait;

    protected $fillable = [
        'title',
        'image',
        'group_info',
        'child_category_id',
    ];

    public function toSearchableArray(): array
    {
        return [
            'title'       => $this->title,
            'group_info' => $this->group_info,
        ];
    }

    public function childCategory(): BelongsTo
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function visitorable()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }

    public function followers()
    {
        return $this->morphMany(Follow::class, 'followable');
    }
}
