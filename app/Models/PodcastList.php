<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PodcastList extends Model
{
    use HasFactory,SoftDeletes;

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
}
