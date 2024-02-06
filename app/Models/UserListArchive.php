<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserListArchive extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_list_id',
        'saveable_id',
        'saveable_type',
        'reaction'
    ];

    public function saveableable()
    {
        return $this->morphTo();
    }
}
