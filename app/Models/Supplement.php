<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplement extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'description',
        'file',
        'category_id',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
