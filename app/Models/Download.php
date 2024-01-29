<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'downloadable_id',
        'downloadable_type',
    ];

    public function downloadable(){
        return $this->morphTO();
    }
}
