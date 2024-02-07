<?php

namespace App\Models;

use App\Models\PodcastList;
use App\Models\UserListArchive;
use App\Http\Traits\LikeableTrait;
use App\Http\Traits\UserArchiveTrait;
use App\Http\Traits\VisitorableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Podcast extends Model
{
    use HasFactory,SoftDeletes,LikeableTrait,VisitorableTrait,UserArchiveTrait;

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
    public function likes()
    {
        return $this->morphMany(like::class, 'likeable');
    }

    public function visitorable()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }

    public function userLestArchives()
    {
        return $this->morphMany(UserListArchive::class, 'saveable');
    }

    public function archives()
    {
        return $this->morphMany(Archive::class, 'saveable');
    }
}
