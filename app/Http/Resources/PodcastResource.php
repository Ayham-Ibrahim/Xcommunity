<?php

namespace App\Http\Resources;

use App\Models\PodcastList;
use Illuminate\Http\Request;
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
        $podcastList = PodcastList::where('id',$podcastList_id)->first;
        return [
            "id"                =>$this->id,
            "title"             => $this->title,
            "voice"             => $this->assets('files/' . $this->voice),
            "duration"          => $this->duration,
            "text_file"         => $this->assets('files/' . $this->text_file),
            "podcast_list_id"   => $this->podcastList,
            'visitors_count'    => $this->visitorCount(),
            'likes_count'       => $this->likesCount(),
            // "child_category_id"   => $this->
            // "section_id"   => $this->
        ];
    }
}
