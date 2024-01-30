<?php

namespace App\Http\Resources;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertismaentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $section = Section::find($this->section_id);
        return [
            'title'              => $this->title,
            'discripton'         => $this->discripton,
            'trainning_topics'   => $this->trainning_topics,
            'details'            => $this->details,
            'cost'               => $this->cost,
            'trainning_outcomes' => $this->trainning_outcomes,
            'reservation'        => $this->reservation,
            'section'            => $section->name,
            'image'              => asset('images/' . $this->image)
        ];
    }
}
