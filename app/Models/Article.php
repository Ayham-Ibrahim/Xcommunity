<?php

namespace App\Models;

use App\Models\Section;
use App\Models\ArticleGroup;
use App\Models\ChildCategory;
use App\Http\Traits\LikeableTrait;
use App\Http\Traits\VisitorableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory,SoftDeletes,LikeableTrait,VisitorableTrait,Searchable;

    protected $fillable = [
        'title',
        'image',
        'body',
        'time_to_read',
        'child_category_id',
        'section_id',
        'article_group_id',
    ];

    public function toSearchableArray(): array
    {
        return [
            'title'        => $this->title,
            'body'         => $this->body,
            'time_to_read' => $this->time_to_read,
        ];
    }

    public function likes()
    {
        return $this->morphMany(like::class, 'likeable');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id', 'id');
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id', 'id');
    }

    public function articleGroup()
    {
        return $this->belongsTo(ArticleGroup::class,'article_group_id', 'id');
    }
    public function visitorable()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }

}
