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
            case 'App\Models\Store':
                return Store::findOrFail($savableId);
                break;
            case 'App\Models\Article':
                return Article::findOrFail($savableId);
                break;
            case 'App\Models\Podcast':
                return Podcast::findOrFail($savableId);
                break;
            case 'App\Models\Job':
                return Job::findOrFail($savableId);
                break;
            case 'App\Models\Advertismaent':
                return Advertismaent::findOrFail($savableId);
                break;
            default:
                return response()->json(['message' => 'Not Found!'], 404);
                break;
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

    public function getNotifiedItem($item_id,$item_type){
        switch ($item_type) {
            case 'store':
                $item = Store::findOrFail($item_id);
                $userItem = new StoreResource($item);
                return $userItem;
            case 'article':
                $item =  Article::findOrFail($item_id);
                $userItem = new ArticleResource($item);
                return $userItem;
            case 'podcast':
                $item = Podcast::findOrFail($item_id);
                $userItem = new PodcastResource($item);
                return $userItem;
            case 'job':
                $item = Job::findOrFail($item_id);
                $userItem = new JobResource($item);
                return $userItem;
            case 'advertismaent':
                $item = Advertismaent::findOrFail($item_id);
                $userItem = new AdvertismaentResource($item);
                return $userItem;
            default:
                return response()->json(['message' => 'Not Found!'], 404);
        }
    }
}
