<?php

namespace App\Models;

use App\Models\PodcastList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Podcast extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'voice',
        'duration',
        'text_file',
        'podcast_list_id',
        'child_category_id',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function childCategory(): BelongsTo
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function podcastList(): BelongsTo
    {
        return $this->belongsTo(PodcastList::class);
    }


}
