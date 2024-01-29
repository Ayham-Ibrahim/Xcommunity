<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PodcastListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  =>$this->id,
            'title' =>$this->title,
            'description' =>$this->description,
            'image' => assets('photos/'.$this->image),
            'followers_count'   => $this->followersCount('like'),

            // 'child_category_id' =>
        ];
    }
}
