<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"               =>$this->id,
            "title"            => $this->title,
            "description"      => $this->description,
            'file'             =>$this->image,
            'image'            =>asset('photos' . $this->image),
            'visitors count'   => $this->visitorCount(),
            'rating'           => $this->averageRating(),
            // "category_id"   => $this->
            // "section_id"    => $this->
        ];
    }
}
