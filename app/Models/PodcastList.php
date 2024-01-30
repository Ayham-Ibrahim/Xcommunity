<?php

namespace App\Models;

use App\Http\Traits\VisitorableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use willvincent\Rateable\Rateable;

class PodcastList extends Model
{
    use HasFactory,SoftDeletes,VisitorableTrait,Rateable;

    protected $fillable = [
        'title',
        'description',
        'image',
        'child_category_id',
    ];

    public function childCategory(): BelongsTo
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

    public function visitorable()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }
}
