<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\Download;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

trait DownloadFileTrait {

    public function downloads()
    {
        return $this->morphMany(Download::class, 'downloadable');
    }
    public function downloadFile($user,$file)
    {
        if(!$this->hasDownloadByUser($user)){
            $this->downloads()->create([
                'user_id'             => $user->id,
                'downloadable_id'     => $this->id,
                'downloadable_type'   => get_class($this),
            ]);
        }
    }

    public function hasDownloadByUser(User $user){
        return $this->downloads()->where('user_id', $user->id)
                    ->where('downloadable_id',$this->id)
                    ->where('downloadable_type',get_class($this))
                    ->exists();
    }

    public function downloadsCount(){
        return $this->downloads->count();
    }
}
