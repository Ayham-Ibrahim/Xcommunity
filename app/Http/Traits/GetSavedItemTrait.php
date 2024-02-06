<?php

namespace App\Http\Traits;

use App\Models\Job;
use App\Models\Podcast;
use App\Models\Supplement;
use App\Models\Advertismaent;

trait GetSavedItemTrait{

    public function createItem($savableType, $savableId){

        switch ($savableType) {
            case 'book':
                return Book::findOrFail($savableId);
            case 'article':
                return Article::findOrFail($savableId);
            case 'podcast':
                return Podcast::findOrFail($savableId);
            case 'supplement':
                return Supplement::findOrFail($savableId);
            case 'job':
                return Job::findOrFail($savableId);
            case 'advertismaent':
                return Advertismaent::findOrFail($savableId);
            default:
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }

}
