<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $article_group = $this->articleGroup;
        $child_category = $this->childCategory;
        return [
            'article'              => $article_group->name,
            'child category'       => $child_category->name,
            'title'                => $this->title,
            'body'                 => $this->body,
            'time_to_read'         => $this->time_to_read,
            'image'                => asset('images/' . $this->image),
            'timeSincePublication' => Carbon::parse($this->created_at)->diffForHumans(),
            'visitors count'       => $this->visitorCount()
        ];
    }
}
