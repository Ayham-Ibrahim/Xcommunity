<?php

namespace App\Models;

use App\Http\Traits\VisitorableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleGroup extends Model
{
    use HasFactory,SoftDeletes,VisitorableTrait;

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

    public function visitorable()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }

}
