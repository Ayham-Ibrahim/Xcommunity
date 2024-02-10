<?php

namespace App\Models;

use App\Http\Traits\UserArchiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Advertismaent extends Model
{
    use HasFactory, SoftDeletes, Searchable, UserArchiveTrait;

    protected $fillable = [
        'section_id',
        'title',
        'discription',
        'image',
        'trainning_topics',
        'details',
        'cost',
        'tarinning_outcomes',
        'reservation'
    ];

    public function toSearchableArray(): array
{
    return [
        'title'              => $this->title,
        'discription'         => $this->discription,
        'trainning_topics'   => $this->trainning_topics,
        'details'            => $this->details,
        'cost'               => $this->cost,
        'tarinning_outcomes' => $this->tarinning_outcomes,
        'reservation'        => $this->reservation,
    ];
}


    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function archives()
    {
        return $this->morphMany(Archive::class, 'saveable');
    }

    public function userLestArchives()
    {
        return $this->morphMany(UserListArchive::class, 'saveable');
    }
}
