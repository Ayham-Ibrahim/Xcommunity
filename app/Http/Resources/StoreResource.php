<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = $this->category;
        return [
            'id'              => $this->id,
            'category'        => $category->name,
            'title'           => $this->title,
            'description'     => $this->description,
            'file'            => asset('files/' . $this->file),
            'image'           => asset('images/' . $this->image),
            'visitors_count'  => $this->visitorCount(),
            'rating'          => $this->averageRating(),
        ];

    }
}
