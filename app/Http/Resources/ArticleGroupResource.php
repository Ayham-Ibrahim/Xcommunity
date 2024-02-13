<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Traits\VisitorableTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleGroupResource extends JsonResource
{
    use VisitorableTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category_child = $this->childCategory;
        $category = $category_child->category;
        $articles = $this->articles;
        return [
            'id'               => $this->id,
            'title'             => $this->title,
            'group_info'       => $this->group_info,
            'image'            => Storage::url($this->image),
            'category'         => $category->name,
            'articles_count'   => $articles->count(),
            'visitors_count'   => $this->visitorCount(),
            'followers_count'  => $this->followersCount(),
        ];
    }
}
