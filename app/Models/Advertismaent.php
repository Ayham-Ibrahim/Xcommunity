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
        'discripton',
        'image',
        'trainning_topics',
        'details',
        'cost',
        'trainning_outcomes',
        'reservation'
    ];

    public function toSearchableArray(): array
{
    return [
        'title'              => $this->title,
        'discripton'         => $this->discripton,
        'trainning_topics'   => $this->trainning_topics,
        'details'            => $this->details,
        'cost'               => $this->cost,
        'trainning_outcomes' => $this->trainning_outcomes,
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
