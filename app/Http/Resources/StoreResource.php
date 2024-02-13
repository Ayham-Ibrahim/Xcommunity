<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'file'            => Storage::url($this->file),
            'image'           => Storage::url($this->image),
            'visitors_count'  => $this->visitorCount(),
            'downloads_count' => $this->downloadsCount(),
            'rating'          => $this->averageRating(),
        ];

    }
}
