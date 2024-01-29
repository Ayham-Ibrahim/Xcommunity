<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Download;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
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

    public function downloads()
    {
        return $this->morphMany(Download::class, 'downlaodable');
    }
}
