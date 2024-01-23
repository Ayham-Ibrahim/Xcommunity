<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Podcast;
use App\Models\PodcastList;
use App\Models\ArticleGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function articleGroups()
    {
        return $this->hasMany(ArticleGroup::class);
    }
    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
    public function PodcastLists()
    {
        return $this->hasMany(PodcastList::class);
    }

}
