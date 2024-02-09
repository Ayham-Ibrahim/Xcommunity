<?php

namespace App\Http\Traits;

use App\Http\Resources\AdvertismaentResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\JobResource;
use App\Http\Resources\PodcastResource;
use App\Http\Resources\StoreResource;
use App\Models\Job;
use App\Models\Podcast;
use App\Models\Supplement;
use App\Models\Advertismaent;
use App\Models\Article;
use App\Models\Store;

trait GetSavedItemTrait
{

    public function createItem($savableType, $savableId)
    {

        switch ($savableType) {
            case 'store':
                return Store::findOrFail($savableId);
            case 'article':
                return Article::findOrFail($savableId);
            case 'podcast':
                return Podcast::findOrFail($savableId);
            case 'job':
                return Job::findOrFail($savableId);
            case 'advertismaent':
                return Advertismaent::findOrFail($savableId);
            default:
                return response()->json(['message' => 'Not Found!'], 404);
        }
    }

    public function getSection($section_id, $item)
    {
        switch ($section_id) {
            case 2:
                $userItem = new PodcastResource($item);
                return $userItem;
            case 3:
                $userItem = new ArticleResource($item);
                return $userItem;
            case 4:
                $userItem = new StoreResource($item);
                return $userItem;
            case 5:
                $userItem = new JobResource($item);
                return $userItem;
            case 5:
                $userItem = new AdvertismaentResource($item);
                return $userItem;
            default:
                return response()->json(['message' => 'Not Found!'], 404);
        }
    }
}
