<?php

namespace App\Models;

use App\Http\Traits\UserArchiveTrait;
use App\Http\Traits\VisitorableTrait;
use App\Models\Category;
use App\Models\Download;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use willvincent\Rateable\Rateable;

class Store extends Model
{
    use HasFactory,SoftDeletes,VisitorableTrait,Rateable,Searchable,UserArchiveTrait;

    protected $fillable = [
        'title',
        'image',
        'description',
        'file',
        'type',
        'category_id',
        'section_id',
    ];

    public function toSearchableArray(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
        ];
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function visitorable()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }

    public function downloads()
    {
        return $this->morphMany(Download::class, 'downlaodable');
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
