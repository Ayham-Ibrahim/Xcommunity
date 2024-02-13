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
        $userList = UserList::where('id', $this->user_list_id)->first();

        $item = $this->createItem($this->saveable_type, $this->saveable_id);


        $section_id = $item->section_id;

        $userItem = $this->getSection($section_id,$item);

        return [
            "id"    => $this->id,
            'userList' => new UserListResource($userList),
            'item' => $userItem,
        ];
    }
}
