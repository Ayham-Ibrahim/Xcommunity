<?php

namespace App\Http\Resources;

use App\Http\Traits\GetSavedItemTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArchiveResource extends JsonResource
{
    use GetSavedItemTrait;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $item = $this->createItem($this->saveable_type, $this->saveable_id);

        $section_id = $item->section_id;

        $userItem = $this->getSection($section_id,$item);

        return [
            "id"    => $this->id,
            'item'  => $userItem,
        ];
    }
}
