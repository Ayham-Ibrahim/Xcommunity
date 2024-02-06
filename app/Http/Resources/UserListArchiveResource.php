<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\Article;
use App\Models\UserList;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use App\Http\Traits\GetSavedItemTrait;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\PodcastResource;
use App\Http\Resources\UserListResource;
use App\Http\Resources\AdvertismaentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListArchiveResource extends JsonResource
{
    use GetSavedItemTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userList = UserList::where('id',$this->user_list_id)->first();

        $item = $this->createItem($this->saveable_id,$this->saveable_type);

        $section_id = $item->section_id;

        switch ($section_id) {
            case 2:
                $userItem = new PodcastResource($item);
                break;
            case 3:
                $userItem = new ArticleResource($item);
                break;
            case 4:
                // $userItem = new ($item);
                break;
            case 5:
                $userItem = new JobResource($item);
                break;
            case 5:
                $userItem = new AdvertismaentResource($item);
                break;
            default:
                return response()->json(['message' => 'Not Found!'], 404);
                break;
        }

        return [
            "id"    => $this->id,
            'userList' => new UserListResource($userList),
            'item' => $userItem,
        ];
    }
}
