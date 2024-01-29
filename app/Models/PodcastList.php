<?php

namespace App\Models;

use App\Http\Traits\FollowTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PodcastList extends Model
{
    use HasFactory,SoftDeletes,FollowTrait;

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

    public function followers()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

}
