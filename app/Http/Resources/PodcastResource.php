<?php

namespace App\Http\Resources;

use App\Models\Section;
use App\Models\PodcastList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PodcastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $podcastList_id = $this->podcastList_id;
        $podcastList = PodcastList::where('id',$podcastList_id)->first();
        $section = Section::find($this->section_id);
        $child_category = $this->childCategory;

        return [
            "id"                =>$this->id,
            "title"             => $this->title,
            "voice"             => Storage::url($this->voice),
            "duration"          => $this->duration,
            "text_file"         => Storage::url($this->text_file),
            "podcast_list_id"   => $this->podcastList,
            'visitors_count'    => $this->visitorCount(),
            'likes_count'       => $this->likesCount(),
            'child_category'    => $child_category->name,
            'section'           => $section->name,
        ];
    }
}
