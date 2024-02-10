<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visitorable_id',
        'visitorable_type',
    ];

    public function visitorable()
    {
        return $this->morphTo();
    }


}
