<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Job extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'section_id',
        'title',
        'discription',
        'image',
        'tasks',
        'skills',
        'age',
        'job_type',
        'gender',
        'email',
        'nationality',
    ];

    public function toSearchableArray(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'tasks'       => $this->tasks,
            'skills'      => $this->skills,
            'age'         => $this->age,
            'job_type'    => $this->job_type,
            'gender'      => $this->gender,
            'nationality' => $this->nationality,
        ];
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
