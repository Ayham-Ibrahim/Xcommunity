<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

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

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
