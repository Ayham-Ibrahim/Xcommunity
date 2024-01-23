<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertismaent extends Model
{
    use HasFactory, SoftDeletes;

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


    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
