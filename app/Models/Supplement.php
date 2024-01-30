<?php

namespace App\Models;

use App\Http\Traits\VisitorableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use willvincent\Rateable\Rateable;

class Supplement extends Model
{
    use HasFactory,SoftDeletes,VisitorableTrait,Rateable;

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

    public function visitorable()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }
}
