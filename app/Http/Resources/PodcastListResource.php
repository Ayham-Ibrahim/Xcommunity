<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $child_category = $this->childCategory;

        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'description'      => $this->description,
            'image'            => Storage::url($this->image),
            'visitors_count'   => $this->visitorCount(),
            'rating'           => $this->averageRating(),
            'followers_count'  => $this->followersCount(),
            'child_category'   => $child_category->name,
        ];
    }
}
