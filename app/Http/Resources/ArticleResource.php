<?php

namespace App\Http\Resources;

use App\Models\ArticleGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'id'                   => $this->id,
            'article_group'        => $article_group->title,
            'child_category'       => $child_category->name,
            'title'                => $this->title,
            'body'                 => $this->body,
            'time_to_read'         => $this->time_to_read,
            'image'                => Storage::url($this->image),
            'timeSincePublication' => Carbon::parse($this->created_at)->diffForHumans(),
            'visitors_count'       => $this->visitorCount(),
            'likes_count'          => $this->likesCount(),
        ];
    }
}
